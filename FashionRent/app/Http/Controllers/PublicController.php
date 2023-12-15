<?php

namespace App\Http\Controllers;

use App\Models\Fashion;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(){
        return view("welcome");
    }
    public function fashionlist(Request $request)
    {
        $categories = Category::all();

        if ($request->category || $request->title) {
            $fashions = Fashion::where('title', 'LIKE', '%' . $request->title . '%')->orWhereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            })->get();
        } else {
            $fashions = Fashion::all();
        }

        return view('fashion-list', ['fashions' => $fashions, 'categories' => $categories]);
    }
}
