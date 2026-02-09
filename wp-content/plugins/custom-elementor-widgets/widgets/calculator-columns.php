<?php
/**
 * Calculator Columns Widget
 */

if (!defined('ABSPATH')) {
    exit;
}

class Calculator_Columns_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'calculator_columns';
    }
    
    public function get_title() {
        return esc_html__('Custom Calculator Columns', 'cew');
    }
    
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    
    public function get_categories() {
        return ['broker-elements'];
    }
    
    public function get_keywords() {
        return ['calculator', 'columns', 'grid', 'cards', 'broker'];
    }
    
    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Calculators', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'calculator_title',
            [
                'label' => esc_html__('Calculator Title', 'cew'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Calculator Name', 'cew'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'calculator_link',
            [
                'label' => esc_html__('Link', 'cew'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'cew'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );
        
        $this->add_control(
            'calculators_list',
            [
                'label' => esc_html__('Calculator Items', 'cew'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'calculator_title' => esc_html__('Calculator Name', 'cew'),
                        'calculator_link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ calculator_title }}}',
            ]
        );
        
        $this->end_controls_section();
        
        // Layout Settings
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'cew'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .calculator-columns-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'column_gap',
            [
                'label' => esc_html__('Column Gap', 'cew'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .calculator-columns-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Card
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => esc_html__('Card Style', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'card_background',
            [
                'label' => esc_html__('Background Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffff',
                'selectors' => [
                    '{{WRAPPER}} .calculator-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'card_background_hover',
            [
                'label' => esc_html__('Background Hover Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .calculator-card:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Padding', 'cew'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '15',
                    'right' => '15',
                    'bottom' => '15',
                    'left' => '15',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .calculator-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'card_border_radius',
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
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .calculator-card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Typography
        $this->start_controls_section(
            'typography_section',
            [
                'label' => esc_html__('Typography', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'cew'),
                'selector' => '{{WRAPPER}} .calculator-title',
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .calculator-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Arrow Button
        $this->start_controls_section(
            'arrow_style_section',
            [
                'label' => esc_html__('Arrow Button', 'cew'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'arrow_type',
            [
                'label' => esc_html__('Arrow Type', 'cew'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('SVG Icon', 'cew'),
                    'image' => esc_html__('Custom Image', 'cew'),
                ],
            ]
        );
        
        $this->add_control(
            'arrow_image',
            [
                'label' => esc_html__('Upload Arrow Image', 'cew'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'arrow_type' => 'image',
                ],
            ]
        );
        
        
        $this->add_control(
            'arrow_icon_size',
            [
                'label' => esc_html__('Icon/Image Size', 'cew'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 60,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 35,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .calculator-arrow svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .calculator-arrow img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'arrow_icon_color',
            [
                'label' => esc_html__('Icon Color', 'cew'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .calculator-arrow svg path' => 'stroke: {{VALUE}};',
                ],
                'condition' => [
                    'arrow_type' => 'icon',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['calculators_list'])) {
            return;
        }
        ?>

<div class="calculator-columns-container">
    <?php foreach ($settings['calculators_list'] as $index => $item) : 
                $link_key = 'link_' . $index;
                
                $this->add_link_attributes($link_key, $item['calculator_link']);
                $this->add_render_attribute($link_key, 'class', 'calculator-card');
            ?>
    <a <?php echo $this->get_render_attribute_string($link_key); ?>>
        <span class="calculator-title"><?php echo esc_html($item['calculator_title']); ?></span>
        <span class="calculator-arrow">
            <?php if ($settings['arrow_type'] === 'image' && !empty($settings['arrow_image']['url'])) : ?>
            <img src="<?php echo esc_url($settings['arrow_image']['url']); ?>"
                alt="<?php echo esc_attr__('Arrow', 'cew'); ?>">
            <?php else : ?>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <?php endif; ?>
        </span>
    </a>
    <?php endforeach; ?>
</div>

<?php
    }
}