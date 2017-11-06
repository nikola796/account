<?php namespace App\Providers;

use App\Account;
use App\Article;
use App\Category;
use App\Fund;
use App\Group;
use App\Tag;
use Auth;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		$router->bind('articles', function($id)
        {
            //$articleId = $this->route('article');

            return Article::checkAuthor()->findOrFail($id);

        });

		//$router->model('funds', 'App\Fund');

        $router->bind('funds', function($id){
            return Fund::checkAuthor()->findOrFail($id);
});

        $router->bind('tags', function($name)
    {
        //$articleId = $this->route('article');

        return Tag::checkAuthor($name)->firstOrFail();
        //return Tag::where('name', $name)->where('user_id', Auth::id())->firstOrFail();

    });

        $router->bind('categories', function($name)
        {
            //$articleId = $this->route('article');

            return Category::checkAuthor($name)->firstOrFail();
            //return Tag::where('name', $name)->where('user_id', Auth::id())->firstOrFail();

        });

        $router->bind('accounts', function($name)
        {
            return Account::checkAuthor($name)->firstOrFail();
        });

        $router->bind('groups', function($name)
        {
            return Group::checkAuthor($name)->firstOrFail();
        });

//		$router->bind('articles', function($id){
//		   return \App\Article::published()->findOrFail($id);
//        });

		//
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
