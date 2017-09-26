@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('post.view', ['slug' => $post->slug]) }}" >{{ $post->title }}</a>
                    <span class="pull-right">{{ $post->created_at }}</span>
                </div>

                <div class="panel-body">
                    <img src="{{ $post->thumbnail }}">
                    <br>
                    {{ $post->content }}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add a comment!
                </div>
                <div class="panel-body">
                    {{ Form::open(['route' => ['comment.create', $post->slug]]) }}

                    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 4]) }}

                    <br>
                    {{ Form::submit('Post', ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">

                    @foreach($comments as $comment)
                        <div class="media">
                            <div class="media-left">
                                <img src="https://i.redd.it/qh713wbo4r8y.jpg" class="media-object" style="width:60px">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"> {{ $comment->user->name }}</h4>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
