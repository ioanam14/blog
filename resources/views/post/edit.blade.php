@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Post</div>

                <div class="panel-body">
                    {{ Form::open(['route' => ['post.edit', $post->slug], 'method' => 'PUT']) }}

                    <div class="form-group">
                        {{ Form::label('title', 'Title') }}
                        {{ Form::text('title', $post->title, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('content', 'Content') }}
                        {{ Form::textarea('content', $post->content, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('thumbnail', 'Thumbnail') }}
                        {{ Form::text('thumbnail', $post->thumbnail, ['class' => 'form-control']) }}
                    </div>

                    {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
