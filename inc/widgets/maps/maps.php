<?php
namespace Elementor;

class SD_Maps extends Widget_Base {

	public function get_name() {
		return 'sd-maps';
	}

	public function get_script_depends(){
		return ['js-api-loader', 'maps-widgets'];
	}
	
	public function get_title() {
		return __( 'Surya Digital Maps', 'surya-digital' );
	}
	
	public function get_categories(){
		return ['sd-category'];
	}
	
	protected function _register_controls() {
	
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'surya-digital' ),
				'tab' 	=> Controls_Manager::TAB_CONTENT,
			)
		);
		
		$this->add_control(
			'sd_maps_api',
			array(
				'label'     => __( 'Google Maps API', 'surya-digital' ),
				'label_block'	=> true,
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
			)
		);
		
		$this->add_control(
			'sd_maps_url',
			array(
				'label'     => __( 'Google Maps KML Url', 'surya-digital' ),
				'label_block'	=> true,
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
			)
		);
		
		$this->add_control(
			'sd_action_inside',
			array(
				'label'     => __( 'Action Inside', 'surya-digital' ),
				'label_block'	=> true,
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
			)
		);
		
		$this->add_control(
			'sd_action_outside',
			array(
				'label'     => __( 'Action Outside', 'surya-digital' ),
				'label_block'	=> true,
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
			)
		);
		
	
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings	= $this->get_settings_for_display();

		$key						= isset( $settings['sd_maps_api'] ) ? $settings['sd_maps_api'] : '';
		$url 						= isset( $settings['sd_maps_url'] ) ? $settings['sd_maps_url'] : '';
		$action_inside	= isset( $settings['sd_action_inside'] ) ? $settings['sd_action_inside'] : '';
		$action_outside	= isset( $settings['sd_action_outside'] ) ? $settings['sd_action_outside'] : '';

		$default_latitude		= '-37.81227787656727';
		$default_longitude	= '144.96224942736328';

		$output = '';

		$data_settings = array(
			'key' 			=> esc_attr( $key ),
			'kmlUrl'		=> esc_url( $url ),
			'latitude' 	=> $default_latitude,
			'longitude' => $default_longitude,
			'coordinates'	=> sd_kml_extractors( $url ),
			'actionInside'	=> esc_url( $action_inside ),
			'actionOutside'	=> esc_url( $action_outside )
		);

		$output = sprintf('
				<div id="map" data-settings="%1$s" style="min-height: 400px;"></div>
				<input
					id="sd-input"
					class="controls"
					type="text"
					placeholder="Search Box"
				/>
				<a
					href="#"
					class="sd-maps-button disabled"
					target="_blank"
				>
					Action Button
				</a>
				<style>
					#sd-input {
						background-color: #fff;
						font-family: Roboto;
						font-size: 15px;
						font-weight: 300;
						margin-left: 12px;
						padding: 0 11px 0 13px;
						text-overflow: ellipsis;
						width: 400px;
					}
					
					#sd-input:focus {
						border-color: #4d90fe;
					}
					.sd-maps-button {
						padding: 8px 16px;
						background: blue;
						color: #fff !important;
						margin-top: 16px;
						display: inline-block;
					}
					.sd-maps-button.disabled {
						background: grey;
						pointer-events: none;
  					cursor: default;
					}
				</style>
			',
			esc_attr( json_encode( $data_settings ) )
		);	


		echo apply_filters( 'sd_widgets_maps', $output );
	}
}