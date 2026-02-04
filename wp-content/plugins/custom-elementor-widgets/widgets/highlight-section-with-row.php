<?php
/**
 * Dynamic Rows Widget
 */
class Dynamic_Rows_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'dynamic_rows';
    }

    public function get_title() {
        return esc_html__( 'Custom Table Section', 'cew' );
    }

    public function get_icon() {
        return 'eicon-table';
    }

    public function get_categories() {
        return [ 'custom-elements' ];
    }

    public function get_keywords() {
        return [ 'rows', 'table', 'heading', 'content', 'list' ];
    }

    public function get_style_depends() {
        return [ 'cew-highlight-section-css' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Rows', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'row_heading',
            [
                'label' => esc_html__( 'Heading', 'cew' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Row Heading', 'cew' ),
                'placeholder' => esc_html__( 'Enter heading', 'cew' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'row_content',
            [
                'label' => esc_html__( 'Content', 'cew' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Add your content here. You can use HTML, bullet points, and formatting.', 'cew' ),
                'placeholder' => esc_html__( 'Type your content here', 'cew' ),
            ]
        );

        $repeater->add_control(
            'show_divider',
            [
                'label' => esc_html__( 'Show Bottom Divider', 'cew' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'cew' ),
                'label_off' => esc_html__( 'No', 'cew' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'rows_list',
            [
                'label' => esc_html__( 'Add Rows', 'cew' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'row_heading' => esc_html__( 'Heading 1', 'cew' ),
                        'row_content' => 'This is content',
                        'show_divider' => 'yes',
                    ],
                    [
                        'row_heading' => esc_html__( 'Heading 2', 'cew' ),
                        'row_content' => 'This is content',
                        'show_divider' => 'no',
                    ],
                ],
                'title_field' => '{{{ row_heading }}}',
            ]
        );

        $this->end_controls_section();

        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'heading_width',
            [
                'label' => esc_html__( 'Heading Column Width', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-heading' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__( 'Content Column Width', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 50,
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 65,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => esc_html__( 'Gap Between Columns', 'cew' ),
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
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_spacing',
            [
                'label' => esc_html__( 'Spacing Between Rows', 'cew' ),
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
                    '{{WRAPPER}} .dynamic-row' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .dynamic-row-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Text Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_background_color',
            [
                'label' => esc_html__( 'Background Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F5F5F5',
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'cew' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '30',
                    'right' => '30',
                    'bottom' => '30',
                    'left' => '30',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_alignment',
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
                    '{{WRAPPER}} .dynamic-row-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Content
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Content', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .dynamic-row-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Text Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_background_color',
            [
                'label' => esc_html__( 'Background Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'cew' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '30',
                    'right' => '30',
                    'bottom' => '30',
                    'left' => '30',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Divider
        $this->start_controls_section(
            'divider_style_section',
            [
                'label' => esc_html__( 'Divider', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => esc_html__( 'Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#E0E0E0',
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row.has-divider' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_width',
            [
                'label' => esc_html__( 'Width', 'cew' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dynamic-row.has-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Container
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => esc_html__( 'Container', 'cew' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__( 'Padding', 'cew' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dynamic-rows-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_background_color',
            [
                'label' => esc_html__( 'Background Color', 'cew' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dynamic-rows-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['rows_list'] ) ) {
            return;
        }
        ?>

<div class="dynamic-rows-container">
    <?php foreach ( $settings['rows_list'] as $index => $item ) : 
                $divider_class = ( 'yes' === $item['show_divider'] ) ? ' has-divider' : '';
            ?>
    <div class="dynamic-row<?php echo esc_attr( $divider_class ); ?>">
        <div class="dynamic-row-heading">
            <?php echo esc_html( $item['row_heading'] ); ?>
        </div>
        <div class="dynamic-row-content">
            <?php echo wp_kses_post( $item['row_content'] ); ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
    }

    protected function content_template() {
        ?>
<# if ( settings.rows_list.length ) { #>
    <div class="dynamic-rows-container">
        <# _.each( settings.rows_list, function( item, index ) { var dividerClass=( 'yes'===item.show_divider )
            ? ' has-divider' : '' ; #>
            <div class="dynamic-row{{{ dividerClass }}}">
                <div class="dynamic-row-heading">
                    {{{ item.row_heading }}}
                </div>
                <div class="dynamic-row-content">
                    {{{ item.row_content }}}
                </div>
            </div>
            <# }); #>
    </div>
    <# } #>
        <?php
    }
}