$(document).ready(function () {
    $(document).on('click','.share_it',function () {
        $('.share_it').toggleClass('active');
        $('.share_post').toggleClass('active');
        setTimeout(() => {
            $('.share_post').toggleClass('active');
            $('.share_it').toggleClass('active');
        }, 2500);
    });

    $(document).on('click', '.reply-to-comment', function (event) {
        $('.reply-form').toggleClass('active');
        $.map($(".reply-form"), function (element, index) {
            if($(element).attr('id') != $(event.currentTarget).attr('id')){
                $(element).removeClass('active');
            }
        });
    });

    $(document).on('click','.reply-btn',function () {
        msg = $(".reply-form.active div .reply-message").val();
        author_id = $(".reply-form.active .author_id").val();
        comment_id = $(".reply-form.active .comment_id").val();
        code = $(".reply-form.active").attr('id');

        if(msg != ''){
            $.ajax({
                url: 'add_reply.php',
                type: 'POST',
                data: {
                    msg:msg,
                    author_id:author_id,
                    comment_id:comment_id
                },
                beforeSend:function(){},
                success: function(response){
                    setTimeout(function() {
                        $(".reply_"+code).html(response);
                    }, 1500);
                }
            });
        }
        $(".reply-form.active div .reply-message").val('');
        $('.reply-form.active').toggleClass('active');
    });

    $(document).on('click', '.display_more', function (event) {
        comment_id = Number($(event.currentTarget).attr('id'));
        display_more = $(".show_more_"+comment_id+" .display_more");
        numOfRows_element = $(".show_more_"+comment_id+" .numOfRows");
        allRows_element = $(".show_more_"+comment_id+" .allRows");
        fileName = $(".show_more_"+comment_id+" .fileName").val();

        allRows = Number($(allRows_element).val());
        numOfRows = Number($(numOfRows_element).val()) + 3;


        if(numOfRows < allRows){
            $(numOfRows_element).val(numOfRows);
            $.ajax({
                url: fileName,
                type: 'POST',
                data: {
                    numOfRows:numOfRows,
                    comment_id:comment_id
                },
                beforeSend:function(){
                    $(display_more).html("<i class='fa fa-spinner text-dark rotating'></i>");
                },
                success: function(response){
                    setTimeout(function() {

                        $(`.reply_data_class_${comment_id}:last`).after(response).show().fadeIn("slow");

                        var isEnd = numOfRows + 3;
                        if(isEnd >= allRows){
                            $(display_more).html("Show Less Replies");
                        }else{
                            $(display_more).html("Show More Replies");
                        }
                    }, 1000);
                }
            });
        }else{
            $(display_more).html("<i class='fa fa-spinner text-dark rotating'></i>");
            setTimeout(function() {
                $(`.reply_data_class_${comment_id}:nth-child(3)`).nextAll(`.reply_data_class_${comment_id}`).remove().fadeIn("slow");
                $(numOfRows_element).val(0);
                $(display_more).html("Show More Replies");
            }, 1000);
        }
    });


    $(document).on("click", ".display_more_comment", function (event) {
        post_id = Number($(".display_more_comment").attr('id'));
        numOfRows = Number($(".show_more_comment .numOfRows").val());
        allRows = Number($(".show_more_comment .allRows").val());
        fileName = $(".show_more_comment .fileName").val();

        numOfRows = numOfRows + 3;

        if(numOfRows < allRows){
            $(".show_more_comment .numOfRows").val(numOfRows);
            $.ajax({
                url: fileName,
                type: 'POST',
                data: {
                    numOfRows:numOfRows,
                    post_id:post_id
                },
                beforeSend:function(){
                    $(".display_more_comment").html("<i class='fa fa-spinner text-light rotating'></i>");
                },
                success: function(response){
                    setTimeout(function() {

                        $('.comment_data_class:last').after(response).show().fadeIn("slow");

                        var isEnd = numOfRows + 3;
                        if(isEnd >= allRows){
                            $(".display_more_comment").html('<i class="fa fa-chevron-up"></i>');
                            $(".more_comment_message").text('Show Less Comment');
                        }else{
                            $(".display_more_comment").html('<i class="fa fa-chevron-down"></i>');
                            $(".more_comment_message").text('Show More Comment');
                        }
                    }, 1000);
                }
            });
        }else{
            $(".display_more_comment").html("<i class='fa fa-spinner text-light rotating'></i>");
            setTimeout(function() {
                $($('.comment_data_class')[2]).nextAll('.comment_data_class').remove().fadeIn("slow");
                $(".show_more_comment .numOfRows").val(0);
                $(".display_more_comment").html('<i class="fa fa-chevron-down"></i>');
                $(".more_comment_message").text('Show More Comment');
            }, 500);
        }
    });


    $(document).on("click", ".add-comment-btn", function () {
        msg = $(".comment-message").val();
        author_id = $(".comment_author_id").val();
        post_id = $(".comment_post_id").val();

        if(msg != ''){
            $.ajax({
                url: 'add_comment.php',
                type: 'POST',
                data: {
                    msg:msg,
                    author_id:author_id,
                    post_id:post_id
                },
                beforeSend:function(){},
                success: function(response){
                    setTimeout(function() {
                        $(".comment-container").html(response);
                    }, 1000);
                }
            });
        }
        $(".comment-message").val('');
    });



    var PostReactTimer = null;

    function post_reactFunc(state){
        author_id = $('.author_id').val();
        post_id = $('.post_id').val();

        if(PostReactTimer != null)
            clearTimeout(PostReactTimer);

            PostReactTimer = setTimeout(()=>{
            $.ajax({
                type: "post",
                url: "post_reaction.php",
                data: {
                    author_id:author_id,
                    post_id:post_id,
                    state:state
                },
                success: function () {}
            });
        },4000);
    }

    $(document).on("click", '.post_like_it', function () {
        $(".post_like_it").toggleClass('active');
        $(".post_dislike_it").removeClass('active');

        state = $('.post_like_it').hasClass("active") ? 1 : 0;
        post_reactFunc(state);
    });
    $(document).on("click", '.post_dislike_it', function () {
        $(".post_dislike_it").toggleClass('active');
        $(".post_like_it").removeClass('active');

        state = $('.post_dislike_it').hasClass("active") ? -1 : 0;
        post_reactFunc(state);
    });




    function comment_reactFunc(state,comment_id,author_id){

        $.ajax({
            type: "post",
            url: "comment_reaction.php",
            data: {
                author_id:author_id,
                comment_id:comment_id,
                state:state
            },
            success: function () {}
        });
    }

    $(document).on("click", '.comment_like_it', function (event) {
        CRC = $(event.currentTarget).attr('iden');
        $(".comment_like_it."+CRC).toggleClass('active');
        
        numOfLikes = Number($("."+CRC+" .comment_like_num").text());
        numOfDisLikes = Number($("."+CRC+" .comment_dislike_num").text());

        author_id = $(event.currentTarget).attr('author');
        comment_id = $(event.currentTarget).attr('comment');

        state = $(".comment_like_it."+CRC).hasClass("active") ? 1 : 0;
        if(state == 1){
            $("."+CRC+" .comment_like_num").text(numOfLikes+1);
            if($(".comment_dislike_it."+CRC).hasClass('active'))
                $("."+CRC+" .comment_dislike_num").text(numOfDisLikes-1)
        }else{
            $("."+CRC+" .comment_like_num").text(numOfLikes-1);
        }

        
        comment_reactFunc(state,comment_id,author_id);
        $(".comment_dislike_it."+CRC).removeClass('active');
    });
    $(document).on("click", '.comment_dislike_it', function (event) {
        CRC = $(event.currentTarget).attr('iden');
        $(".comment_dislike_it."+CRC).toggleClass('active');
        

        numOfLikes = Number($("."+CRC+" .comment_like_num").text());
        numOfDisLikes = Number($("."+CRC+" .comment_dislike_num").text());

        author_id = $(event.currentTarget).attr('author');
        comment_id = $(event.currentTarget).attr('comment');
        state = $(".comment_dislike_it."+CRC).hasClass("active") ? -1 : 0;

        if(state == -1){
            $("."+CRC+" .comment_dislike_num").text(numOfDisLikes+1);
            if($(".comment_like_it."+CRC).hasClass('active'))
                $("."+CRC+" .comment_like_num").text(numOfLikes-1)
        }else{
            $("."+CRC+" .comment_dislike_num").text(numOfDisLikes-1);
        }

        comment_reactFunc(state,comment_id,author_id);
        $(".comment_like_it."+CRC).removeClass('active');
    });

});
