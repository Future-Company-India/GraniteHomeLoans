jQuery(document).ready(function ($) {

    var items = $('.productItem');
    var lightboxGroup = 'service-grid';

    items.find('img').on('click', function (e) {
        e.preventDefault();

        $('.elementor-dynamic-lightbox').remove();

        var startIndex = items.index($(this).closest('.productItem'));

        items.each(function () {
            var img = $(this).find('img');
            var title = $(this).find('.p-title').first().text();

            var link = $('<a>', {
                href: img.attr('src'),
                class: 'elementor-dynamic-lightbox',
                css: { display: 'none' },
                'data-elementor-open-lightbox': 'yes',
                'data-elementor-lightbox-slideshow': lightboxGroup,
                'data-elementor-lightbox-title': title
            });

            $('body').append(link);
        });

        $('.elementor-dynamic-lightbox').eq(startIndex).trigger('click');
    });

});
