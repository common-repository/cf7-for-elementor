<?php
/*
 * Elementor ElementorCf7 Cf7 Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elementor_Cf7_Widget extends \Elementor\Widget_Base {

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'Cf7Widget';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Cf7', 'cf7forelementor' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return [ 'general', 'cf7category' ];
	}

	/**
	 * Retrieve the list of scripts the ElementorCf7 Cf7 widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-cf7forelementor_cf7'];
	}
	*/

	/**
	 * Register ElementorCf7 Cf7 widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){

		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
    $contact_forms = array();
    if ( $cf7 ) {
      foreach ( $cf7 as $cform ) {
        $contact_forms[ $cform->ID ] = $cform->post_title;
      }
    } else {
      $contact_forms[ esc_html__( 'No contact forms found', 'xaedkb-core' ) ] = 0;
    }

		$this->start_controls_section(
			'section_Cf7',
			[
				'label' => esc_html__( 'Cf7 Options', 'cf7forelementor' ),
			]
		);

		$this->add_control(
      'cf7_style',
      [
        'label' => esc_html__( 'Cf7 Style', 'cf7forelementor' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'style-one' => esc_html__('Style One', 'cf7forelementor'),
            'style-two' => esc_html__('Style Two', 'cf7forelementor'),
        ],
        'default' => 'style-one',
      ]
		);
		$this->add_control(
			'form_id',
			[
				'label' => esc_html__( 'Select contact form', 'cf7forelementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => $contact_forms,
			]
		);


		$this->end_controls_section();// end: Section

		$this->start_controls_section(
			'section_form_style',
			[
				'label' => esc_html__( 'Form', 'cf7forelementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'selector' => '{{WRAPPER}} .contact-pg-section .contact-form input[type="text"], 
				{{WRAPPER}} .contact-pg-section .contact-form input[type="email"], 
				{{WRAPPER}} .contact-pg-section .contact-form input[type="date"], 
				{{WRAPPER}} .contact-pg-section .contact-form input[type="time"], 
				{{WRAPPER}} .contact-pg-section .contact-form input[type="number"], 
				{{WRAPPER}} .contact-pg-section .contact-form textarea, 
				{{WRAPPER}} .contact-pg-section .contact-form select, 
				{{WRAPPER}} .contact-pg-section .contact-form .form-control, 
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__( 'Border', 'cf7forelementor' ),
				'selector' => '{{WRAPPER}} .contact-pg-section .contact-form input[type="text"], 
				{{WRAPPER}} .contact-pg-section .contact-form input[type="email"], 
				{{WRAPPER}} .contact-pg-section .contact-forminput[type="date"], 
				{{WRAPPER}} .contact-pg-section .contact-form input[type="time"], 
				{{WRAPPER}} .contact-pg-section .contact-form input[type="number"], 
				{{WRAPPER}} .contact-pg-section .contact-form textarea, 
				{{WRAPPER}} .contact-pg-section .contact-form select, 
				{{WRAPPER}} .contact-pg-section .contact-form .form-control, 
				{{WRAPPER}} .contact-pg-section .contact-form .nice-select,
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',

			]
		);
		$this->add_control(
			'placeholder_text_color',
			[
				'label' => __( 'Placeholder Text Color', 'cf7forelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-form input:not([type="submit"])::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .contact-form input:not([type="submit"])::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .contact-form input:not([type="submit"])::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .contact-form input:not([type="submit"])::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .contact-form textarea::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .contact-form textarea::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .contact-form textarea::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .contact-form textarea::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace input::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace select::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'label_color',
			[
				'label' => __( 'Label Color', 'cf7forelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-form label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'cf7forelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-form input[type="text"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="email"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="date"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="time"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="number"], 
					{{WRAPPER}} .contact-pg-section .contact-form textarea, 
					{{WRAPPER}} .contact-pg-section .contact-form select, 
					{{WRAPPER}} .contact-pg-section .contact-form .form-control, 
					{{WRAPPER}} .track-contact .track-trace input, 
					{{WRAPPER}} .contact-pg-section .contact-form .nice-select' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'cf7forelementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-form input[type="text"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="email"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="date"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="time"], 
					{{WRAPPER}} .contact-pg-section .contact-form input[type="number"], 
					{{WRAPPER}} .contact-pg-section .contact-form textarea, 
					{{WRAPPER}} .contact-pg-section .contact-form select, 
					{{WRAPPER}} .contact-pg-section .contact-form .form-control, 
					{{WRAPPER}} .track-contact .track-trace input, 
					{{WRAPPER}} .contact-pg-section .contact-form .nice-select' => 'background-color: {{VALUE}} !important;',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'cf7forelementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit,.track-contact .track-trace .wpcf7-submit.submit-btn',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Width', 'cf7forelementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit,.track-contact .track-trace .wpcf7-submit.submit-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_margin',
			[
				'label' => __( 'Margin', 'cf7forelementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit,.track-contact .track-trace .wpcf7-submit.submit-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'cf7forelementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit,.track-contact .track-trace .wpcf7-submit.submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'button_style' );
			$this->start_controls_tab(
				'button_normal',
				[
					'label' => esc_html__( 'Normal', 'cf7forelementor' ),
				]
			);
			$this->add_control(
				'button_color',
				[
					'label' => esc_html__( 'Color', 'cf7forelementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit,.track-contact .track-trace .wpcf7-submit.submit-btn' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'cf7forelementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit,.track-contact .track-trace .wpcf7-submit.submit-btn' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'cf7forelementor' ),
					'selector' => '{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit,.track-contact .track-trace .wpcf7-submit.submit-btn',
				]
			);
			$this->end_controls_tab();  // end:Normal tab
			
			$this->start_controls_tab(
				'button_hover',
				[
					'label' => esc_html__( 'Hover', 'cf7forelementor' ),
				]
			);
			$this->add_control(
				'button_hover_color',
				[
					'label' => esc_html__( 'Color', 'cf7forelementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit:hover,.track-contact .track-trace .wpcf7-submit.submit-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_hover_color',
				[
					'label' => esc_html__( 'Background Color', 'cf7forelementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit:hover,.track-contact .track-trace .wpcf7-submit.submit-btn:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'cf7forelementor' ),
					'selector' => '{{WRAPPER}} .contact-pg-section .contact-form .wpcf7-form-control.wpcf7-submit:hover,.track-contact .track-trace .wpcf7-submit.submit-btn:hover',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render Cf7 widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$cf7_style = !empty( $settings['cf7_style'] ) ? $settings['cf7_style'] : '';
		$form_id = !empty( $settings['form_id'] ) ? $settings['form_id'] : '';

		if ( $cf7_style == 'style-one') {
			$style_class = 'form-style-1';
		} else {
			$style_class = 'form-style-2';
		}


		// Turn output buffer on
		ob_start();
		$cf7_id = 'cf7'.uniqid('-');
		?>
	   <div class="contact-pg-section <?php echo esc_attr( $style_class ); ?>">
	    	<div class="contact-form">
		     	<?php echo do_shortcode( '[contact-form-7 id="'. $form_id .'"]' ); ?> 
	    	</div>
			</div>
		<?php // Return outbut buffer
		echo ob_get_clean();

	}
	/**
	 * Render Cf7 widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register( new Elementor_Cf7_Widget() );