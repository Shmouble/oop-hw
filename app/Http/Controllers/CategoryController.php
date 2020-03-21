<?php
/**
 * Created by PhpStorm.
 * User: Юра
 * Date: 23.02.2020
 * Time: 14:42
 */

namespace App\Http\Controllers;

use App\Model\Todo;


class CategoryController
{
    public function get($category, $id)
    {
        $matchThese = ['user_id' => $id, 'category' => $category];

        $todos = Todo::where($matchThese)->get();

        if(sizeof($todos) >= 1)
        {
            return view('layouts.category', compact('todos'));
        }
        else
        {
            abort(404);
        }
    }
}