<?php
if( !class_exists( 'SD_Widgets' ) ){
  class SD_Widgets {

    public function __construct(){
      add_action( 'elementor/frontend/after_register_scripts', array( $this, 'sd_extender_widgets_register_scripts' ) );
      add_action( 'elementor/preview/enqueue_scripts', array( $this, 'sd_extender_widgets_register_scripts' ) );
      add_action( 'elementor/elements/categories_registered', array( $this, 'sd_add_elementor_categories' ) );
      $this->sd_extender_register_widgets();
    }

    public function sd_extender_widgets_register_scripts(){
      wp_register_script( 'maps-widgets', SD_EXTENDER_INC_URI . '/widgets/maps/assets/js/maps.js', array('jquery'), SD_EXTENDER_VERSION, true );
    }


    
    public function sd_add_elementor_categories( $elements_manager ){
      $cat_prefix = 'sd-';
  
      $elements_manager->add_category(
        $cat_prefix . 'category',
        array(
          'title'   => esc_html__( 'Surya Digital Category', 'textdomain' ),
          'icon'    => 'fa fa-plug',
          'active'  => true
        )
      );
    }

    public function sd_extender_register_widgets(){
      foreach ( glob( SD_EXTENDER_INC_PATH . '/*/*/register.php' ) as $module ) {
        include_once $module;
      }
    }
  }

  new SD_Widgets;
}