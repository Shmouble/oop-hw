@extends('layouts.base')

@section('content')
    <div class="flex-center position-ref full-height">
        <h2>{{__('messages.category')}}: {{$todos[0]->category}}</h2>
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
                        {{$todo->category}}
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
    </div>
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

@endsection