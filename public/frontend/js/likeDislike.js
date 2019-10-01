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