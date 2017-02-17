$(document).ready(function() {
    console.log("READY!!!");

    $('.dropdown-toggle').dropdown();

    $('#categories ul li a').on('click', function(e) {
        e.preventDefault();
        var category = $(this).attr('class');

        $('html, body').animate({
            scrollTop: $("#"+category).offset().top - 50
        }, 1000);
    });

    $(window).on("scroll", function() {
        setTimeout(function () {
            var pageOffset = $(document).scrollTop();
            var currentElement = '';
            
            $('h2').each(function() {
                var elementOffset = $(this).offset().top;

                if (elementOffset - pageOffset - 50 <= 0) {
                    currentElement = $(this).attr('id');
                }
            });

            //console.log($('#'+currentElement).html());

            $('.dropdown-current').html($('#'+currentElement).html());

        }, 100); 
    });
});