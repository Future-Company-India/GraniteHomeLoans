<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Team_Members_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'team_members';
    }
    
    public function get_title() {
        return esc_html__('Custom Team Members', 'team-members-elementor');
    }
    
    public function get_icon() {
        return 'eicon-person';
    }
    
    public function get_categories() {
        return ['general'];
    }
    
    public function get_keywords() {
        return ['team', 'members', 'staff', 'contact', 'granite'];
    }
    
    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Team Members', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'member_name',
            [
                'label' => esc_html__('Name', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Team Member', 'team-members-elementor'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'member_title',
            [
                'label' => esc_html__('Job Title', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Position', 'team-members-elementor'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'member_image',
            [
                'label' => esc_html__('Photo', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control(
            'member_email',
            [
                'label' => esc_html__('Email', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('email@example.com', 'team-members-elementor'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'member_phone',
            [
                'label' => esc_html__('Phone', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0400 000 000', 'team-members-elementor'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'phone_label',
            [
                'label' => esc_html__('Phone Label (Optional)', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('e.g., Option 5', 'team-members-elementor'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'show_second_phone',
            [
                'label' => esc_html__('Add Second Phone', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'team-members-elementor'),
                'label_off' => esc_html__('No', 'team-members-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $repeater->add_control(
            'second_phone_label',
            [
                'label' => esc_html__('Second Phone Label', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Direct:', 'team-members-elementor'),
                'condition' => [
                    'show_second_phone' => 'yes',
                ],
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'second_phone',
            [
                'label' => esc_html__('Second Phone Number', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'show_second_phone' => 'yes',
                ],
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'show_badge',
            [
                'label' => esc_html__('Show Badge', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'team-members-elementor'),
                'label_off' => esc_html__('No', 'team-members-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $repeater->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('POWERED BY AAA', 'team-members-elementor'),
                'condition' => [
                    'show_badge' => 'yes',
                ],
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'team_members',
            [
                'label' => esc_html__('Team Members', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_name' => 'Don Susi',
                        'member_title' => 'Manager, Sales Support Distribution',
                        'member_email' => 'don.susi@granitehomeloans.com.au',
                        'member_phone' => '1300 232 999',
                        'phone_label' => '(Option 5)',
                        'show_second_phone' => 'yes',
                        'second_phone_label' => 'Direct:',
                        'second_phone' => '02 9044 1365',
                    ],
                    [
                        'member_name' => 'Danielle Bishop',
                        'member_title' => 'Broker Support Team',
                        'member_email' => 'danielle.bishop@granitehomeloans.com.au',
                        'member_phone' => '1300 232 999',
                        'phone_label' => '(Option 5)',
                    ],
                    [
                        'member_name' => 'Kit Wong',
                        'member_title' => 'State Partnership Manager (NSW/ACT)',
                        'member_email' => 'kit.wong@granitehomeloans.com.au',
                        'member_phone' => '0475 899 282',
                    ],
                    [
                        'member_name' => 'Helen Bond',
                        'member_title' => 'State Partnership Manager (WA/SA)',
                        'member_email' => 'helen.bond@granitehomeloans.com.au',
                        'member_phone' => '0497 158 905',
                    ],
                ],
                'title_field' => '{{{ member_name }}}',
            ]
        );
        
        $this->end_controls_section();
        
        // Icons Section
        $this->start_controls_section(
            'icons_section',
            [
                'label' => esc_html__('Icons', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'font',
                'options' => [
                    'font' => esc_html__('Font Awesome Icons', 'team-members-elementor'),
                    'image' => esc_html__('Custom Image Icons (PNG)', 'team-members-elementor'),
                ],
            ]
        );
        
        // Font Awesome Icons
        $this->add_control(
            'email_icon',
            [
                'label' => esc_html__('Email Icon', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-envelope',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'envelope',
                        'envelope-open',
                        'at',
                        'paper-plane',
                    ],
                    'fa-regular' => [
                        'envelope',
                        'envelope-open',
                    ],
                ],
                'condition' => [
                    'icon_type' => 'font',
                ],
            ]
        );
        
        $this->add_control(
            'phone_icon',
            [
                'label' => esc_html__('Phone Icon', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-phone',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'phone',
                        'phone-alt',
                        'mobile',
                        'mobile-alt',
                    ],
                    'fa-regular' => [
                        'phone',
                    ],
                ],
                'condition' => [
                    'icon_type' => 'font',
                ],
            ]
        );
        
        // Custom Image Icons
        $this->add_control(
            'email_icon_image',
            [
                'label' => esc_html__('Email Icon Image', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );
        
        $this->add_control(
            'phone_icon_image',
            [
                'label' => esc_html__('Phone Icon Image', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .contact-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .contact-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '2',
                'tablet_default' => '1',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-members-container' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'column_gap',
            [
                'label' => esc_html__('Column Gap', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-members-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Card
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => esc_html__('Card', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'card_background',
            [
                'label' => esc_html__('Background Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .team-member-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .team-member-card',
            ]
        );
        
        $this->add_responsive_control(
            'card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 12,
                    'right' => 12,
                    'bottom' => 12,
                    'left' => 12,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .team-member-card',
            ]
        );
        
        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Padding', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .team-member-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Name
        $this->start_controls_section(
            'name_style_section',
            [
                'label' => esc_html__('Name', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2d3748',
                'selectors' => [
                    '{{WRAPPER}} .member-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .member-name',
            ]
        );
        
        $this->add_responsive_control(
            'name_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Title
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Job Title', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#4a5568',
                'selectors' => [
                    '{{WRAPPER}} .member-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .member-title',
            ]
        );
        
        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .member-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Email
        $this->start_controls_section(
            'email_style_section',
            [
                'label' => esc_html__('Email', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'email_color',
            [
                'label' => esc_html__('Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#48bb78',
                'selectors' => [
                    '{{WRAPPER}} .contact-item.email' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'email_hover_color',
            [
                'label' => esc_html__('Hover Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#38a169',
                'selectors' => [
                    '{{WRAPPER}} .contact-item.email:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'email_typography',
                'selector' => '{{WRAPPER}} .contact-item.email',
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Phone
        $this->start_controls_section(
            'phone_style_section',
            [
                'label' => esc_html__('Phone', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'phone_color',
            [
                'label' => esc_html__('Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#48bb78',
                'selectors' => [
                    '{{WRAPPER}} .contact-item.phone' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'phone_hover_color',
            [
                'label' => esc_html__('Hover Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#38a169',
                'selectors' => [
                    '{{WRAPPER}} .contact-item.phone:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'phone_typography',
                'selector' => '{{WRAPPER}} .contact-item.phone',
            ]
        );
        
        $this->add_control(
            'phone_label_heading',
            [
                'label' => esc_html__('Phone Label', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'phone_label_color',
            [
                'label' => esc_html__('Label Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2d3748',
                'selectors' => [
                    '{{WRAPPER}} .phone-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'phone_label_typography',
                'selector' => '{{WRAPPER}} .phone-label',
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Badge
        $this->start_controls_section(
            'badge_style_section',
            [
                'label' => esc_html__('Badge', 'team-members-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'badge_background',
            [
                'label' => esc_html__('Background Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffd700',
                'selectors' => [
                    '{{WRAPPER}} .badge-aaa' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'badge_text_color',
            [
                'label' => esc_html__('Text Color', 'team-members-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2d3748',
                'selectors' => [
                    '{{WRAPPER}} .badge-aaa' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'selector' => '{{WRAPPER}} .badge-aaa',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $icon_type = $settings['icon_type'];
        ?>
<div class="team-members-container">
    <?php foreach ($settings['team_members'] as $member): ?>
    <div class="team-member-card">
        <div class="team-member-image">
            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($member, 'full', 'member_image'); ?>
        </div>
        <div class="team-member-info">
            <h3 class="member-name"><?php echo esc_html($member['member_name']); ?></h3>
            <p class="member-title"><?php echo esc_html($member['member_title']); ?></p>
            <div class="member-contact">
                <a href="mailto:<?php echo esc_attr($member['member_email']); ?>" class="contact-item email">
                    <span class="contact-icon">
                        <?php if ($icon_type === 'image' && !empty($settings['email_icon_image']['url'])): ?>
                        <img src="<?php echo esc_url($settings['email_icon_image']['url']); ?>" alt="Email" />
                        <?php else: ?>
                        <?php \Elementor\Icons_Manager::render_icon($settings['email_icon'], ['aria-hidden' => 'true']); ?>
                        <?php endif; ?>
                    </span>
                    <span><?php echo esc_html($member['member_email']); ?></span>
                </a>

                <a href="tel:<?php echo esc_attr(str_replace([' ', '(', ')'], '', $member['member_phone'])); ?>"
                    class="contact-item phone">
                    <span class="contact-icon">
                        <?php if ($icon_type === 'image' && !empty($settings['phone_icon_image']['url'])): ?>
                        <img src="<?php echo esc_url($settings['phone_icon_image']['url']); ?>" alt="Phone" />
                        <?php else: ?>
                        <?php \Elementor\Icons_Manager::render_icon($settings['phone_icon'], ['aria-hidden' => 'true']); ?>
                        <?php endif; ?>
                    </span>
                    <span class="phone-number-wrapper">
                        <span class="phone-number"><?php echo esc_html($member['member_phone']); ?></span>
                        <?php if (!empty($member['phone_label'])): ?>
                        <span class="phone-label"><?php echo esc_html(' ' . $member['phone_label']); ?></span>
                        <?php endif; ?>
                    </span>
                </a>

                <?php if ($member['show_second_phone'] === 'yes' && !empty($member['second_phone'])): ?>
                <a href="tel:<?php echo esc_attr(str_replace([' ', '(', ')'], '', $member['second_phone'])); ?>"
                    class="contact-item phone secondary-phone">
                    <span class="contact-icon">
                        <?php if ($icon_type === 'image' && !empty($settings['phone_icon_image']['url'])): ?>
                        <img src="<?php echo esc_url($settings['phone_icon_image']['url']); ?>" alt="Phone" />
                        <?php else: ?>
                        <?php \Elementor\Icons_Manager::render_icon($settings['phone_icon'], ['aria-hidden' => 'true']); ?>
                        <?php endif; ?>
                    </span>
                    <span class="phone-number-wrapper">
                        <?php if (!empty($member['second_phone_label'])): ?>
                        <span class="phone-label"><?php echo esc_html($member['second_phone_label']); ?></span>
                        <?php endif; ?>
                        <span class="phone-number"><?php echo esc_html(' ' . $member['second_phone']); ?></span>
                    </span>
                </a>
                <?php endif; ?>
            </div>
            <?php if ($member['show_badge'] === 'yes'): ?>
            <div class="member-badge">
                <span class="badge-aaa"><?php echo esc_html($member['badge_text']); ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php
    }
}