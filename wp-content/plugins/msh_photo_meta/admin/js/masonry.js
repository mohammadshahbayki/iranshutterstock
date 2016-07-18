jQuery(document).ready(function($){
    $('.grid').masonry({
        // set itemSelector so .grid-sizer is not used in layout
        itemSelector: '.grid-item',
        columnWidth: 200

    });
});
