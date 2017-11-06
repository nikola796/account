<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $category = Auth::user()->categories;
//dd($category);
        foreach ($category as $ta){
            $funds[$ta['name']] = $ta->funds()->get();
            //$t[] = $ta['name'];
        }
       // dd($articles);
        //return $tags;
        return view('categories.index', compact('funds'));

    }

    public function show(Category $category)
    {

        $funds = $category->funds()->get();

        $cat_name = $category->name;

        return view('categories.show', compact('funds', 'cat_name'));

    }

}
