<?php
/**
 * Custom Accordion Widget
 */

if (!defined('ABSPATH')) {
    exit;
}

class Custom_Accordion_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'custom_accordion';
    }
    
    public function get_title() {
        return esc_html__('Custom Accordion', 'cew');
    }
    
    public function get_icon() {
        return 'eicon-accordion';
    }
    
    public function get_categories() {
        return ['custom-elements'];
    }
    
    public function get_keywords() {
        return ['accordion', 'toggle', 'faq', 'collapse'];
    }
    
    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Accordion Items', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'accordion_title',
            [
                'label' => esc_html__('Heading', 'cew'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Accordion Title', 'cew'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'accordion_content',
            [
                'label' => esc_html__('Content', 'cew'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Accordion content goes here. You can add formatted text, links, and more.', 'cew'),
                'show_label' => true,
            ]
        );
        
        $this->add_control(
            'accordion_items',
            [
                'label' => esc_html__('Items', 'cew'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__('Accordion Title', 'cew'),
                        'accordion_content' => esc_html__('Accordion content goes here. You can add formatted text, links, and more.', 'cew'),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );
        
        $this->end_controls_section();
        
        // Accordion Settings
        $this->start_controls_section(
            'accordion_settings',
            [
                'label' => esc_html__('Settings', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'open_first_item',
            [
                'label' => esc_html__('Open First Item by Default', 'cew'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'cew'),
                'label_off' => esc_html__('No', 'cew'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'close_others',
            [
                'label' => esc_html__('Close Others When Opening', 'cew'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'cew'),
                'label_off' => esc_html__('No', 'cew'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Only one accordion item open at a time', 'cew'),
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Accordion Item
        $this->start_controls_section(
            'accordion_item_style',
            [
                'label' => esc_html__('Accordion Item', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => esc_html__('Spacing Between Items', 'cew'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'item_background',
            [
                'label' => esc_html__('Background Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => esc_html__('Border', 'cew'),
                'selector' => '{{WRAPPER}} .custom-accordion-item',
            ]
        );
        
        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'cew'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'cew'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Title
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Title', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'cew'),
                'selector' => '{{WRAPPER}} .custom-accordion-title',
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Icon
        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => esc_html__('Toggle Icons', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'cew'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default SVG Icons', 'cew'),
                    'custom' => esc_html__('Custom PNG/Images', 'cew'),
                ],
            ]
        );
        
        $this->add_control(
            'open_icon',
            [
                'label' => esc_html__('Open Icon (Plus/Closed State)', 'cew'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'icon_type' => 'custom',
                ],
            ]
        );
        
        $this->add_control(
            'close_icon',
            [
                'label' => esc_html__('Close Icon (X/Open State)', 'cew'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'icon_type' => 'custom',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_position',
            [
                'label' => esc_html__('Icon Position', 'cew'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'cew'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'cew'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-header' => 'flex-direction: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left' => 'row-reverse',
                    'right' => 'row',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'cew'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 16,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'size' => 32,
                ],
                'tablet_default' => [
                    'size' => 28,
                ],
                'mobile_default' => [
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-toggle-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .custom-accordion-toggle-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .custom-accordion-toggle-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#5a9f3a',
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-toggle-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type' => 'default',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Spacing from Title', 'cew'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-toggle-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Content
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__('Content', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__('Typography', 'cew'),
                'selector' => '{{WRAPPER}} .custom-accordion-content',
            ]
        );
        
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'cew'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '0',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['accordion_items'])) {
            return;
        }
        
        $close_others = $settings['close_others'] === 'yes' ? 'true' : 'false';
        $icon_type = $settings['icon_type'];
        $open_icon_url = !empty($settings['open_icon']['url']) ? $settings['open_icon']['url'] : '';
        $close_icon_url = !empty($settings['close_icon']['url']) ? $settings['close_icon']['url'] : '';
        ?>

<div class="custom-accordion-wrapper" data-close-others="<?php echo esc_attr($close_others); ?>">
    <?php foreach ($settings['accordion_items'] as $index => $item) : 
                $is_first = $index === 0;
                $is_open = $is_first && $settings['open_first_item'] === 'yes';
                $item_id = 'accordion-item-' . $this->get_id() . '-' . $index;
            ?>
    <div class="custom-accordion-item <?php echo $is_open ? 'active' : ''; ?>">
        <div class="custom-accordion-header" data-accordion-id="<?php echo esc_attr($item_id); ?>">
            <div class="custom-accordion-title-wrapper">
                <span class="custom-accordion-title"><?php echo esc_html($item['accordion_title']); ?></span>
            </div>
            <span class="custom-accordion-toggle-icon">
                <?php if ($icon_type === 'custom' && $open_icon_url && $close_icon_url) : ?>
                <img src="<?php echo esc_url($open_icon_url); ?>" alt="<?php echo esc_attr__('Open', 'cew'); ?>"
                    class="icon-plus">
                <img src="<?php echo esc_url($close_icon_url); ?>" alt="<?php echo esc_attr__('Close', 'cew'); ?>"
                    class="icon-close">
                <?php else : ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="icon-plus">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                    <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="icon-close">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                    <path d="M8 8L16 16M16 8L8 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                <?php endif; ?>
            </span>
        </div>
        <div class="custom-accordion-content" id="<?php echo esc_attr($item_id); ?>"
            style="<?php echo $is_open ? '' : 'display: none;'; ?>">
            <?php echo wp_kses_post($item['accordion_content']); ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
    }
}