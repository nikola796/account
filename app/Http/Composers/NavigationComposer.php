<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 19.12.2016 г.
 * Time: 17:29 ч.
 */

namespace App\Http\Composers;


use App\Article;
use Illuminate\Contracts\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $view->with('latest', Article::latest()->first());
    }

}