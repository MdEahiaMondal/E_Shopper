
@foreach($comments as $comment)
    <ul>
        <input type="hidden" id="comment_id" value="{{ $comment->id }}">
        <li>
            <a href=""><i class="fa fa-user"></i>{{ $comment->name }}</a>
        </li>

        <li>
            <a href=""><i class="fa fa-clock-o"></i>{{ $comment->created_at->diffForHumans() }}</a>
        </li>

       <p>
            @for ( $i = 1; $i <= $comment->star_rating; $i++)
                <i style='color: gold' class='fa fa-star'></i>
            @endfor
       </p>

       <li>
           {{ $comment->body }}
       </li>

        <br>
        <br>
        <li>
            <p>Was this review helpful to you?</p>
        </li>


        <?php
        $likes = \App\LikeUnlike::where('comment_id',$comment->id)->get();
        $like_count = 0;
        $dislike_count = 0;
        $likeButton = "btn-secondary";
        $dislikeButton = "btn-secondary";
        ?>

        @foreach($likes as $like)

            @php
                if ($like->like == 1)
                    $like_count++;
            if ($like->like == 0)
                $dislike_count++;
            if(Auth::check()){
                if($like->like == 1 && $like->user_id == Auth::id())
                    $likeButton = "btn-warning";
                if($like->like == 0 && $like->user_id == Auth::id())
                    $dislikeButton = "btn-danger";
            }
            @endphp
        @endforeach



        <p>
        <span>
            <button type="button"   data-comment_id="{{$comment->id}}_l" data-like="{{$likeButton}}" class="like btn {{ $likeButton }} ">
                <i class="fa fa-thumbs-up"></i>  <small class="like_count"> {{ $like_count }}</small> <b> Liks </b>
            </button>

             <button type="button"   data-comment_id="{{$comment->id}}_d" data-like="{{$likeButton}}" class="dislike btn {{ $dislikeButton }}" >
                  <i class="fa fa-thumbs-down"></i> <b><small class="dislike_count"> {{ $dislike_count }} </small></b> <span> Dislikes </span>
              </button>
        </span>
        </p>
    </ul>

@endforeach

<script>

    var likeUrl = "{{route('like')}}";
    var dislikeUrl = "{{route('dislike')}}";
    var token = "{{Session::token()}}";

    $(".like").on('click', function (event) {
        var like_s = $(this).attr('data-like');
        var comment_id_l = $(this).attr('data-comment_id');// value come here like (3_l)
        var comment_id = comment_id_l.slice(0,-2);
        $.ajax({
            url: likeUrl,
            type: "POST",
            data:{like_s:like_s,  comment_id:comment_id,  _token:token},
            success: function (data) {
                if(data.is_like == 1){
                    // change the button color
                    $('*[data-comment_id="'+comment_id+'_l"]').removeClass('btn-secondary').addClass('btn-warning');
                    $('*[data-comment_id="'+comment_id+'_d"]').removeClass('btn-danger').addClass('btn-secondary');

                    // now need to change a count value(+)
                    var cu_like =  $('*[data-comment_id="'+ comment_id +'_l"]').find('.like_count').text();
                    var new_like = parseInt(cu_like) + 1;
                    $('*[data-comment_id="'+ comment_id +'_l"]').find('.like_count').text(new_like);

                    if(data.change_like == 1){
                        // now need to change a count value(+)
                        var cu_dislike =  $('*[data-comment_id="'+ comment_id +'_d"]').find('.dislike_count').text();
                        var new_dislike = parseInt(cu_dislike) - 1;
                        $('*[data-comment_id="'+ comment_id +'_d"]').find('.dislike_count').text(new_dislike);
                    }
                }

                if (data.is_like == 0) {
                    $('*[data-comment_id="'+ comment_id +'_l"]').removeClass('btn-warning').addClass('btn-secondary');

                    // now need to change a count value(-)
                    var cu_like =  $('*[data-comment_id="'+ comment_id +'_l"]').find('.like_count').text();
                    var new_like = parseInt(cu_like) - 1;
                    $('*[data-comment_id="'+ comment_id +'_l"]').find('.like_count').text(new_like);
                }
            }// end of success
        });
    });

    // end of like system

// start dislike system
    $(".dislike").on('click', function (event) {

        var like_s = $(this).attr('data-like');
        var comment_id_d = $(this).attr('data-comment_id');// value come here like (3_l)
        var comment_id = comment_id_d.slice(0,-2);
        $.ajax({
            url: dislikeUrl,
            type: "POST",
            data:{like_s:like_s,  comment_id:comment_id,  _token:token},
            success: function (data) {
                if(data.is_dislike == 1){
                    $('*[data-comment_id="'+comment_id+'_d"]').removeClass('btn-secondary').addClass('btn-danger');
                    $('*[data-comment_id="'+comment_id+'_l"]').removeClass('btn-warning').addClass('btn-secondary');

                    // now need to change a count value(+)
                    var cu_dislike =  $('*[data-comment_id="'+ comment_id +'_d"]').find('.dislike_count').text();
                    var new_dislike = parseInt(cu_dislike) + 1;
                    $('*[data-comment_id="'+ comment_id +'_d"]').find('.dislike_count').text(new_dislike);

                    if(data.change_dislike == 1){
                        // now need to change a count value(-)  in tis line only for problem solve::whene we click the dislike button it increment automatice fo that or
                        var cu_like =  $('*[data-comment_id="'+ comment_id +'_l"]').find('.like_count').text();
                        var new_like = parseInt(cu_like) - 1;
                        $('*[data-comment_id="'+ comment_id +'_l"]').find('.like_count').text(new_like);
                    }
                }

                if (data.is_dislike == 0) {
                    $('*[data-comment_id="'+comment_id+'_d"]').removeClass('btn-danger').addClass('btn-secondary');

                    // now need to change a count value(-)
                    var cu_dislike =  $('*[data-comment_id="'+ comment_id +'_d"]').find('.dislike_count').text();
                    var new_dislike = parseInt(cu_dislike) - 1;
                    $('*[data-comment_id="'+ comment_id +'_d"]').find('.dislike_count').text(new_dislike);
                }

            }// end of success

        });
    });




</script>


