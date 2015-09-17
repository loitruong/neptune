<?php
/*
  neptune main Theme Setting Page
*/

class neptuneMainThemeSettings
{

  public function __construct()
  {
    //add main settings page
    add_action( 'admin_menu', array( $this, 'neptune_add_main_settings_page' ) );
    //add Header Settings Page
    include_once('header-settings.php');
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
    ?>
    <div class="wrap">
        <h2 class="nav-tab-wrapper">
          <a class='nav-tab nav-tab-active' href='?page=main-theme-settings'>Main Settings</a>
          <a class='nav-tab' href='?page=header-settings'>Header Settings</a>
        </h2>
        todo list for this page:<br>
        this page will be main options like font-style  <br>
        font-color  <br>
        a tag color <br>
        logo <br>



    </div>
    <?php
   }
 



}// class end
$mainThemeSettings = new neptuneMainThemeSettings();


  ?>