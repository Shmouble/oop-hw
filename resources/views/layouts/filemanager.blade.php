@extends('layouts.base')

@section('content')

    <div class="flex-center position-ref full-height">
        <h2>File manger</h2>

        <h3>Current directory: {{ $path }}/</h3>

        <h4>Directories:</h4>
        <a class="goUp">../</a>
        <br>

        @if(count($directoriesNames) > 0)
            @foreach($directoriesNames as $directory)
                <a data-name="{{ $directory  }}" class="changeFolder">{{ $directory  }}</a>
                <br>
            @endforeach
        @endif

        <h4>Files:</h4>
        @if(count($filesNames) > 0)
            @foreach($filesNames as $file)
                {{ $file  }}
                <br>
            @endforeach
        @endif
        <br>
        <form id="fileUploadForm">
            <label>Upload file:</label>
            <input class="file-input" type="file" name="file">
            <button type="submit">Send</button>
        </form>

    </div>

@endsection