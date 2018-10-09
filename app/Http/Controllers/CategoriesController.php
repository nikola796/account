<?php namespace App\Http\Controllers;

use App\Category;
use Auth;
use App\Http\Requests\CategoryRequest;

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

    public function create()
    {

        $categories = Auth::user()->categories()->lists('name', 'id');

        return view('categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {

        //dd($request);
        $this->createCategory($request);

        session()->flash('flash_message', 'Your article has been created');
        //session()->flash('flash_message_important', true);

        // return redirect('articles');
        // $input = $request->all();


        ///  $input['amount'] = round($input['amount'], 2) * 100;

        // $input['event_data'] = Carbon::now();

        //   Fund::create($input);

        return redirect('categories');
    }

    private function createCategory(CategoryRequest $request)
    {
        $category = Auth::user()->categories()->create($request->all());


        //$this->syncTags($fund, $request->input('category_list'));

        return $category;
    }

}
