@extends('layouts.app')

@section('after-styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
@endsection

@section('content')
    <div class="article">
        <div class="header">
            <h3>Edit Post</h3>
        </div>

        <div class="content">
            {{ Form::open(['route' => ['post.edit', $post->slug], 'method' => 'PUT']) }}

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', $post->title, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('content', 'Content') }}
                {{ Form::textarea('content', $post->content, ['id' => 'content', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('thumbnail', 'Thumbnail') }}
                {{ Form::text('thumbnail', $post->thumbnail, ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('Edit', ['class' => 'button']) }}

            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('after-scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script src="{{ asset('js/custom_summernote.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote(summernote_options);
        });
    </script>
@endsection