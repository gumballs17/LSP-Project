<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fashion;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FashionRentController extends Controller
{
    public function index()
    {
        $users = User::where([
            ['role_id', '!=', 1],
            ['status', '!=', 'inactive']
        ])->get();
        $fashions = Fashion::all();
        return view('rent-fashion', ['users' => $users, 'fashions' => $fashions]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(5)->toDateString();

        $fashion = Fashion::findOrFail($request->fashion_id)->only('status');

        // if fashion = not available
        if ($fashion['status'] != 'in stock') {
            Session::flash('message', "Can't rent, the fashion is not available");
            Session::flash('alert-class', "alert-danger");
            return redirect('fashion-rent');
        } else {
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('message', "Can't rent, user has reach limit of fashions");
                Session::flash('alert-class', "alert-danger");
                return redirect('fashion-rent');
            } else {
                try {
                    // Database Transaction karena lebih dari 1 proses
                    DB::beginTransaction();

                    // process insert to rent_logs table
                    RentLogs::create($request->all());

                    // process update fashion table
                    $fashion = Fashion::findOrFail($request->fashion_id);
                    $fashion->status = 'not available';
                    $fashion->save();
                    DB::commit();

                    Session::flash('message', "Rent fashion Success");
                    Session::flash('alert-class', "alert-success");
                    return redirect('fashion-rent');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }

    public function returnfashion()
    {
        $users = User::where([
            ['role_id', '!=', 1],
            ['status', '!=', 'inactive']
        ])->get();

        return view('return-fashion', ['users' => $users]);
    }

    public function getUserfashions($user_id)
    {
        $fashions = Fashion::whereHas('rentLogs', function ($query) use ($user_id) {
            $query->where([
                ['user_id', $user_id],
                ['actual_return_date', null]
            ]);
        })->get();

        return response()->json($fashions);
    }


    public function saveReturnfashion(Request $request)
    {
        $rent = RentLogs::where([
            ['user_id', $request->user_id],
            ['fashion_id', $request->fashion_id],
            ['actual_return_date', '=', NULL]
        ]);
        $rentData = $rent->first();
        $countData = $rent->count();

        if ($countData === 1) {
            try {
                DB::beginTransaction();

                $rentData->actual_return_date = Carbon::now()->toDateString();
                $rentData->save();

                $fashion = Fashion::findOrFail($request->fashion_id);
                $fashion->status = 'in stock';
                $fashion->save();

                DB::commit();

                Session::flash('message', "fashion is returned successfully");
                Session::flash('alert-class', "alert-success");
                return redirect('fashion-return');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        } else {
            Session::flash('message', "Error in returning the fashion!");
            Session::flash('alert-class', "alert-danger");
            return redirect('fashion-return');
        }
    }
}
