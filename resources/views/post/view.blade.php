@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('post.view', ['slug' => $post->slug]) }}" >{{ $post->title }}</a>
                    <span class="pull-right">{{ $post->created_at->format('d M Y H:i') }}</span>
                </div>

                <div class="panel-body">
                    <img src="{{ $post->thumbnail }}">
                    <br>
                    {{ $post->content }}
                </div>
            </div>

            <!-- Display add comment section if the user is logged in -->
            @auth
                <div class="panel panel-default">
                    <div class="panel-heading">Add a comment</div>

                    <div class="panel-body">
                        {{ Form::open(['route' => ['comment.add', $post->slug]]) }}
                        {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => '3']) }}
                        {{ Form::submit('Add', ['class' => 'btn btn-primary pull-right', 'style' => "margin-top: 5px"]) }}
                        {{ Form::close() }}
                    </div>
                </div>
            @endauth

            <!-- Comments -->
            @foreach ($comments as $comment)
                <div class="panel">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <img src="https://d4n5pyzr6ibrc.cloudfront.net/media/27FB7F0C-9885-42A6-9E0C19C35242B5AC/4785B1C2-8734-405D-96DC23A6A32F256B/thul-90efb785-97af-5e51-94cf-503fc81b6940.jpg?response-content-disposition=inline" class="media-object" style="width:60px">
                            </div>
                            <div class="media-body">

                                @if ($comment->is_mine)
                                    <div class="pull-right">
                                        <a class="btn-edit" data-toggle="modal" data-target="#comment-edit" data-comment-id="{{ $comment->id }}">                                    
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a class="btn-delete" data-toggle="modal" data-target="#comment-delete" data-comment-id="{{ $comment->id }}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>
                                    </div>
                                @endif

                                <h4 class="media-heading">
                                    {{ $comment->user->name }}
                                    <small>{{ $comment->updated_at->format('d M Y H:i') }}</small>
                                </h4>

                                <p id="content-{{ $comment->id }}">{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Modals -->
            <div id="comment-edit" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit comment</h4>
                        </div>
                        
                        {{ Form::open(['route' => 'comment.edit', 'method' => 'PUT']) }}

                            <div class="modal-body">
                                {{ Form::hidden('comment-id', null, ['id' => 'input-comment-id']) }}
                                {{ Form::textarea('content', null, ['id' => 'input-comment-content', 'class' => 'form-control'])}}
                            </div>

                            <div class="modal-footer">
                                {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div id="comment-delete" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete comment</h4>
                        </div>
                        
                        <div class="modal-body">
                            <p>Are you sure you want to delete your comment?</p>
                        </div>
                        
                        {{ Form::open(['route' => 'comment.delete', 'method' => 'DELETE']) }}

                            <div class="modal-footer">
                                {{ Form::hidden('comment-id', null, ['id' => 'input-comment-id']) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        $(".btn-edit").click(function () {
            var comment_id = $(this).data('comment-id');
            var content = $("#content-" + comment_id).text();

            console.log(content);

            $("#input-comment-id").val(comment_id);
            $("#input-comment-content").val(content);
        });

        $(".btn-delete").click(function () {
            var comment_id = $(this).data('comment-id');

            $("#input-comment-id").val(comment_id);
        });
    </script>
@endsection
