<?php namespace App\Http\Controllers;

use App\Category;
use App\Fund;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\FundRequest;
use Auth;
use Carbon\Carbon;
use Request;

class FundsController extends Controller {



    /**
     * We Show funds only to auth users;
     * ArticlesController constructor.
     */
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
		$funds = Fund::latest('published_at')->published()->get();

        return view('funds.index', compact('funds'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	   // $groups = Fund::all();
       // foreach ($groups as $group){
       //     $cl_groups[$group['id']] = $group['name'];
      //  }

        $categories = Auth::user()->categories()->lists('name', 'id');

		return view('funds.create', compact('categories'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFundRequest $request
     * @return Response
     */
	public function store(FundRequest $request)
	{
	    $this->createFund($request);

        session()->flash('flash_message', 'Your article has been created');
        //session()->flash('flash_message_important', true);

       // return redirect('articles');
	   // $input = $request->all();


      ///  $input['amount'] = round($input['amount'], 2) * 100;

       // $input['event_data'] = Carbon::now();

     //   Fund::create($input);

        return redirect('funds');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Fund $fund
	 * @return Response
	 */
	public function show(Fund $fund)
	{
		//$fund = Fund::findOrFail($id);

        return view('funds.show', compact('fund'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Fund $fund
	 * @return Response
	 */
	public function edit(Fund $fund)
	{

        //$article = Article::findOrFail($id);
        $categories = Auth::user()->categories()->lists('name', 'id');

        if($fund->user_id == Auth::id()){
            return view('funds.edit', compact('fund', 'categories'));
        }
        else{
            return redirect()->back()->withInput()->withErrors('forbidden');
        }
		//$fund = Fund::findOrFail($id);

        //$fund['amount'] = ($fund['amount'] / 100);

       // return view('funds.edit', compact('fund'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Fund $fund
     * @param FundRequest $request
     * @return Response
     */
	public function update(Fund $fund, FundRequest $request)
	{
        //$fund = Fund::findOrFail($id);

        //$request['added_by'] = 1;

        //$request['amount'] = round($request['amount'], 2) * 100;

        $fund->update($request->all());

        $this->syncTags($fund, $request->input('category_list'));

        return redirect('funds');






	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Fund $fund
	 * @return Response
	 */
	public function destroy(Fund $fund)
	{
		//
	}

    /**
     * Save a new Fund.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function createFund(FundRequest $request)
    {
        $fund = Auth::user()->funds()->create($request->all());


        $this->syncTags($fund, $request->input('category_list'));

        return $fund;
    }

    /**
     * /**
     * Sync the tags
     * @param Fund $fund
     * @param array $t
     * @internal param $article
     */
    private function syncTags(Fund $fund, $t)
    {
        if($t == null)
        {
            $fund->categories()->detach();
        } else{
            //Add any new tags
            $category = $this->processNewCategory($t);

            $fund->categories()->sync($category);
        }

    }


    /**
     * Takes the submitted tags and creates new ones for any that exist
     * @param $category
     * @return tags
     * @internal param $tags
     */
    private function processNewCategory($category)
    {
        $newCategory = [];
        $dbTags = $this->filterDatabaseCategoryToArray();

        //Create any new tags
        foreach (array_diff($category, $dbTags) as $key => $t) {
            //I'm funny about using ::create() for no reason really
            $nt = new Category();
            $nt->name = $t;
            $nt->user_id = Auth::id();
            $nt->parent_id = $t;
            $nt->save();
            $newCategory[] = (string) $nt->id;
            unset($category[$key]);
        }
        return array_merge($category, $newCategory);
    }

    /**
     * Fetches the Tags from the database and filters them into a single array
     * @return array
     */
    private function filterDatabaseCategoryToArray()
    {

        $dbCategory = Category::all(['id', 'name']);
        //dd($dbTags);
        $category = [];
        foreach ($dbCategory as $t) {
            //I've placed the name as the key in case of additional checking
            $category[$t->name] = $t->id;
        }

        return $category;
    }

}
