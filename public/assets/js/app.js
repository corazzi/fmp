//foundation 

$(document).foundation();

//sticky footer

 $(window).bind("load", function () {
    var footer = $("#copyright");
    var pos = footer.position();
    var height = $(window).height();
    height = height - pos.top;
    height = height - footer.height();
    if (height > 0) {
        footer.css({
            'margin-top': height + 'px'
        });
    }
});  

//animate welcome header

jQuery(function () {

    var animationTest = document.getElementById('welcome-text');


    animationTest.addEventListener("webkitAnimationEnd", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationTest.addEventListener("mozAnimationEnd", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationTest.addEventListener("MSAnimationEnd", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationTest.addEventListener("oanimationend", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationTest.addEventListener("animationend", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });


});


