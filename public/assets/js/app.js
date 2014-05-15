$(function() {
    
    $(document).foundation();

    $('#resize').autosize();

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


});

