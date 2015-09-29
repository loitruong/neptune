<?php
/*
  neptune main Theme Setting Page
*/

class neptuneHomepageSettings
{

  public function __construct()
  {
    //including javascript only for this page
    add_action( 'admin_enqueue_scripts', array($this, 'homepage_settings_scripts' ) );
    //add main settings page
    add_action( 'admin_menu', array( $this, 'neptune_add_homepage_settings_page' ) );
    //register settings
    add_action( 'admin_init', array( $this, 'register_settings' ) );
  }
  /**
  * Add settings page
  */
  public function neptune_add_homepage_settings_page()
  {
      add_menu_page(
        'Hompage', 
        'Hompage', 
        'manage_options', 
        'homepage-settings',
        array($this, 'main_theme_setting_page'),
        'dashicons-admin-home',
        4.8
      );
  }

   /**
    * Hompage Theme Settings Page
    */
   public function main_theme_setting_page()
   {
    //initial variables
    $this->options = get_option( 'neptune_homepage_setting_option' );
    $font = $this->options['font'];
    $banners = json_decode($this->options['banner']);
    ?>
    <div class="wrap">
        <h1>
          Homepage Settings
        </h1>
        <div class="row">
          <div class="col-sm-9">
            <h2 class="nav-tab-wrapper">
              <a class='nav-tab nav-tab-active' data-target="#slider-tab">Slider / Banner</a>
              <a class='nav-tab' data-target="#layout-tab">Layout</a>
            </h2>
            <div class="tab-content" id="slider-tab">
              <div class="slider sortable">
              <?php if ( (is_array($banners) || is_object($banners)) && $banners != null ){ ?>
                <?php foreach ($banners as $banner): ?>
                  <div class="banner clearfix">
                    <div class="banner-image">
                    <?php if ($banner->attachmentID != null){
                        echo wp_get_attachment_image( $banner->attachmentID, "thumbnail", '', array(
                          'data-attachmentID' => $banner->attachmentID,
                          'class'   => 'img-responsive'
                        ));
                      }else{
                        echo '<img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=Add+Banner&w=150&h=150"/>';
                      } ?>

                    </div>
                    <div class="banner-fields">
                      <div class="field-group">
                        <label>Main Text</label>
                        <input type="text" class="main-text" value="<?=$banner->mainText?>">
                      </div>
                      <div class="field-group">
                        <label>Sub Text</label>
                        <textarea class="sub-text"><?=$banner->subText?></textarea>
                      </div>
                      <div class="field-group">
                        <label>Banner text at</label>
                        <select class="banner-text-side">
                            <option value="left" <?=($banner->sideText == "left" ? "selected" : "" )?>>left side</option>
                            <option value="center" <?=($banner->sideText == "center" ? "selected" : "" )?>>center side</option>
                            <option value="right" <?=($banner->sideText == "right" ? "selected" : "" )?>>right side</option>
                        </select>
                      </div>
                    </div>
                    <div class="banner-remove">
                      <span class="dashicons dashicons-minus"></span>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php }else { ?>
                    <div class="banner clearfix">
                      <div class="banner-image">
                        <img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=Add+Banner&w=150&h=150"/>
                      </div>
                      <div class="banner-fields">
                        <div class="field-group">
                          <label>Main Text</label>
                          <input type="text" class="main-text">
                        </div>
                        <div class="field-group">
                          <label>Sub Text</label>
                          <textarea class="sub-text"></textarea>
                        </div>
                        <div class="field-group">
                          <label>Banner text at</label>
                          <select class="banner-text-side">
                              <option value="left">left side</option>
                              <option value="center">center side</option>
                              <option value="right">right side</option>
                          </select>
                        </div>
                      </div>
                      <div class="banner-remove">
                        <span class="dashicons dashicons-minus"></span>
                      </div>
                    </div>
                <?php } ?>
              </div>
              <div class="button add-banner">Add Banner</div>
            </div>
            <div class="tab-content" id="layout-tab">
              <div class="grid-system">

                <div class="button add-layout">Add Layout</div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <form method="post" action="options.php" class="save-form">
                  <?php settings_fields( 'neptune_homepage_setting_fields' );  ?>
                  <?php do_settings_sections( 'homepage-settings' ); ?>
                  <div class="display-none"> 
                      <?php printf(
                          '<input type="text" id="banner-option-field" name="neptune_homepage_setting_option[banner]" value="%s" />',
                          isset( $this->options['banner'] ) ? esc_attr( $this->options['banner']) : ''
                      ); ?>
                  </div>
                  <input type="submit" name="submit" id="submit" class="btn" value="Save Changes">
            </form>
          </div>
        </div>
    </div>
    <?php
   }
   //register all settings
   function register_settings(){
    register_setting(
              'neptune_homepage_setting_fields', // Option group
              'neptune_homepage_setting_option' // Option name
    );
   }

  //This function is for enqueue script only for this page nothing else
  function homepage_settings_scripts(){
   $current_screen = get_current_screen();
   if ($current_screen->base == 'toplevel_page_homepage-settings') {
     add_filter( 'media_view_strings', array( $this, 'disable_media_buttons') );
     //wp_enqueue_script('iris');
     wp_enqueue_script('media-upload');
     wp_enqueue_script('mainsettingjs', get_template_directory_uri()."/admin/js/settings/homepage-settings.js", array(), null);
   }
  }

  //disable buttons on media
  function disable_media_buttons( $strings) {
    // disable some views
    $disabled = array(  'createNewGallery', 'insertFromUrlTitle', 'createGalleryTitle' );
    foreach( $disabled as $string )
      $strings[$string] = '';
    return $strings;
  }


}// class end
$mainThemeSettings = new neptuneHomepageSettings();

