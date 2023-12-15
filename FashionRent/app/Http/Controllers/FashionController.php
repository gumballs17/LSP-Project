<?php

namespace App\Http\Controllers;

use App\Models\Fashion;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FashionController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $fashions = Fashion::with('categories')
            ->where('fashion_code', 'LIKE', '%' . $keyword . '%')
            ->orWhere('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('status', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('categories', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);
        return view('fashion', ['fashions' => $fashions]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('fashion-add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'fashion_code' => 'required|unique:fashions|max:255',
            'title' => 'required|max:255'
        ]);

        // jika tidak upload image maka akan menggunakan string kosong
        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $fashion = Fashion::create($request->all());
        $fashion->categories()->sync($request->categories);
        return redirect('fashions')->with('status', 'fashion Added Successfully!');
    }

    public function edit($slug)
    {
        $fashion = Fashion::where('slug', $slug)->first();
        $categories = Category::all();
        return view('fashion-edit', ['fashion' => $fashion, 'categories' => $categories]);
    }

    public function update(Request $request, $slug)
    {
        $newName = '';

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }

        $fashion = Fashion::where('slug', $slug)->first();

        Storage::disk('public')->delete('cover/' . $fashion->cover);

        $fashion->update($request->all());

        if ($request->categories) {
            $fashion->categories()->sync($request->categories);
        }

        return redirect('fashions')->with('status', 'fashion Updated Successfully!');
    }

    public function delete($slug)
    {
        $fashion = Fashion::where('slug', $slug)->first();
        return view('fashion-delete', ['fashion' => $fashion]);
    }

    public function destroy($slug)
    {
        $fashion = Fashion::where('slug', $slug)->first();
        $fashion->delete();
        return redirect('fashions')->with('status', 'fashion Deleted Successfully!');
    }

    public function deletedfashion()
    {
        $deletedfashions = Fashion::onlyTrashed()->get();
        return view('fashion-deleted-list', ['deletedfashions' => $deletedfashions]);
    }

    public function restore($slug)
    {
        $fashion = Fashion::withTrashed()->where('slug', $slug)->first();
        $fashion->restore();
        return redirect('fashions')->with('status', 'fashion Restored Successfully!');
    }

    public function permanentDelete($slug)
    {
        $deletedfashion = Fashion::withTrashed()->where('slug', $slug)->first();

        // Menghapus data terkait di tabel anak
        $deletedfashion->fashionCategories()->delete();

        Storage::disk('public')->delete('cover/' . $deletedfashion->cover);
        $deletedfashion->forceDelete();

        if ($deletedfashion) {
            Session::flash('status', 'success');
            Session::flash('message', "Delete Permanent fashion data $deletedfashion->name successfully");
        }

        return redirect('/fashions');
    }
}
