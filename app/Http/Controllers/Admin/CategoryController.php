<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $list =
        DB::table('categories')
        ->get();

        return view(
            'admin.categories.index',
            compact('list')
        );
    }

    public function create()
    {
        return view(
            'admin.categories.create'
        );
    }

    public function store(Request $request)
    {
        DB::table('categories')
        ->insert([
            'catename'
            =>
            $request->catename,

            'slug'
            =>
            $request->slug
        ]);

        return redirect()
        ->route(
            'admin.categories.index'
        );
    }

    public function destroy($id)
    {
        DB::table('categories')
        ->where(
            'cateid',
            $id
        )
        ->delete();

        return redirect()
        ->route(
            'admin.categories.index'
        );
    }
}