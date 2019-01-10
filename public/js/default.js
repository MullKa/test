$(window).scroll(function() {
    let menu = $('#menu');
    if ($(this).scrollTop() > 50) {
        // menu.addClass(' menu-minimized');

        let width_m = '80%';
        let bblr_m = '20px';
        let bbrr_m = '20px';
        let prop = {
            'width' : width_m,
            'border-bottom-left-radius' : bblr_m,
            'border-bottom-right-radius' : bbrr_m
        };
        menu.animate(prop, 200)
    } if ($(this).scrollTop() < 50){
        // menu.removeClass(' menu-minimized');
        let width_d = '95%';
        let bblr_d = '0px';
        let bbrr_d = '0px';
        let prop = {
            'width' : width_d,
            'border-bottom-left-radius' : bblr_d,
            'border-bottom-right-radius' : bbrr_d
        };
        menu.animate(prop, 200)
    }
});