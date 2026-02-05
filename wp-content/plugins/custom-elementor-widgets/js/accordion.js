/**
 * Custom Accordion JavaScript
 */

(function ($) {
    'use strict';

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom_accordion.default', function ($scope) {
            const $wrapper = $scope.find('.custom-accordion-wrapper');
            const closeOthers = $wrapper.data('close-others');

            // Handle accordion click
            $wrapper.find('.custom-accordion-header').on('click', function () {
                const $item = $(this).closest('.custom-accordion-item');
                const $content = $item.find('.custom-accordion-content');
                const isActive = $item.hasClass('active');

                // If close others is enabled, close all other items
                if (closeOthers && !isActive) {
                    $wrapper.find('.custom-accordion-item').removeClass('active');
                    $wrapper.find('.custom-accordion-content').slideUp(300);
                }

                // Toggle current item
                if (isActive) {
                    $item.removeClass('active');
                    $content.slideUp(300);
                } else {
                    $item.addClass('active');
                    $content.slideDown(300);
                }
            });
        });
    });

})(jQuery);