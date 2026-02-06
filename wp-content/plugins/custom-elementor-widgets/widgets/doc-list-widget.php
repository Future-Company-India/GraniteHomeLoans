<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class EDLW_Doc_List_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'doc_list_widget';
	}

	public function get_title() {
		return __( 'Document List', 'edlw' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'edlw' ),
			]
		);

		$this->add_control(
			'section_heading',
			[
				'label' => __( 'Section Heading', 'edlw' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Prime',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'link_text',
			[
				'label' => __( 'Link Text', 'edlw' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'View Prime - Fixed Product',
			]
		);

		$repeater->add_control(
			'document',
			[
				'label' => __( 'Upload Document', 'edlw' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'application/pdf', 'application/msword' ],
			]
		);

		$this->add_control(
			'documents',
			[
				'label' => __( 'Documents', 'edlw' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ link_text }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="edlw-doc-list">
			<?php if ( ! empty( $settings['section_heading'] ) ) : ?>
				<h3 class="edlw-heading">
					<?php echo esc_html( $settings['section_heading'] ); ?>
				</h3>
			<?php endif; ?>

			<ul class="edlw-links">
				<?php foreach ( $settings['documents'] as $item ) :
					if ( empty( $item['document']['url'] ) ) continue;
				?>
					<li>
						<a href="<?php echo esc_url( $item['document']['url'] ); ?>" target="_blank">
							<?php echo esc_html( $item['link_text'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php
	}
}
