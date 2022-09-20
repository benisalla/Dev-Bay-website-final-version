$(document).ready(function(){
    $('.display_more').click(function(){
        var numOfRows = Number($('#numOfRows').val());
        var allRows = Number($('#allRows').val());
        numOfRows = numOfRows + 4;
        if(numOfRows < allRows){
            $("#numOfRows").val(numOfRows);
            $.ajax({
                url: $('#fileName').val(),
                type: 'POST',
                data: {numOfRows:numOfRows},
                beforeSend:function(){
                    $(".display_more").html("<i class='fa fa-spinner rotating'></i>");
                },
                success: function(response){
                    setTimeout(function() {
                        $(".data_class:last").after(response).show().fadeIn("slow");
                        var isEnd = numOfRows + 4;
                        if(isEnd >= allRows){
                            $('.display_more').html("<i class='fa fa-chevron-up text-light'></i>");
                            $('.display_more').css("background","#d00");
                            $('.shortHint').text("Show less");
                        }else{
                            $(".display_more").html("<i class='fa fa-chevron-down'></i>");
                        }
                    }, 1500);
                }
            });
        }else{
            $('.display_more').html("<i class='fa fa-spinner rotating'></i>");
            setTimeout(function() {
                $('.data_class:nth-child(4)').nextAll('.data_class').remove().fadeIn("slow");
                $("#numOfRows").val(0);
                $('.display_more').html("<i class='fa fa-chevron-down'></i>");
                $('.display_more').css("background","");
                $('.shortHint').text("Show More ...");
            }, 1500);
        }
    });
});