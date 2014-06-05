var app = function() {

    var init = function() {
        menu();

    };

    var menu = function() {
        $("#side-navigation .sub-menu > a").click(function(e) {
            $("#side-navigation ul ul").slideUp();
            if (!$(this).next().is(":visible")) {
                $(this).next().slideDown();
            }
              e.stopPropagation();
        });
    };


    return {
        init: init
    };


}();

//Load global functions
$(document).ready(function() {
    app.init();

});
