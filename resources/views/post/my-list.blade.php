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

            <div class="footer">
                <a href="{{ route('post.edit', ['slug' => $post->slug]) }}">
                    <span class="button">Edit</span>
                </a>

                <a href="#">
                    <span class="btn-delete button" data-toggle="modal" data-target="#modal-delete" data-slug="{{ $post->slug }}">
                        Delete
                    </span>
                </a>
            </div>
        </div>
    @endforeach

    <div class="text-center">{{ $posts->links() }}</div>

    <div id="modal-delete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to delete this post?</h4>
                </div>

                {{ Form::open(['route' => 'post.delete', 'method' => 'DELETE']) }}

                {{ Form::hidden('slug', null, ['id' => 'input-slug']) }}

                <div class="modal-footer">
                    {{ Form::submit('Yes', ['class' => 'btn btn-danger']) }}

                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script> 
        $(".btn-delete").click(function() {
            $("#input-slug").val($(this).data('slug'));
        })
    </script>
@endsection
