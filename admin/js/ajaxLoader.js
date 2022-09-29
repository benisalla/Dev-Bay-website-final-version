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

    $(document).on('click','.hide-search-btn', (event) => {
        $(".hide-search-content").removeClass("search-content-active");
    });


    function searcher(){
        const $index = $(".search-index").val().trim().toLowerCase();
        const $arr = $index.split(":");
        const $cond = ['post','user','testimonial','request'].indexOf($arr[0].trim()) != '-1';
        const $tool = $arr.length > 1 && $cond  ? $arr[0].trim() : 'all';
        const $label = $arr.length > 1 ? $arr[1].trim() : $index;

        console.log($label)

        if( $index != ''){
            $(".hide-search-content").addClass("search-content-active");
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {
                    label: $label,
                    tool: $tool,
                },
                beforeSend:function(){
                    $(".search-invoker").html("<i class='fa fa-spinner rotating'></i>");
                },
                success: function(response){
                    setTimeout(function() {
                        if(response != '__ERROR__'){
                            $(".search-result").html(response).show().fadeIn("slow");
                            $(".search-title").html("Search Result").show().fadeIn("slow");
                        }else{
                            $(".search-result").html("<h4 class='text-center'>(-_-)-_-_-_-_-_-_-_-_-_-_-_-_-_-</h4>").show().fadeIn("slow");
                            $(".search-title").html("No Result").show().fadeIn("slow");
                        }
                        
                        $(".search-invoker").html("<i class='fas fa-search'></i>");
                    }, 300);
                }
            });
        }
    }

    $(document).on('click','.search-invoker', (event) => {
        searcher();
    });

    let TypingTime = null;

    $(document).on('input', '.search-index', function() {
        clearTimeout(TypingTime);
        TypingTime = setTimeout(() => {
            searcher();
        }, 300);
    });

    let $message = '';
    let $i=0;
    $turn = 0;

    const $list1 = "post : post name".split('');
    const $list2 = "user : ismail".split('');
    const $list3 = "request : key word".split('');
    const $list4 = "testimonial : bilal".split('');

    const $allLists = [$list1,$list2,$list3,$list4];
    
    function GuideLineType($MyList){
        let $id = setInterval(()=>{
            $message += $MyList[$i++];
            console.log($message);
            $(".search-index").attr("placeholder",$message+"I");
            if($i == $MyList.length){
                $turn = $turn + 1;
                if($turn == 4){
                    clearInterval($id);
                }
                $(".search-index").attr("placeholder",$message+" I");
                $i = 0;
                $message = "";
                $MyList = $allLists[$turn];
            }
        }, 400);
    }

    setTimeout(() => {
        GuideLineType($list1);
    }, 2000);
});