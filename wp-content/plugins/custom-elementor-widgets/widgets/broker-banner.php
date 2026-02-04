<?php
/**
 * Broker Banner Widget
 */
class Broker_Banner_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'broker_banner';
    }

    public function get_title() {
        return esc_html__( 'Custom Banner Section', 'broker-banner' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return [ 'broker-elements' ];
    }

    public function get_keywords() {
        return [ 'banner', 'broker', 'heading', 'button' ];
    }

    public function get_style_depends() {
        return [ 'cew-broker-banner-css' ];
    }

    protected function register_controls() {

        // Column Width Section
        $this->start_controls_section(
            'column_width_section',
            [
                'label' => esc_html__( 'Layout', 'broker-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'text_width',
            [
                'label' => esc_html__( 'Text Column Width', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 43,
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-text' => 'width: {{SIZE}}% !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Image Column Width', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-image' => 'width: {{SIZE}}% !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label' => esc_html__( 'Gap Between Columns', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-content' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'reverse_columns',
            [
                'label' => esc_html__( 'Reverse Columns', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'broker-banner' ),
                'label_off' => esc_html__( 'No', 'broker-banner' ),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__( 'Swap text and image positions', 'broker-banner' ),
            ]
        );

        $this->add_responsive_control(
            'vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Alignment', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'broker-banner' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'broker-banner' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'broker-banner' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-content' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Section - Heading
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'broker-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__( 'Heading', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Broker <span style="color:#3B9B39;">Driven</span><br>Fueled by <span style="color:#3B9B39;">Innovation</span>', 'broker-banner' ),
                'placeholder' => esc_html__( 'Type your heading here', 'broker-banner' ),
            ]
        );

        $this->end_controls_section();

        // Buttons Section
        $this->start_controls_section(
            'buttons_section',
            [
                'label' => esc_html__( 'Buttons', 'broker-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Button 1
        $this->add_control(
            'button1_text',
            [
                'label' => esc_html__( 'Button 1 Text', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Find a broker', 'broker-banner' ),
                'placeholder' => esc_html__( 'Enter button text', 'broker-banner' ),
            ]
        );

        $this->add_control(
            'button1_link',
            [
                'label' => esc_html__( 'Button 1 Link', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'broker-banner' ),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'button1_icon',
            [
                'label' => esc_html__( 'Button 1 Icon', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'button1_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        // Button 2
        $this->add_control(
            'button2_text',
            [
                'label' => esc_html__( 'Button 2 Text', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Get accredited', 'broker-banner' ),
                'placeholder' => esc_html__( 'Enter button text', 'broker-banner' ),
            ]
        );

        $this->add_control(
            'button2_link',
            [
                'label' => esc_html__( 'Button 2 Link', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'broker-banner' ),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'button2_icon',
            [
                'label' => esc_html__( 'Button 2 Icon', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();

        // Image Section
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__( 'Image', 'broker-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'banner_image',
            [
                'label' => esc_html__( 'Choose Image', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width_custom',
            [
                'label' => esc_html__( 'Image Width', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height_custom',
            [
                'label' => esc_html__( 'Image Height', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh', 'auto' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_object_fit',
            [
                'label' => esc_html__( 'Object Fit', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'fill' => esc_html__( 'Fill', 'broker-banner' ),
                    'cover' => esc_html__( 'Cover', 'broker-banner' ),
                    'contain' => esc_html__( 'Contain', 'broker-banner' ),
                    'scale-down' => esc_html__( 'Scale Down', 'broker-banner' ),
                    'none' => esc_html__( 'None', 'broker-banner' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-image img' => 'object-fit: {{VALUE}};',
                ],
                'condition' => [
                    'image_height_custom[size]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_alignment',
            [
                'label' => esc_html__( 'Image Alignment', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'broker-banner' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'broker-banner' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'broker-banner' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-image' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Heading
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__( 'Heading', 'broker-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .broker-banner-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Text Color', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Margin', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Buttons
        $this->start_controls_section(
            'buttons_style_section',
            [
                'label' => esc_html__( 'Buttons', 'broker-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .primary-btn',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '12',
                    'right' => '30',
                    'bottom' => '12',
                    'left' => '30',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_gap',
            [
                'label' => esc_html__( 'Gap Between Buttons', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-buttons' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        // Normal State
        $this->start_controls_tab(
            'button_normal',
            [
                'label' => esc_html__( 'Normal', 'broker-banner' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .primary-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__( 'Background Color', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3B9B39',
                'selectors' => [
                    '{{WRAPPER}} .primary-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => esc_html__( 'Hover', 'broker-banner' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primary-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .primary-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .primary-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Container
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => esc_html__( 'Container', 'broker-banner' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__( 'Padding', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_background_color',
            [
                'label' => esc_html__( 'Background Color', 'broker-banner' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .broker-banner-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $reverse_class = ( 'yes' === $settings['reverse_columns'] ) ? ' reverse-columns' : '';
        
        // Button 1 Link
        $button1_link = $settings['button1_link']['url'];
        $button1_target = $settings['button1_link']['is_external'] ? ' target="_blank"' : '';
        $button1_nofollow = $settings['button1_link']['nofollow'] ? ' rel="nofollow"' : '';

        // Button 2 Link
        $button2_link = $settings['button2_link']['url'];
        $button2_target = $settings['button2_link']['is_external'] ? ' target="_blank"' : '';
        $button2_nofollow = $settings['button2_link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>

<div class="broker-banner-container">
    <div class="broker-banner-content<?php echo esc_attr( $reverse_class ); ?>">
        <div class="broker-banner-text">
            <div class="broker-banner-heading">
                <?php echo $settings['heading']; ?>
            </div>

            <div class="broker-banner-buttons">
                <?php if ( ! empty( $settings['button1_text'] ) ) : ?>
                <a href="<?php echo esc_url( $button1_link ); ?>" class="primary-btn button-1"
                    <?php echo $button1_target . $button1_nofollow; ?>>
                    <span class="button-text"><?php echo esc_html( $settings['button1_text'] ); ?></span>
                    <?php if ( ! empty( $settings['button1_icon']['value'] ) ) : ?>
                    <span class="button-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['button1_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php endif; ?>
                </a>
                <?php endif; ?>

                <?php if ( ! empty( $settings['button2_text'] ) ) : ?>
                <a href="<?php echo esc_url( $button2_link ); ?>" class="primary-btn button-2"
                    <?php echo $button2_target . $button2_nofollow; ?>>
                    <span class="button-text"><?php echo esc_html( $settings['button2_text'] ); ?></span>
                    <?php if ( ! empty( $settings['button2_icon']['value'] ) ) : ?>
                    <span class="button-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['button2_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php endif; ?>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="broker-banner-image">
            <?php if ( ! empty( $settings['banner_image']['url'] ) ) : ?>
            <img src="<?php echo esc_url( $settings['banner_image']['url'] ); ?>" alt="">
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    }

    protected function content_template() {
        ?>
<# var button1_target=settings.button1_link.is_external ? ' target="_blank"' : '' ; var
    button1_nofollow=settings.button1_link.nofollow ? ' rel="nofollow"' : '' ; var
    button2_target=settings.button2_link.is_external ? ' target="_blank"' : '' ; var
    button2_nofollow=settings.button2_link.nofollow ? ' rel="nofollow"' : '' ; var
    reverse_class=( 'yes'===settings.reverse_columns ) ? ' reverse-columns' : '' ; #>

    <div class="broker-banner-container">
        <div class="broker-banner-content{{{ reverse_class }}}">
            <div class="broker-banner-text">
                <div class="broker-banner-heading">
                    {{{ settings.heading }}}
                </div>

                <div class="broker-banner-buttons">
                    <# if ( settings.button1_text ) { #>
                        <a href="{{ settings.button1_link.url }}" class="primary-btn button-1" {{{ button1_target }}}
                            {{{ button1_nofollow }}}>
                            <span class="button-text">{{{ settings.button1_text }}}</span>
                            <# if ( settings.button1_icon.value ) { #>
                                <span class="button-icon">
                                    <i class="{{ settings.button1_icon.value }}"></i>
                                </span>
                                <# } #>
                        </a>
                        <# } #>

                            <# if ( settings.button2_text ) { #>
                                <a href="{{ settings.button2_link.url }}" class="primary-btn button-2"
                                    {{{ button2_target }}} {{{ button2_nofollow }}}>
                                    <span class="button-text">{{{ settings.button2_text }}}</span>
                                    <# if ( settings.button2_icon.value ) { #>
                                        <span class="button-icon">
                                            <i class="{{ settings.button2_icon.value }}"></i>
                                        </span>
                                        <# } #>
                                </a>
                                <# } #>
                </div>
            </div>

            <div class="broker-banner-image">
                <# if ( settings.banner_image.url ) { #>
                    <img src="{{ settings.banner_image.url }}" alt="">
                    <# } #>
            </div>
        </div>
    </div>
    <?php
    }
}