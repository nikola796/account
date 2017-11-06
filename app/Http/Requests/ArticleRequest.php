<?php namespace App\Http\Requests;

use App\Article;
use App\Http\Requests\Request;
use Auth;

class ArticleRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
       return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required|min:2',
            'body' => 'required|min:2',
            'published_at' => 'required|date'
		];
	}

}
