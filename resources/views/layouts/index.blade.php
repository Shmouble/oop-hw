@extends('layouts.base')

@section('content')
    @auth
    <div class="flex-center position-ref full-height">
        <h1>{{__('messages.todo_list')}}</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button class="addButton">{{__('messages.add')}}</button>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>{{__('messages.purpose')}}</th>
                <th>{{__('messages.description')}}</th>
                <th>{{__('messages.category')}}</th>
                <th>{{__('messages.execution_time')}}</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            @foreach($todos as $todo)
                <tr>
                    <td>
                        {{ $todo->id }}
                    </td>
                    <td>
                        {{ $todo->purpose }}
                    </td>
                    <td>
                        {{ $todo->description }}
                    </td>
                    <td>
                        <a href="/categories/{{$todo->category}}/{{Auth::user()->id}}">{{ $todo->category }}</a>
                    </td>
                    <td>
                        {{ date('d-m-yy H:i:s', strtotime($todo->execution_time)) }}
                    </td>
                    <td>
                        <button class="deleteButton" data-id="{{  $todo->id }}">{{__('messages.delete')}}</button>
                        <p><a  data-id="{{  $todo->id }}" class="openModal">{{__('messages.edit')}}</a></p>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$todos->render()}}
    </div>
    @endauth
    <!-- Modal HTML embedded directly into document -->
    <div id="ex1" class="modal">
        <p>{{__('messages.edit_todo')}}</p>
        <form id="updateForm">
            <label>{{__('messages.purpose')}}</label>
            <input type="text" name="purpose">
            <br>
            <label>{{__('messages.description')}}</label>
            <input type="text" name="description">
            <br>
            <label>{{__('messages.category')}}</label>
            <input type="text" name="category">
            <br>
            <label>{{__('messages.execution_time')}}</label>
            <input type="datetime-local" name="execution_time" id="addExecutionTime">
            <br>
            <input type="hidden" name="id">
            <input type="submit"/>
        </form>
        <a href="#" rel="modal:close">{{__('messages.close')}}</a>
    </div>

    <div id="ex2" class="modal">
        <p>{{__('messages.add_todo')}}</p>
        <form id="addForm">
            <label>{{__('messages.purpose')}}</label>
            <input type="text" name="purpose" id="addPurpose">
            <br>
            <label>{{__('messages.description')}}</label>
            <input type="text" name="description" id="addDescription">
            <br>
            <label>{{__('messages.category')}}</label>
            <input type="text" name="category" id="addCategory">
            <br>
            <label>{{__('messages.execution_time')}}</label>
            <input type="datetime-local" name="execution_time" id="addExecutionTime">
            <br>
            <input type="hidden" name="id">
            <button type="submit">{{__('messages.add')}}</button>
        </form>
        <a href="#" rel="modal:close">{{__('messages.close')}}</a>
    </div>

    <!-- Link to open the modal -->

@endsection