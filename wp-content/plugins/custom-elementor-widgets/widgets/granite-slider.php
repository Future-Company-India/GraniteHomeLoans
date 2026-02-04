<?php
/**
 * Granite Slider Widget for Elementor
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Granite_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'granite_slider';
    }

    public function get_title() {
        return esc_html__('Custom Granite Slider', 'granite-slider');
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['slider', 'carousel', 'image', 'gallery', 'lightbox', 'granite'];
    }

    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Images', 'granite-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => esc_html__('Add Images', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Settings Section
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__('Slider Settings', 'granite-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'granite-slider'),
                'label_off' => esc_html__('No', 'granite-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_delay',
            [
                'label' => esc_html__('Autoplay Delay (ms)', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4000,
                'min' => 1000,
                'max' => 10000,
                'step' => 500,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_lightbox',
            [
                'label' => esc_html__('Enable Lightbox', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'granite-slider'),
                'label_off' => esc_html__('No', 'granite-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'enable_swipe',
            [
                'label' => esc_html__('Enable Touch Swipe', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'granite-slider'),
                'label_off' => esc_html__('No', 'granite-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_navigation',
            [
                'label' => esc_html__('Show Navigation Arrows', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'granite-slider'),
                'label_off' => esc_html__('No', 'granite-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => esc_html__('Show Dots Navigation', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'granite-slider'),
                'label_off' => esc_html__('No', 'granite-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_counter',
            [
                'label' => esc_html__('Show Slide Counter', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'granite-slider'),
                'label_off' => esc_html__('No', 'granite-slider'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Style Section - Slider Container
        $this->start_controls_section(
            'style_container_section',
            [
                'label' => esc_html__('Container', 'granite-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_height',
            [
                'label' => esc_html__('Height', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .granite-slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => esc_html__('Border Radius', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .granite-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => esc_html__('Box Shadow', 'granite-slider'),
                'selector' => '{{WRAPPER}} .granite-slider',
            ]
        );

        $this->end_controls_section();

        // Style Section - Navigation Arrows
        $this->start_controls_section(
            'style_navigation_section',
            [
                'label' => esc_html__('Navigation Arrows', 'granite-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_navigation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__('Color', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slider-nav' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_background',
            [
                'label' => esc_html__('Background Color', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 177, 64, 0.9)',
                'selectors' => [
                    '{{WRAPPER}} .slider-nav' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_background',
            [
                'label' => esc_html__('Hover Background Color', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00b140',
                'selectors' => [
                    '{{WRAPPER}} .slider-nav:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size',
            [
                'label' => esc_html__('Size', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-nav' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_font_size',
            [
                'label' => esc_html__('Icon Size', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 16,
                        'max' => 48,
                    ],
                ],
                'default' => [
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-nav' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Dots
        $this->start_controls_section(
            'style_dots_section',
            [
                'label' => esc_html__('Dots Navigation', 'granite-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => esc_html__('Inactive Color', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .slider-dot' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_active_color',
            [
                'label' => esc_html__('Active Color', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00b140',
                'selectors' => [
                    '{{WRAPPER}} .slider-dot.active' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_size',
            [
                'label' => esc_html__('Size', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Counter
        $this->start_controls_section(
            'style_counter_section',
            [
                'label' => esc_html__('Slide Counter', 'granite-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_counter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'counter_color',
            [
                'label' => esc_html__('Text Color', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slide-counter' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_background',
            [
                'label' => esc_html__('Background Color', 'granite-slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.7)',
                'selectors' => [
                    '{{WRAPPER}} .slide-counter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typography',
                'label' => esc_html__('Typography', 'granite-slider'),
                'selector' => '{{WRAPPER}} .slide-counter',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $gallery = $settings['gallery'];

        if (empty($gallery)) {
            echo '<div class="elementor-alert elementor-alert-warning">' . esc_html__('Please add some images to the gallery.', 'granite-slider') . '</div>';
            return;
        }

        $unique_id = 'granite-slider-' . $this->get_id();
        
        $slider_config = [
            'autoplay' => $settings['autoplay'] === 'yes',
            'autoplayDelay' => isset($settings['autoplay_delay']) ? intval($settings['autoplay_delay']) : 4000,
            'lightbox' => $settings['enable_lightbox'] === 'yes',
            'swipe' => $settings['enable_swipe'] === 'yes',
        ];

        ?>
<div class="granite-slider-wrapper">
    <div class="granite-slider" id="<?php echo esc_attr($unique_id); ?>">
        <div class="slider-track">
            <?php foreach ($gallery as $index => $image) : ?>
            <div class="slider-slide" data-index="<?php echo esc_attr($index); ?>">
                <?php echo wp_get_attachment_image($image['id'], 'full', false, ['alt' => 'Slide ' . ($index + 1)]); ?>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if ($settings['show_navigation'] === 'yes') : ?>
        <button class="slider-nav prev" aria-label="Previous Slide">‹</button>
        <button class="slider-nav next" aria-label="Next Slide">›</button>
        <?php endif; ?>

        <?php if ($settings['show_counter'] === 'yes') : ?>
        <div class="slide-counter">1/<?php echo count($gallery); ?></div>
        <?php endif; ?>

        <?php if ($settings['show_dots'] === 'yes') : ?>
        <div class="slider-dots"></div>
        <?php endif; ?>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    if (typeof GraniteSlider !== 'undefined') {
        new GraniteSlider('<?php echo esc_js($unique_id); ?>', <?php echo json_encode($slider_config); ?>);
    }
});
</script>
<?php
    }

    protected function content_template() {
        ?>
<# if (settings.gallery.length===0) { #>
    <div class="elementor-alert elementor-alert-warning">
        <?php echo esc_html__('Please add some images to the gallery.', 'granite-slider'); ?>
    </div>
    <# return; } var uniqueId='granite-slider-' + view.getID(); #>
        <div class="granite-slider-wrapper">
            <div class="granite-slider" id="{{ uniqueId }}">
                <div class="slider-track">
                    <# _.each(settings.gallery, function(image, index) { #>
                        <div class="slider-slide" data-index="{{ index }}">
                            <img src="{{ image.url }}" alt="Slide {{ index + 1 }}">
                        </div>
                        <# }); #>
                </div>

                <# if (settings.show_navigation==='yes' ) { #>
                    <button class="slider-nav prev" aria-label="Previous Slide">‹</button>
                    <button class="slider-nav next" aria-label="Next Slide">›</button>
                    <# } #>

                        <# if (settings.show_counter==='yes' ) { #>
                            <div class="slide-counter">1/{{ settings.gallery.length }}</div>
                            <# } #>

                                <# if (settings.show_dots==='yes' ) { #>
                                    <div class="slider-dots"></div>
                                    <# } #>
            </div>
        </div>
        <?php
    }
}