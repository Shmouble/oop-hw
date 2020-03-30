<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function get()
    {
        $this->authorize('getUsers', User::class);

        $allUsers = User::paginate(5);

        return view('layouts.administration', compact('allUsers'));
    }

    public function user($id)
    {
        if($user = User::find($id))
        {
            $this->authorize('updateUser', User::class);

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id
            ]);
        }
        else
        {
            return response()->json();
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        if($user = User::find($id))
        {
            $this->authorize('updateUser', User::class);

            $data = $request->all();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->role_id = $data['role_id'];
            $user->save();
        }
    }

    public function delete($id)
    {
        if($user = User::find($id))
        {
            $this->authorize('deleteUser', $user);

            $user->delete();
        }
    }

}
