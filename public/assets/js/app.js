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


    // text area auto resize
    $('#snippet').autosize(); 

    //code hightlight
    $('pre code').each(function(i, e) {hljs.highlightBlock(e)});




    maxCharacters = 255;

    $('.char-count').text(maxCharacters);

    $('textarea').bind('keyup keydown', function() {
        var count = $('.char-count');
        var characters = $(this).val().length;
    
        if (characters > maxCharacters) {
            count.addClass('char-over');
        } else {
            count.removeClass('char-over');
        }
    
       count.text(maxCharacters - characters);
      });







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


