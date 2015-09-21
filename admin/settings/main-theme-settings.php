<?php
/*
  neptune main Theme Setting Page
*/

class neptuneMainThemeSettings
{

  public function __construct()
  {
    //including javascript only for this page
    add_action( 'admin_enqueue_scripts', array($this, 'main_settings_scripts' ) );
    //add main settings page
    add_action( 'admin_menu', array( $this, 'neptune_add_main_settings_page' ) );
    //register settings
    add_action( 'admin_init', array( $this, 'register_settings' ) );
    //add Header Settings Page
    include_once('header-settings.php');
    //add Footer Settings Page
    include_once('footer-settings.php');
  }
  /**
  * Add settings page
  */
  public function neptune_add_main_settings_page()
  {
      add_menu_page(
        'Main Settings', 
        'Main Settings', 
        'manage_options', 
        'main-theme-settings',
        array($this, 'main_theme_setting_page')
      );
  }

   /**
    * Main Theme Settings Page
    */
   public function main_theme_setting_page()
   {
    //initial variables
    $this->options = get_option( 'neptune_main_setting_option' );
    $font = $this->options['font'];
    ?>
    <div class="wrap">
        <h2 class="nav-tab-wrapper">
          <a class='nav-tab nav-tab-active' href='?page=main-theme-settings'>Main Settings</a>
          <a class='nav-tab' href='?page=header-settings'>Header Settings</a>
          <a class='nav-tab' href='?page=footer-settings'>Footer Settings</a>
        </h2>
        <h1>
          Main Settings
        </h1>
        <br>
        <div class="toggle-panel active">
          <div class="toggle-header">
            <span class="dashicons dashicons-info"></span> Basic Information
          </div>
          <div class="toggle-content">
            <div class="field-group">
              <label>Company Name</label>
              <?php printf(
                  '<input type="text" class="input-option-field regular-text" data-bindID="company_name" value="%s" />',
                  isset( $this->options['company_name'] ) ? esc_attr( $this->options['company_name']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Phone</label>
              <?php printf(
                  '<input type="text" class="input-option-field regular-text" data-bindID="phone" value="%s" />',
                  isset( $this->options['phone'] ) ? esc_attr( $this->options['phone']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Address</label>
              <?php printf(
                  '<input type="text" class="input-option-field regular-text" data-bindID="address" value="%s" />',
                  isset( $this->options['address'] ) ? esc_attr( $this->options['address']) : ''
              ); ?>
            </div>
          </div>
        </div>
        <div class="toggle-panel">
          <div class="toggle-header">
            <span class="dashicons dashicons-art"></span> Theme Design
          </div>
          <div class="toggle-content">
            <div class="clearfix">
              <div class="add-logo-setting col-xs-6 col-sm-4">
                Click to add/change Web logo
              </div>
              <div class="logo-show col-xs-6 col-sm-8">
                <?php if(isset($this->options['logo'])): ?>
                  <?php echo wp_get_attachment_image($this->options['logo'], 'thumbnail') ?>
                <?php endif; ?>
              </div>
            </div>
            <hr style="margin: 20px 0 10px;">
            <div class="field-group">
              <label>Pick theme font</label>
              <select class="font-select" data-bindID="font">
                <option value="open-sans" <?php echo $font == "open-sans" ? "selected" : "" ?>>Open Sans</option>
                <option value="lato" <?php echo $font == "lato" ? "selected" : "" ?>>Lato</option>
                <option value="pt-sans" <?php echo $font == "pt-sans" ? "selected" : "" ?>>PT Sans</option>
                <option value="droid-sans" <?php echo $font == "droid-sans" ? "selected" : "" ?> >Droid Sans</option>
                <option value="ubuntu" <?php echo $font == "ubuntu" ? "selected" : "" ?> >Ubuntu</option>
                <option value="ubuntu-mono" <?php echo $font == "ubuntu-mono" ? "selected" : "" ?> >Ubuntu Mono</option>
                <option value="vollkorn" <?php echo $font == "vollkorn" ? "selected" : "" ?> >Vollkorn</option>
                <option value="roboto" <?php echo $font == "roboto" ? "selected" : "" ?> >Roboto</option>
                <option value="josefin-slab" <?php echo $font == "josefin-slab" ? "selected" : "" ?> >Josefin Slab</option>
                <option value="dancing-script" <?php echo $font == "dancing-script" ? "selected" : "" ?> >Dancing Script</option>
              </select>
            </div>

            <div class="font-examples">
                Grumpy wizards make toxic brew for the evil Queen and Jack.
            </div>
            <hr style="margin: 20px 0 10px;">
            <div class="field-group">
                <label>Theme Color</label>
                <input type="color" id="theme-color" data-bindID="theme_color" style="width: 100px; height: 35px; padding: 0 3px" value="<?=$this->options['theme_color']?>">
            </div>
          </div>
        </div>
        <div class="toggle-panel">
          <div class="toggle-header">
            <span class="dashicons dashicons-share"></span> Social Media
          </div>
          <div class="toggle-content">
            <div class="field-group">
              <label>Facebook</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="facebook" value="%s" />',
                  isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Twitter</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="twitter" value="%s" />',
                  isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>LinkedIn</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="linkedin" value="%s" />',
                  isset( $this->options['linkedin'] ) ? esc_attr( $this->options['linkedin']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Pinterest</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="pinterest" value="%s" />',
                  isset( $this->options['pinterest'] ) ? esc_attr( $this->options['pinterest']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Google Plus+</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="google_plus" value="%s" />',
                  isset( $this->options['google_plus'] ) ? esc_attr( $this->options['google_plus']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Tumblr</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="tumblr" value="%s" />',
                  isset( $this->options['tumblr'] ) ? esc_attr( $this->options['tumblr']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Instagram</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="instagram" value="%s" />',
                  isset( $this->options['instagram'] ) ? esc_attr( $this->options['instagram']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Youtube</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="youtube" value="%s" />',
                  isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Flickr</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="flickr" value="%s" />',
                  isset( $this->options['flickr'] ) ? esc_attr( $this->options['flickr']) : ''
              ); ?>
            </div>
            <div class="field-group">
              <label>Github</label>
              <?php printf(
                  '<input type="url" class="input-option-field regular-text" data-bindID="github" value="%s" />',
                  isset( $this->options['github'] ) ? esc_attr( $this->options['github']) : ''
              ); ?>
            </div>
          </div>
        </div>
        <form method="post" action="options.php">
              <?php settings_fields( 'neptune_main_setting_fields' );  ?>
              <?php do_settings_sections( 'main-theme-settings' ); ?>
              <div class="display-none"> 
                  <?php printf(
                      '<input type="text" id="company_name" name="neptune_main_setting_option[company_name]" value="%s" />',
                      isset( $this->options['company_name'] ) ? esc_attr( $this->options['company_name']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="phone" name="neptune_main_setting_option[phone]" value="%s" />',
                      isset( $this->options['phone'] ) ? esc_attr( $this->options['phone']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="address" name="neptune_main_setting_option[address]" value="%s" />',
                      isset( $this->options['address'] ) ? esc_attr( $this->options['address']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="facebook" name="neptune_main_setting_option[facebook]" value="%s" />',
                      isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="twitter" name="neptune_main_setting_option[twitter]" value="%s" />',
                      isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="linkedin" name="neptune_main_setting_option[linkedin]" value="%s" />',
                      isset( $this->options['linkedin'] ) ? esc_attr( $this->options['linkedin']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="pinterest" name="neptune_main_setting_option[pinterest]" value="%s" />',
                      isset( $this->options['pinterest'] ) ? esc_attr( $this->options['pinterest']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="google_plus" name="neptune_main_setting_option[google_plus]" value="%s" />',
                      isset( $this->options['google_plus'] ) ? esc_attr( $this->options['google_plus']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="tumblr" name="neptune_main_setting_option[tumblr]" value="%s" />',
                      isset( $this->options['tumblr'] ) ? esc_attr( $this->options['tumblr']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="instagram" name="neptune_main_setting_option[instagram]" value="%s" />',
                      isset( $this->options['instagram'] ) ? esc_attr( $this->options['instagram']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="youtube" name="neptune_main_setting_option[youtube]" value="%s" />',
                      isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="flickr" name="neptune_main_setting_option[flickr]" value="%s" />',
                      isset( $this->options['flickr'] ) ? esc_attr( $this->options['flickr']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="github" name="neptune_main_setting_option[github]" value="%s" />',
                      isset( $this->options['github'] ) ? esc_attr( $this->options['github']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="logo" name="neptune_main_setting_option[logo]" value="%s" />',
                      isset( $this->options['logo'] ) ? esc_attr( $this->options['logo']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="font" name="neptune_main_setting_option[font]" value="%s" />',
                      isset( $this->options['font'] ) ? esc_attr( $this->options['font']) : ''
                  ); ?>
                  <?php printf(
                      '<input type="text" id="theme_color" name="neptune_main_setting_option[theme_color]" value="%s" />',
                      isset( $this->options['theme_color'] ) ? esc_attr( $this->options['theme_color']) : ''
                  ); ?>
              </div>
              <br>
              <input type="submit" name="submit" id="submit" class="btn" value="Save Changes">
        </form>
    </div>
    <?php
   }
   //register all settings
   function register_settings(){
    register_setting(
              'neptune_main_setting_fields', // Option group
              'neptune_main_setting_option' // Option name
            //  array( $this, 'sanitize' ) // Sanitize
    );
   }

  //This function is for enqueue script only for this page nothing else
  function main_settings_scripts(){
   $current_screen = get_current_screen();
   if ($current_screen->base == 'toplevel_page_main-theme-settings') {
     add_filter( 'media_view_strings', array( $this, 'lec_my_view_strings') );
     //wp_enqueue_script('iris');
     wp_enqueue_script('media-upload');
     wp_enqueue_script('mainsettingjs', get_template_directory_uri()."/admin/js/settings/main-settings.js", array(), null);
     //Import Huge amount of google fonts
     wp_enqueue_style('open-sans','https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ,array(), null);
     wp_enqueue_style('lato','https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' ,array(), null);
     wp_enqueue_style('pt-sans','https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' ,array(), null);
     wp_enqueue_style('droid-sans','https://fonts.googleapis.com/css?family=Droid+Sans:400,700' ,array(), null);
     wp_enqueue_style('ubuntu','https://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' ,array(), null);
     wp_enqueue_style('ubuntu-mono','https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,400italic,700,700italic' ,array(), null);
     wp_enqueue_style('vollkorn','https://fonts.googleapis.com/css?family=Vollkorn:400,400italic,700,700italic' ,array(), null);
     wp_enqueue_style('roboto','https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700italic,700,900,900italic' ,array(), null);
     wp_enqueue_style('josefin-slab','https://fonts.googleapis.com/css?family=Josefin+Slab:400,100,100italic,300,300italic,400italic,600,700,600italic,700italic' ,array(), null);
     wp_enqueue_style('dancing-script','https://fonts.googleapis.com/css?family=Dancing+Script:400,700' ,array(), null);
   }
  }

  //disable buttons on media
  function lec_my_view_strings( $strings) {
    // disable some views
    $disabled = array(  'createNewGallery', 'insertFromUrlTitle', 'createGalleryTitle' );
    foreach( $disabled as $string )
      $strings[$string] = '';
    return $strings;
  }


}// class end
$mainThemeSettings = new neptuneMainThemeSettings();


  ?>