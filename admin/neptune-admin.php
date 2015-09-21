<?php
if (!class_exists('neptune_admin'))
{
  class neptune_admin
  {

    public function __construct()
    {
      //Theme settings pages
      include_once('settings/main-theme-settings.php');
      
      

      //Add Script to admin panel
      add_action( 'admin_enqueue_scripts', array($this, 'neptune_admin_scripts' ) );

    }
    /**
      * @desc put scripts and styles in admin page
    */
    function neptune_admin_scripts() {
      wp_enqueue_style('main-style', get_template_directory_uri()."/style-admin.css", array(), null);
      wp_enqueue_style('thickbox');
      wp_enqueue_script('jquery');
      if ( ! did_action( 'wp_enqueue_media' ) )
            wp_enqueue_media();
      wp_enqueue_script('media-upload');
      wp_enqueue_script('jquery-ui-sortable');
      wp_enqueue_script('jquery-ui-draggable');
      //wp_enqueue_script('iris'); // color picker
      //wp_enqueue_script('jquery-ui-datepicker');
      wp_enqueue_script('thickbox');
    }

  }// class end
}
$neptune_admin = new neptune_admin();