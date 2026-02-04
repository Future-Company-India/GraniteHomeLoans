<?php
/**
 * Icon Heading Widget
 */
class Icon_Heading_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'icon_heading';
    }

    public function get_title() {
        return esc_html__( 'Custom Image with Text', 'cew' );
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    public function get_categories() {
        return [ 'custom-elements' ];
    }

    public function get_keywords() {
        return [ 'heading', 'icon', 'title', 'underline' ];
    }

    public function get_style_depends() {
        return [ 'cew-icon-heading-css' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label' => esc_html__( 'Heading Text', 'cew' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Hello World!', 'cew' ),
                'placeholder' => esc_html__( 'Enter your heading', 'cew' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'heading_image',
            [
                'label' => esc_html__( 'Image', 'cew' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'cew' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'cew' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'cew' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'cew' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'cew' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Image
        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => esc_html__( 'Image', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Size', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__( 'Spacing', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Heading
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__( 'Heading', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .icon-heading-text',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Text Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Underline
        $this->start_controls_section(
            'underline_style_section',
            [
                'label' => esc_html__( 'Underline', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'underline_color',
            [
                'label' => esc_html__( 'Underline Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#28a745', // Default green color
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-container' => '--icon-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'underline_height',
            [
                'label' => esc_html__( 'Height', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-text::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'underline_spacing',
            [
                'label' => esc_html__( 'Top Spacing', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-heading-text::after' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $html_tag = $settings['html_tag'];
        ?>

<div class="icon-heading-wrapper">
    <div class="icon-heading-container">
        <?php if ( ! empty( $settings['heading_image']['url'] ) ) : ?>
        <div class="icon-heading-icon">
            <img src="<?php echo esc_url( $settings['heading_image']['url'] ); ?>"
                alt="<?php echo esc_attr( strip_tags( $settings['heading_text'] ) ); ?>">
        </div>
        <?php endif; ?>

        <<?php echo esc_attr( $html_tag ); ?> class="icon-heading-text">
            <?php echo wp_kses_post( $settings['heading_text'] ); ?>
        </<?php echo esc_attr( $html_tag ); ?>>
    </div>
</div>

<?php
    }

    protected function content_template() {
        ?>
<div class="icon-heading-wrapper">
    <div class="icon-heading-container">
        <# if ( settings.heading_image.url ) { #>
            <div class="icon-heading-icon">
                <img src="{{ settings.heading_image.url }}" alt="{{ settings.heading_text }}">
            </div>
            <# } #>

                <{{{ settings.html_tag }}} class="icon-heading-text">
                    {{{ settings.heading_text }}}
                </{{{ settings.html_tag }}}>
    </div>
</div>
<?php
    }
}