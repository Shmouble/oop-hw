<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Todo;

class ArchiveController extends Controller
{
    public function get()
    {
        $borderTime = date('yy-m-d H:i:s', strtotime("-12 hours"));

        if($user = auth()->user())
        {
            $todos = Todo::where('user_id', $user->id)
                ->whereDate('execution_time', '<', $borderTime)
                ->paginate(5);
        }
        else
        {
            $todos = Todo::paginate(5);
        }

        return view('layouts.archive', compact('todos'));
    }
}
