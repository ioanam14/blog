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
                        <span class="pull-right">{{ $post->created_at }}</span>
                    </div>

                    <div class="panel-body">
                        @if(isset($post->thumbnail))
                            <img src="{{ $post->thumbnail }}" alt="No thumbnail">
                            <br>
                        @endif

                        {{ $post->content }}
                    </div>

                    <div class="panel-footer">
                        <div class="text-right">
                            <a href="{{ route('post.edit', ['slug' => $post->slug]) }}">
                                <button type="button" class="btn btn-default btn-sm">Edit</button>
                            </a>
                            <button type="button" class="btn-delete btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" data-slug="{{ $post->slug }}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center">{{ $posts->links() }}</div>

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
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
