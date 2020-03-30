@extends('layouts.base')

@section('content')
    @auth
        <div class="flex-center position-ref full-height">
            <h1>{{__('messages.old_todos_archive')}}</h1>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>{{__('messages.purpose')}}</th>
                    <th>{{__('messages.description')}}</th>
                    <th>{{__('messages.category')}}</th>
                    <th>{{__('messages.execution_time')}}</th>
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
                    </tr>
                @endforeach
            </table>
            {{$todos->render()}}
        </div>
    @endauth

@endsection