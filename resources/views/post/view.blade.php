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

        </div>
    </div>
</div>
@endsection
