/**
 * Created by kino-mo.com
 */
$(document).on('ready', function () {
    /*display/hidden form*/
    if ($('input').is('#pre-book')){
        $('#pre-book').on('click', function () {
            $('.wpcf7-form').toggleClass('hidden');
        })
    }
    /* small comments */
    if ($('span').is('.wall-primary-place .wpcf7-list-item-label')){
        $('.wall-primary-place .wpcf7-list-item-label').each(function(indx, element){

            var str= $(element).html();
            var tmp = str.replace(/\(|\)/gm, function(el){
                if ( el == '(' ) return '<small>(';
                return ')</small>';
            });

            $(element).html(tmp);

        });
    }






});