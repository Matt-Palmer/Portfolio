$(document).ready(function(){

    var isOpen = false;

    $('#open-nav').click(function(){

        if(!isOpen){
            $('.nav-content-container').addClass('open');
            isOpen = true;
        }else{
            $('.nav-content-container').removeClass('open');
            isOpen = false;
        }

    })


    $('#prev-page').click(function(){
        parent.history.back();
        return false;
    });


});
