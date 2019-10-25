@extends("layouts.app",['title'=>$post->gen_seo_title()])
@section("content")


    {{--https://webdevetc.com/laravel/packages/blogetc-blog-system-for-your-laravel-app/help-documentation/laravel-blog-package-blogetc#guide_to_views--}}

    <div class='container'>
    <div class='row'>
        <div class='col-sm-12 col-md-12 col-lg-12'>

            @include("blogetc::partials.show_errors")
            @include("blogetc::partials.full_post_details")


            @if(config("blogetc.comments.type_of_comments_to_show","built_in") !== 'disabled')
                <div class="" id='maincommentscontainer'>
                    <h2 class='text-center' id='blogetccomments'>Comments</h2>
                    @include("blogetc::partials.show_comments")
                </div>
            @else
                {{--Comments are disabled--}}
            @endif


        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#submitNestedComment', function (e) {
                e.preventDefault();
                var commentId    = $(this).data('comment_id');
                var commentValue = $('input[name="nestedComment"][data-comment_id="'+commentId+'"]').val();
                if (commentValue != '') {
                    var data = {
                        'commentID': commentId,
                        'commentValue': commentValue
                    }

                    var json = JSON.stringify(data);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: "POST",
                        url: '/save_comment_comment/' + commentId,
                        data: {json},
                        success: function (data) {
                            var data = JSON.parse(data);
                            var html = '<div class="commentNest" data-comment_id="'+data.commentId+'">'+
                                        '<p class="commentText">'+data.comment+'</p>'+
                                        '</div>';
                            $('#ajaxComments[data-comment_id="'+data.commentId+'"]').append(html);
                            $('input[name="nestedComment"][data-comment_id="'+data.commentId+'"]').val('');
                        }
                    });
                }
            });
        });
    </script>

@endsection