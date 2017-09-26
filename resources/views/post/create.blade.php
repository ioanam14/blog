@extends('layouts.app')

@section('after-styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
    <div class="article">
        <div class="header">
            <h3>Add Post</h3>
        </div>

        <div class="content">
            {{ Form::open(['route' => 'post.create']) }}

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('content', 'Content') }}
                {{ Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('thumbnail', 'Thumbnail') }}
                {{ Form::text('thumbnail', null, ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('after-scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.js"></script>
    <script src="{{ asset('js/custom_summernote.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote(summernote_options);
        });
    </script>
@endsection