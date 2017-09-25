@extends('layouts.app')

@section('content')
    @if(count($posts) == 0)
        <div class="alert alert-info">
            <strong>Info!</strong> There are no posts!
        </div>
    @endif

    @foreach($posts as $post)
        <div class="card">
            <div class="header">
                <a href="{{ route('post.view', ['slug' => $post->slug]) }}">
                    <h3>{{ $post->title }}</h3>
                </a>
                <small class="date">Posted on {{ $post->created_at->format('d M Y H:i') }}</small>
            </div>

            @if(isset($post->thumbnail))
                <div class="thumbnail" style="background-image: url('{{ $post->thumbnail }}')"></div>
            @endif

            <div class="content">
                <p>{!! $post->content !!}</p>
            </div>
        </div>
    @endforeach

    <div class="text-center">{{ $posts->links() }}</div>
@endsection