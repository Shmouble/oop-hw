<?php

namespace App\Http\Controllers;
use App\Model\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    public function index()
    {
        $borderTime = date('yy-m-d H:i:s', strtotime("-12 hours"));

        if($user = auth()->user())
        {
            $todos = Todo::where('user_id', $user->id)
                ->whereDate('execution_time', '>=', $borderTime)
                ->paginate(Config::get('somedata.numberOfPages'));
        }
        else
        {
            $todos = Todo::paginate(Config::get('somedata.numberOfPages'));
        }

        return view('layouts.index', compact('todos'));
    }

    public function delete($id) {
        if($todo = Todo::find($id)) {
            $this->authorize('delete', $todo);

            $todo->delete();
        }
    }

    public function get($id)
    {
        if ($todo = Todo::find($id))
        {
            $this->authorize('update', $todo);

            return response()->json([
                'purpose' => $todo->purpose,
                'description' => $todo->description,
                'category' => $todo->category,
                'execution_time' => $todo->execution_time,
                'id' => $todo->id
            ]);
        } else {
            return response()->json();
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'purpose' => 'required',
            'category' => 'required',
            'description' => 'required',
            'execution_time' => 'required'
        ]);

        if ($todo = Todo::find($id))
        {
            $this->authorize('update', $todo);

            $data = $request->all();
            $todo->purpose = $data['purpose'];
            $todo->category = $data['category'];
            $todo->description = $data['description'];
            $todo->execution_time = $data['execution_time'];
            $todo->save();
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'purpose' => 'required',
            'category' => 'required',
            'description' => 'required',
            'execution_time' => 'required'
        ]);

        $user = $request -> user();
        $todo = new Todo();

        $data = $request->all();
        $todo->purpose = $data['purpose'];
        $todo->category = $data['category'];
        $todo->description = $data['description'];
        $todo->execution_time = $data['execution_time'];
        $todo->user_id = $user->id;
        $todo->save();
    }
}