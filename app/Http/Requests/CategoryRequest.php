<?php
/**
 * Created by PhpStorm.
 * User: vlado
 * Date: 10/9/2018
 * Time: 10:48
 */

namespace App\Http\Requests;


class CategoryRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2'
        ];
    }
}