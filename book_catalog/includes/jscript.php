<script>
    $(document).ready(function () {

    //When mouse rolls over
    $(".wrap").mouseover(function(){
        $(this).stop().animate({height:'80px'},{queue:false, duration:600, easing: ''})
    });

    //When mouse is removed
    $(".wrap").mouseout(function(){
        $(this).stop().animate({height:'30px'},{queue:false, duration:600, easing: ''})
    });

    });
</script>