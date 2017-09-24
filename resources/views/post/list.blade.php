@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if(count($posts) == 0)
                <div class="alert alert-info">
                    <strong>Info!</strong> There are no posts!
                </div>
            @endif

            @foreach($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ route('post.view', ['slug' => $post->slug]) }}" >{{ $post->title }}</a>
                        <span class="pull-right">{{ $post->created_at->format('d M Y H:i') }}</span>
                    </div>

                    <div class="panel-body">
                        <img src="{{ $post->thumbnail }}">
                        <br>
                        {!! $post->content !!}
                    </div>
                </div>
            @endforeach

            <div class="text-center">{{ $posts->links() }}</div>

        </div>
    </div>
</div>
@endsection
