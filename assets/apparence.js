
(function ($) {
   wp.customize('header_background' , function (valeur) {
       valeur.bind(function (newVal) {
            $('.navbar').attr('style', 'background:' + newVal + '!important')
        });
    });
}),



(function ($) {
   wp.customize('footer_background' , function (valeur) {
       valeur.bind(function (newVal) {
            $('.navbar').attr('style', 'background:' + newVal + '!important')
        });
    });
}),

(function ($) {
    wp.customize('body_background' , function (valeur) {
        valeur.bind(function (newVal) {
             $('.body').attr('style', 'background:' + newVal + '!important')
         });
     });
 }),

    

(jQuery);


