<?php
/**
 * Created by PhpStorm.
 * User: st
 * Date: 17.02.2020
 * Time: 20:33
 */

namespace App\Http\Controllers;
use App\Model\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{
    public function index() {
        $user = auth()->user();

        if(auth()->user())
        {
            $todos = Todo::where('user_id', $user->id)->paginate(5);
        }
        else
        {
            $todos = Todo::paginate(5);
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
            'description' => 'required'
        ]);

        if ($todo = Todo::find($id))
        {
            $this->authorize('update', $todo);

            $data = $request->all();
            $todo->purpose = $data['purpose'];
            $todo->category = $data['category'];
            $todo->description = $data['description'];
            $todo->save();
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'purpose' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);

        $user = auth()->user();
        $todo = new Todo();

        $data = $request->all();
        $todo->purpose = $data['purpose'];
        $todo->category = $data['category'];
        $todo->description = $data['description'];
        $todo->user_id = $user->id;
        $todo->save();
    }
}