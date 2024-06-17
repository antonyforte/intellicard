<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;

class CategoryController extends Controller
{
    public function create(Request $request) {
        $category = new Category;

        $category->class = $request->class;
        $category->user_id = Auth::user()->id;        
        
        $category->save();


        return redirect()->back();
    }

    public function list() {
        $user =  Auth::user()->id;

        $categories = Category::where('user_id', $user)->get();

        return $categories;
    }

    public function list2(){
        $user =  Auth::user()->id;

        $categories = Category::where('user_id', $user)->get();

        return $categories;
    }
}
