<span id="commentPlacement"></span>
<div class='add_comment_area'>
    <h5 class='text-center'>Add a comment</h5>
    <form id="commentForm" method='post' action='{{route("blogetc.comments.add_new_comment", $post->slug)}}'>
        @csrf


        <div class="form-group ">

            <label id="comment_label" for="comment">Your Comment </label>
                    <textarea
                            class="form-control"
                            name='comment'
                            required
                            id="comment"
                            placeholder="Write your comment here"
                            rows="7">{{old("comment")}}</textarea>


        </div>

        <div class='container-fluid'>
            <div class='row'>

                @if(config("blogetc.comments.save_user_id_if_logged_in", true) == false || !\Auth::check())

                    <div class='col'>
                        <div class="form-group ">
                            <label id="author_name_label" for="author_name">Your Name </label>
                            <input
                                    type='text'
                                    class="form-control"
                                    name='author_name'
                                    id="author_name"
                                    placeholder="Your name"
                                    required
                                    value="{{old("author_name")}}">
                        </div>
                    </div>

                    @if(config("blogetc.comments.ask_for_author_email"))
                        <div class='col'>
                            <div class="form-group">
                                <label id="author_email_label" for="author_email">Your Email
                                    <small>(won't be displayed publicly)</small>
                                </label>
                                <input
                                        type='email'
                                        class="form-control"
                                        name='author_email'
                                        id="author_email"
                                        placeholder="Your Email"
                                        required
                                        value="{{old("author_email")}}">
                            </div>
                        </div>
                    @endif
                @endif


                @if(config("blogetc.comments.ask_for_author_website"))
                    <div class='col'>
                        <div class="form-group">
                            <label id="author_website_label" for="author_website">Your Website
                                <small>(Will be displayed)</small>
                            </label>
                            <input
                                    type='url'
                                    class="form-control"
                                    name='author_website'
                                    id="author_website"
                                    placeholder="Your Website URL"
                                    value="{{old("author_website")}}">
                        </div>
                    </div>

                @endif
            </div>
        </div>


        @if($captcha)
            {{--Captcha is enabled. Load the type class, and then include the view as defined in the captcha class --}}
            @include($captcha->view())
        @endif


        <div class="form-group ">
            <input id="commentSubmit" type='submit' class="form-control input-sm btn btn-success "
                   value='Add Comment'>
        </div>

    </form>
</div>

@if($stackType == 1)
    <script>
        $(document).ready(function() {
            $('#commentSubmit').on('click', function (e) {
                e.preventDefault();
                var commentDataArray = $('#commentForm').serializeArray();


                var acceptedData  = {
                    "blog_etc_post_id": @json($post->id),
                    "user_id": @json($user),
                    "ip": '127.0.0.1',
                    "author_name": '',
                    "comment": '',
                    "approved": '1',
                    "author_email": @json($email),
                    "author_website": ''
                };
                let acceptedArray = [];

                $.each(acceptedData, function(key, valueAccepted) {
                    acceptedArray.push(key);
                });

                $.each(commentDataArray, function (index, value) {
                    if ($.inArray(value.name, acceptedArray) > 0) {
                        acceptedData[value.name] = value.value;
                    }
                });

                if (acceptedData['comment'] == '') {
                    acceptedData['comment'] = 'This is a test node comment';
                }

                var since = new Date();

                function pad(number) {
                    if ( number < 10 ) {
                        return '0' + number;
                    }
                    return number;
                }

                var createdDate = pad(since.getFullYear())+'-'+pad(since.getMonth()+1)+'-'+since.getDate()+' '+ pad(since.getHours())+':'+pad(since.getMinutes())+':'+pad(since.getSeconds());

                acceptedData['created_at']       = createdDate;
                acceptedData['updated_at']       = createdDate;
                acceptedData['comment_comments'] = 'null';

                let json = JSON.stringify(acceptedData);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/ajaxRequestCommentJson",
                    data: {json},
                    success:function(data) {
                        alert('JSON created! Please run "node resources/js/connection.js" through the terminal');
                        setTimeout(function() {
                            document.location.reload(true);
                        }, 5000);
                    }
                });
            });
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#commentSubmit').on('click', function (e) {
            e.preventDefault();

            if ($('textarea[name="comment"]').val() === '') {
                alert('Comment is required');
            }

            if ($('input[name="author_name"]').val() === '') {
                alert('Name is required');
            }

            if ($('input[name="author_email"]').val() === '') {
                alert('Email is required');
            }

            var commentDataArray = $('#commentForm').serializeArray();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if ($('textarea[name="comment"]').val() !== '' && $('input[name="author_name"]').val() !== '' && $('input[name="author_email"]').val() !== '') {
                var acceptedData = {
                    "author_name": $('input[name="author_name"]').val(),
                    "comment": '',
                    "author_email": $('input[name="author_email"]').val(),
                    "author_website": ''
                };

                let acceptedArray = [];

                $.each(acceptedData, function (key, valueAccepted) {
                    acceptedArray.push(key);
                });

                $.each(commentDataArray, function (index, value) {
                    if ($.inArray(value.name, acceptedArray) > 0) {
                        acceptedData[value.name] = value.value;
                    }
                });

                acceptedData['comment_comments'] = 'null';

                var json = JSON.stringify(acceptedData);

                $.ajax({
                    method: "POST",
                    url: @json("/save_comment_ajax/".$post->slug),
                    data: {json},
                    success: function (data) {
                        var data = JSON.parse(data);
                        $('#updateRealTime .card-body p.card-text').text(data.comment);
                        $('#updateRealTime .card-header').text(data.author_name);
                        $('#updateRealTime .card-header .float-right').text(data.created_at);
                        $('#updateRealTime').show();

                        $('#commentForm').trigger("reset");
                    }
                });
            }
        });
    });
</script>
