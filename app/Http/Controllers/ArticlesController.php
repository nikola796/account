<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;


class ArticlesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $articles = Article::latest('published_at')->published()->get();
		return view('articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('articles.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticleRequest $request
     * @return Response
     */
	public function store(ArticleRequest $request)
	{
		//$input = Request::all();

       // $input['published_at'] = Carbon::now();
        $request['user_id'] = 1;
        Article::create($request->all());

        return redirect('articles');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = Article::findOrFail($id);

       // dd($article->updated_at);

        return view('articles.show', compact('article'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ArticleRequest $request)
	{
        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect('articles');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
