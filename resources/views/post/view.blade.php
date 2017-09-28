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

            @if (count($comments))
                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($comments as $comment)
                            <div class="media">
                                <div class="media-left">
                                    <img src="https://i.redd.it/qh713wbo4r8y.jpg" class="media-object" style="width:60px">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> {{ $comment->user->name }}</h4>
                                    <p id="comment-{{ $comment->id }}">{{ $comment->comment }}</p>
                                </div>
                                <div class="media-right">
                                    <button type="button" class="btn-edit btn btn-default btn-xs btn-block" style="margin-bottom: 5px" data-toggle="modal" data-target="#myModal" data-comment-id="{{ $comment->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn-delete btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#DeleteModal" data-comment-id="{{ $comment->id }}">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit comment</h4>
                    </div>

                    {{ Form::open(['route' => 'comment.edit', 'method' => 'PUT']) }}
                    <div class="modal-body">

                        {{ Form::hidden('comment_id', null, ['id' => 'input-edit-comment-id']) }}

                        {{ Form::textarea('comment', null , ['class' => 'form-control', 'id' => 'input-edit-comment-content']) }}

                    </div>
                    <div class="modal-footer">
                        {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div id="DeleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Are you sure you want to delete this comment?</h4>
                    </div>

                    {{ Form::open(['route' => 'comment.delete', 'method' => 'DELETE']) }}

                    {{ Form::hidden('comment_id', null, ['id' => 'input-delete-comment-id']) }}

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
@endsection

@section('after-scripts')
    <script>
        $(".btn-edit").click(function() {
            var comment_id = $(this).data('comment-id');
            var comment = $("#comment-" + comment_id).html();
            $("#input-edit-comment-content").val(comment);
            $("#input-edit-comment-id").val(comment_id);
        })

        $(".btn-delete").click(function () {
            var comment_id = $(this).data('comment-id');
            $("#input-delete-comment-id").val(comment_id);
        })
    </script>
@endsection

