<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticleRequest;
use App\Tag;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;



class ArticlesController extends Controller {


    /**
     * Create a new articles controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * We Show articles only to auth users;
	 *
	 * @return Response
	 */
	public function index()
	{
	    $articles = Auth::user()->articles()->latest('published_at')->published()->get();
		return view('articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    //$tags = Tag::lists('name', 'id');
        $tags = Auth::user()->tags()->lists('name', 'id');
//dd($tags);
		return view('articles.create', compact('tags'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return Response
     */
	public function store(ArticleRequest $request)
	{

        $this->createArticle($request);

        session()->flash('flash_message', 'Your article has been created');
        session()->flash('flash_message_important', true);

        return redirect('articles');

	   // dd($request->input('tag_list'));
		//$input = Request::all();

       // $input['published_at'] = Carbon::now();

        //Article::create($request->all());
//******Prev release***********************************************
    //    $article = new Article($request->all());

     //   Auth::user()->articles()->save($article);
 //***** END Prev Release **********************************************

//        $article = Auth::user()->articles()->create($request->all());
//
//        //$article->tags()->attach($request->input('tag_list'));
//
//        $this->syncTags($article, $request->input('tag_list'));

        //Session::flash('flash_message', 'Your article has been created');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  $article
	 * @return Response
	 */
	public function show(Article $article)
	{

      //  if($article->user_id == Auth::id()){
      //      return view('articles.show', compact('article'));
      //  }
      //  else{
      //      return redirect()->back()->withInput()->withErrors('forbidden');
      //  }

		//$article = Article::findOrFail($id);

        //dd($article);

        return view('articles.show', compact('article'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  $article
	 * @return Response
	 */
	public function edit(Article $article)
	{
		//$article = Article::findOrFail($id);
        $tags = Auth::user()->tags()->lists('name', 'id');

        if($article->user_id == Auth::id()){
            return view('articles.edit', compact('article', 'tags'));
        }
        else{
            return redirect()->back()->withInput()->withErrors('forbidden');
        }


	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $article
     * @param $request
	 * @return Response
	 */
	public function update(Article $article, ArticleRequest $request)
	{
	    //dd($request);
        //$article = Article::findOrFail($id);

        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return redirect('articles');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  $article
	 * @return Response
	 */
	public function destroy(Article $article)
	{
		//
	}

    /**
    /**
     * Sync the tags
     * @param $article
     * @param array $t
     *
     */
    private function syncTags(Article $article, $t)
    {
        if($t == null)
        {
            $article->tags()->detach();
        } else{
            //Add any new tags
            $tags = $this->processNewTags($t);

            $article->tags()->sync($tags);
        }

    }

    /**
     * Save a new Article.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());


        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }

    /**
     * Takes the submitted tags and creates new ones for any that exist
     * @param $tags
     * @return tags
     */
    private function processNewTags($tags)
    {
        $newTags = [];
        $dbTags = $this->filterDatabaseTagsToArray();

        //Create any new tags
        foreach (array_diff($tags, $dbTags) as $key => $t) {
            //I'm funny about using ::create() for no reason really
            $nt = new Tag();
            $nt->name = $t;
            $nt->user_id = Auth::id();
            $nt->save();
            $newTags[] = (string) $nt->id;
            unset($tags[$key]);
        }
        return array_merge($tags, $newTags);
    }

    /**
     * Fetches the Tags from the database and filters them into a single array
     * @return array
     */
    private function filterDatabaseTagsToArray()
    {

        $dbTags = Tag::all(['id', 'name']);
        //dd($dbTags);
        $tags = [];
        foreach ($dbTags as $t) {
            //I've placed the name as the key in case of additional checking
            $tags[$t->name] = $t->id;
        }

        return $tags;
    }

}
