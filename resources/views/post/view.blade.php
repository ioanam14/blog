@extends('layouts.app')

@section('after-styles')
    {{ Html::style('css/custom_emojionearea.css') }}
@endsection

@section('content')
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

<!-- Display add comment section if the user is logged in -->
<div class="card">
    <div class="header"><h3>Comments</h3></div>

    @auth
        <div class="content">
            {{ Form::open(['route' => ['comment.add', $post->slug]]) }}
            {{ Form::textarea('content', null, ['id' => 'textarea-comment', 'class' => 'form-control', 'rows' => '5']) }}
            {{ Form::submit('Add', ['class' => 'btn-add btn btn-primary mt-2']) }}
            {{ Form::close() }}
        </div>
    @endauth

    @guest
        <div class="content text-center">
            Please <a href="{{ route('register') }}" class="font-weight-bold">register</a> to add comments
        </div>
    @endguest

    <div class="footer">

        @foreach ($comments as $comment)
            <div class="media mb-4">
                <img class="d-flex align-self-start mr-3 rounded-circle" src="https://d4n5pyzr6ibrc.cloudfront.net/media/27FB7F0C-9885-42A6-9E0C19C35242B5AC/4785B1C2-8734-405D-96DC23A6A32F256B/thul-90efb785-97af-5e51-94cf-503fc81b6940.jpg?response-content-disposition=inline" alt="Generic placeholder image" width="60">
                
                <div class="media-body">
                    <div class="d-flex justify-content-start">
                        <div class="p-2">
                            <h6>{{ $comment->user->name }}</h6>
                            <small>{{ $comment->updated_at->format('d M Y H:i') }}</small>
                        </div>
                        <div class="ml-auto p-2">

                            @if ($comment->is_mine)
                                <span class="dropdown">
                                    <span class="caret pointer dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false"></span>
                    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="btn-dropdown-edit dropdown-item" href="#" data-toggle="modal" data-target="#comment-edit" data-comment-id="{{ $comment->id }}">Edit</a>
                                        <a class="btn-dropdown-delete dropdown-item" href="#" data-toggle="modal" data-target="#comment-delete" data-comment-id="{{ $comment->id }}">Delete</a>
                                    </div>
                                </span>
                            @endif
                        
                        </div>
                    </div>
                    
                    <p id="content-{{ $comment->id }}">{!! $comment->content !!}</p>
                </div>
            </div>
        @endforeach
    
    </div>
</div>

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
                    {{ Form::hidden('comment-id', null, ['class' => 'input-comment-id']) }}
                    {{ Form::textarea('content', null, ['id' => 'textarea-comment-edit', 'class' => 'form-control'])}}
                </div>

                <div class="modal-footer">
                    {{ Form::submit('Save', ['class' => 'btn-save btn btn-success']) }}
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
                    {{ Form::hidden('comment-id', null, ['class' => 'input-comment-id']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
    <script src="{{ asset('js/custom_emojionearea.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#textarea-comment").emojioneArea(emojionearea_options);
            $("#textarea-comment-edit").emojioneArea(emojionearea_options);
        });

        $(".btn-add").click(function () {
            var emoji_text = $(".emojionearea-editor").html();
            $("#textarea-comment").val(emoji_text);
        });

        $(".btn-dropdown-edit").click(function () {
            var comment_id = $(this).data('comment-id');
            var comment_content = $("#content-" + comment_id).html();
            var textarea = $("#textarea-comment-edit").next().children(".emojionearea-editor");
            
            textarea.html(comment_content);
            $(".input-comment-id").val(comment_id);
        });

        $(".btn-dropdown-delete").click(function () {
            var comment_id = $(this).data('comment-id');
            $(".input-comment-id").val(comment_id);
        });

        $(".btn-save").click(function () {
            var emoji_text = $("#textarea-comment-edit").next().children(".emojionearea-editor").html();
            $("#textarea-comment-edit").val(emoji_text);
        });
    </script>
@endsection
