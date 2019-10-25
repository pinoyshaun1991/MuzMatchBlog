@forelse($comments as $comment)



    <div class="card bg-light mb-3">
        <div class="card-header">
            {{$comment->author()}}

            @if(config("blogetc.comments.ask_for_author_website") && $comment->author_website)
                (<a href='{{$comment->author_website}}' target='_blank' rel='noopener'>website</a>)
            @endif

            <span class="float-right" title='{{$comment->created_at}}'><small>{{$comment->created_at->diffForHumans()}}</small></span>
        </div>
        <div class="card-body bg-white">
            <p class="card-text">{!! nl2br(e($comment->comment))!!}</p>
        </div>

        @if($comment->comment_comments !== 'null')
            @php $commentsArray = json_decode($comment->comment_comments); @endphp
            @php foreach ($commentsArray as $commentText) : @endphp
                <div class="commentNest" data-comment_id="{{$comment->id}}">
                    <p class="commentText">{{$commentText->comment}}</p>
                </div>
            @php endforeach; @endphp
            @else
            <div class="commentNest" data-comment_id="{{$comment->id}}">
                <p class="commentText"></p>
            </div>
        @endif
        <div id="ajaxComments" data-comment_id="{{$comment->id}}"></div>
        <div id="nestedComment">
            <input data-comment_id="{{$comment->id}}" style="width: 100%;" placeholder="Comment here..." type="text" name="nestedComment">
            <button style="margin-right: 7pt;" data-comment_id="{{$comment->id}}" id="submitNestedComment">Post</button>
        </div>
    </div>





@empty
    <div class='alert alert-info'>No comments yet! Why don't you be the first?</div>
@endforelse

<div class="card bg-light mb-3" id="updateRealTime" style="display: none;">
    <div class="card-header">

        <span class="float-right" title=""><small></small></span>
    </div>
    <div class="card-body bg-white">
        <p class="card-text"></p>
    </div>
    @if(isset($comment))
        @if($comment->comment_comments !== 'null')
            @php $commentsArray = json_decode($comment->comment_comments); @endphp
            @php foreach ($commentsArray as $commentText) : @endphp
            <div class="commentNest" data-comment_id="{{$comment->id}}">
                <p class="commentText">{{$commentText->comment}}</p>
            </div>
            @php endforeach; @endphp
        @else
            <div class="commentNest" data-comment_id="{{$comment->id}}">
                <p class="commentText"></p>
            </div>
        @endif
        <div id="ajaxComments" data-comment_id="{{$comment->id}}"></div>
        <div id="nestedComment">
            <input data-comment_id="{{$comment->id}}" style="width: 100%;" placeholder="Comment here..." type="text" name="nestedComment">
            <button style="margin-right: 7pt;" data-comment_id="{{$comment->id}}" id="submitNestedComment">Post</button>
        </div>
    </div>
    @endif
</div>

@if(count($comments)> config("blogetc.comments.max_num_of_comments_to_show",500) - 1)
    <p><em>Only the first {{config("blogetc.comments.max_num_of_comments_to_show",500)}} comments are
            shown.</em>
    </p>
@endif

