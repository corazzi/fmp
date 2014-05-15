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


 jQuery(function () {

    // home page animation
    var animationIndex = document.getElementById('welcome-text');

    animationIndex.addEventListener("webkitAnimationEnd", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationIndex.addEventListener("mozAnimationEnd", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationIndex.addEventListener("MSAnimationEnd", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationIndex.addEventListener("oanimationend", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });
    animationIndex.addEventListener("animationend", function () {
        $('#welcome-image')
            .addClass('animated bounceInUp show-image');
    });


});
