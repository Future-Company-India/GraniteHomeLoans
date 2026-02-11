<?php
if (!defined("ABSPATH")) {
  exit(); // Exit if accessed directly
}

/**
 * Elementor HTML Code Widget
 */
class Elementor_HTML_Code_Custom_Widget extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return "html_code_widget";
  }

  public function get_title()
  {
    return esc_html__("Custom HTML Code", "elementor-html-code-widget");
  }

  public function get_icon()
  {
    return "eicon-code";
  }

  public function get_categories()
  {
    return ["general"];
  }

  public function get_keywords()
  {
    return ["html", "code", "custom", "embed"];
  }

  protected function register_controls()
  {
    // Content Section
    $this->start_controls_section("content_section", [
      "label" => esc_html__("HTML Code", "elementor-html-code-widget"),
      "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    ]);

    $this->add_control("html_code", [
      "label" => esc_html__("HTML Code", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::CODE,
      "language" => "html",
      "rows" => 20,
      "default" => '<div style="padding: 20px; background: #f5f5f5; border-radius: 5px;">
    <h3>Hello World!</h3>
    <p>This is your custom HTML code.</p>
</div>',
      "placeholder" => esc_html__(
        "Enter your HTML code here...",
        "elementor-html-code-widget"
      ),
    ]);

    $this->end_controls_section();

    // Height Settings Section
    $this->start_controls_section("height_section", [
      "label" => esc_html__("Height Settings", "elementor-html-code-widget"),
      "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    ]);

    $this->add_control("height_type", [
      "label" => esc_html__("Height Type", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::SELECT,
      "default" => "auto",
      "options" => [
        "auto" => esc_html__("Auto", "elementor-html-code-widget"),
        "custom" => esc_html__("Custom", "elementor-html-code-widget"),
      ],
    ]);

    // Desktop Height
    $this->add_responsive_control("custom_height", [
      "label" => esc_html__("Height", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::SLIDER,
      "size_units" => ["px", "vh", "%"],
      "range" => [
        "px" => [
          "min" => 0,
          "max" => 1000,
          "step" => 1,
        ],
        "vh" => [
          "min" => 0,
          "max" => 100,
          "step" => 1,
        ],
        "%" => [
          "min" => 0,
          "max" => 100,
          "step" => 1,
        ],
      ],
      "default" => [
        "unit" => "px",
        "size" => 300,
      ],
      "tablet_default" => [
        "unit" => "px",
        "size" => 250,
      ],
      "mobile_default" => [
        "unit" => "px",
        "size" => 200,
      ],
      "selectors" => [
        "{{WRAPPER}} .html-code-container" => "height: {{SIZE}}{{UNIT}};",
      ],
      "condition" => [
        "height_type" => "custom",
      ],
    ]);

    $this->add_responsive_control("min_height", [
      "label" => esc_html__("Min Height", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::SLIDER,
      "size_units" => ["px", "vh"],
      "range" => [
        "px" => [
          "min" => 0,
          "max" => 1000,
          "step" => 1,
        ],
        "vh" => [
          "min" => 0,
          "max" => 100,
          "step" => 1,
        ],
      ],
      "selectors" => [
        "{{WRAPPER}} .html-code-container" => "min-height: {{SIZE}}{{UNIT}};",
      ],
    ]);

    $this->add_responsive_control("max_height", [
      "label" => esc_html__("Max Height", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::SLIDER,
      "size_units" => ["px", "vh"],
      "range" => [
        "px" => [
          "min" => 0,
          "max" => 2000,
          "step" => 1,
        ],
        "vh" => [
          "min" => 0,
          "max" => 100,
          "step" => 1,
        ],
      ],
      "selectors" => [
        "{{WRAPPER}} .html-code-container" => "max-height: {{SIZE}}{{UNIT}};",
      ],
    ]);

    $this->add_control("overflow", [
      "label" => esc_html__("Overflow", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::SELECT,
      "default" => "visible",
      "options" => [
        "visible" => esc_html__("Visible", "elementor-html-code-widget"),
        "hidden" => esc_html__("Hidden", "elementor-html-code-widget"),
        "scroll" => esc_html__("Scroll", "elementor-html-code-widget"),
        "auto" => esc_html__("Auto", "elementor-html-code-widget"),
      ],
      "selectors" => [
        "{{WRAPPER}} .html-code-container" => "overflow: {{VALUE}};",
      ],
    ]);

    $this->end_controls_section();

    // Style Section
    $this->start_controls_section("style_section", [
      "label" => esc_html__("Container Style", "elementor-html-code-widget"),
      "tab" => \Elementor\Controls_Manager::TAB_STYLE,
    ]);

    $this->add_responsive_control("padding", [
      "label" => esc_html__("Padding", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::DIMENSIONS,
      "size_units" => ["px", "em", "%"],
      "selectors" => [
        "{{WRAPPER}} .html-code-container" =>
          "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
      ],
    ]);

    $this->add_responsive_control("margin", [
      "label" => esc_html__("Margin", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::DIMENSIONS,
      "size_units" => ["px", "em", "%"],
      "selectors" => [
        "{{WRAPPER}} .html-code-container" =>
          "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
      ],
    ]);

    $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
      "name" => "background",
      "types" => ["classic", "gradient"],
      "selector" => "{{WRAPPER}} .html-code-container",
    ]);

    $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
      "name" => "border",
      "selector" => "{{WRAPPER}} .html-code-container",
    ]);

    $this->add_responsive_control("border_radius", [
      "label" => esc_html__("Border Radius", "elementor-html-code-widget"),
      "type" => \Elementor\Controls_Manager::DIMENSIONS,
      "size_units" => ["px", "%"],
      "selectors" => [
        "{{WRAPPER}} .html-code-container" =>
          "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
      ],
    ]);

    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      "name" => "box_shadow",
      "selector" => "{{WRAPPER}} .html-code-container",
    ]);

    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();

    $height_class =
      $settings["height_type"] === "custom" ? "custom-height" : "auto-height";
    ?>
<div
    class="
      html-code-container <?php echo esc_attr($height_class); ?>
    "
  >
    <?php echo $settings["html_code"]; ?>
</div>
<?php
  }

  protected function content_template()
  {
    ?>
<# var heightClass=settings.height_type==='custom' ? 'custom-height' : 'auto-height' ; #>
    <div class="html-code-container {{{ heightClass }}}">
        {{{ settings.html_code }}}
    </div>
    <?php
  }
}
