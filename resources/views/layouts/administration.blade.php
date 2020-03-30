@extends('layouts.base')

@section('content')

    <div class="flex-center position-ref full-height">
        <h2>{{__('messages.admins_page')}}</h2>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3>{{__('messages.users_data')}}</h3>

        <table border="1">
            <tr>
                <th>id</th>
                <th>{{__('messages.name')}}</th>
                <th>{{__('messages.email')}}</th>
                <th>{{__('messages.role')}}</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            @foreach($allUsers as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->role_id }}
                    </td>
                    <td>
                        <button class="deleteUserButton" data-id="{{  $user->id }}">{{__('messages.delete')}}</button>
                        <p><a  data-id="{{  $user->id }}" class="openEditUserForm">{{__('messages.edit')}}</a></p>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$allUsers->render()}}
    </div>

    <div id="ex3" class="modal">
        <p>{{__('messages.edit_users_data')}}</p>
        <form id="updateUserForm">
            <label>{{__('messages.name')}}</label>
            <input type="text" name="name">
            <br>
            <label>{{__('messages.email')}}</label>
            <input type="text" name="email">
            <br>
            <label>{{__('messages.role')}}</label>
            <select name="role_id">
                <option value="1">{{__('messages.admin')}}</option>
                <option value="2">{{__('messages.user')}}</option>
            </select>
            <br>
            <input type="hidden" name="id">
            <input type="submit"/>
        </form>
        <a href="#" rel="modal:close">{{__('messages.close')}}</a>
    </div>

@endsection