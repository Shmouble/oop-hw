<?php
/**
 * Created by PhpStorm.
 * User: Юра
 * Date: 23.02.2020
 * Time: 14:42
 */

namespace App\Http\Controllers;

use App\Model\Todo;
use Illuminate\Support\Facades\Config;


class CategoryController
{
    public function get($category, $id)
    {
        $matchThese = ['user_id' => $id, 'category' => $category];
        $borderTime = date('yy-m-d H:i:s', strtotime("-12 hours"));

        $todos = Todo::where($matchThese)
            ->whereDate('execution_time', '>=', $borderTime)
            ->paginate(Config::get('somedata.numberOfPages'));

        if(count($todos) >= 1)
        {
            return view('layouts.category', compact('todos'));
        }
        else
        {
            abort(404);
        }
    }
}