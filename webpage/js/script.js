$(function() {

    $('header').find('a').hover(function(){
        $(this).css('color','aqua')
    },
    function(){
        $(this).css('color','black')
    });

    $('footer').find('a').hover(function(){
        $(this).css('color','gray')
    },
    function(){
        $(this).css('color','white')
    });

    $('a[href^=#]').click(function() {
        var time=400;
        var href=$(this).attr("href");
        var target=$(href=="#"||href=="" ? 'html': href);
        var position=target.offset().top;
        $('body,html').animate({scrollTop: position}, time, 'swing');
        return false;
    });

    $("li>ul>li").hover(function() {
        var result=$(this).parent().parent().removeClass('linked-item');
        return false;
    },
    function() {
        var result=$(this).parent().parent().addClass('linked-item');
        return false;
    });

});