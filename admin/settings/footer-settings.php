<?php
/*
  neptune Footer Theme Setting Page
*/

class neptuneFooterThemeSettings
{

  public function __construct()
  {
    //add main setting page
    add_action( 'admin_menu', array( $this, 'footer_settings_page' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
    //including javascript only for this page
    add_action( 'admin_enqueue_scripts', array($this, 'footer_scripts' ) );
  }
  /**
  * Add Footer settings page
  */
  function footer_settings_page(){
    add_submenu_page(
         'main-theme-settings',
         'Footer Settings',
         'Footer Settings',
         'manage_options',
         'footer-settings',
         array($this, 'footer_setting_page')
    );
  }


   /**
    * Main Theme Settings Page
    */
   function footer_setting_page()
   {
    //initial variables
    $this->options = get_option( 'neptune_footer_option' );
    $availableMenuOptions_1 = isset( $this->options['footer_option_fields_1'] ) ? esc_attr( $this->options['footer_option_fields_1']) : '';
    $availableMenuOptionsArray_1 = explode (',', $availableMenuOptions_1);
    $availableMenuOptions_2 = isset( $this->options['footer_option_fields_2'] ) ? esc_attr( $this->options['footer_option_fields_2']) : '';
    $availableMenuOptionsArray_2 = explode (',', $availableMenuOptions_2);
    $availableMenuOptions_3 = isset( $this->options['footer_option_fields_3'] ) ? esc_attr( $this->options['footer_option_fields_3']) : '';
    $availableMenuOptionsArray_3 = explode (',', $availableMenuOptions_3);
    $availableMenuOptions_4 = isset( $this->options['footer_option_fields_4'] ) ? esc_attr( $this->options['footer_option_fields_4']) : '';
    $availableMenuOptionsArray_4 = explode (',', $availableMenuOptions_4);
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
    ?>
    <div class="wrap">
        <h2 class="nav-tab-wrapper">
          <a class='nav-tab' href='?page=main-theme-settings'>Main Settings</a>
          <a class='nav-tab' href='?page=header-settings'>Header Settings</a>
          <a class='nav-tab nav-tab-active' href='?page=footer-settings'>Footer Settings</a>
        </h2>
        <h1>Footer Settings</h1>
        
        <h3>Choose Footer Layout</h3>
        <select class="select-layout-option" data-bindID="footer_layout">
          <option value="1" <?php echo ($this->options['footer_layout'] == 'layout-1' ? "selected" : "") ?>>Layout 1</option>
          <option value="2" <?php echo ($this->options['footer_layout'] == 'layout-2' ? "selected" : "") ?>>Layout 2</option>
          <option value="3" <?php echo ($this->options['footer_layout'] == 'layout-3' ? "selected" : "") ?>>Layout 3</option>
        </select>
        <div class="layout layout-1 <?php echo ($this->options['footer_layout'] == 'layout-1' || !isset($this->options['footer_layout']) ? "" : "display-none") ?>">
          <div class="footer-options">
            <?php if(strpos($availableMenuOptions_1, "Social Media") === false && strpos($availableMenuOptions_2, "Social Media") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Social Media
            </div>
            <?php if(strpos($availableMenuOptions_1, "Phone") === false && strpos($availableMenuOptions_2, "Phone") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Phone 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Address") === false && strpos($availableMenuOptions_2, "Address") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Address 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Search") === false && strpos($availableMenuOptions_2, "Search") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Search 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Logo") === false && strpos($availableMenuOptions_2, "Logo") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Logo 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Copyright") === false && strpos($availableMenuOptions_2, "Copyright") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Copyright 
            </div>
            <?php if ($menus != null): ?>
              <?php foreach ($menus as $menu): ?>
                <?php if(strpos($availableMenuOptions_1, $menu->name) === false && strpos($availableMenuOptions_2, $menu->name) === false){
                    $strcontain = "";
                  }else{ $strcontain = "display-none"; }
                 ?>
                <div class="draggable <?=$strcontain?>" data-menuID="<?=$menu->term_id?>">
                      <?= $menu->name ?>
                </div>
              <?php endforeach; ?>
            <?php endif ?>
          </div>
          <div class="row layout-container">
            <div class="col-sm-6">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_1">
                <?php foreach ($availableMenuOptionsArray_1 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
            <div class="col-sm-6">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_2">
                <?php foreach ($availableMenuOptionsArray_2 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
          </div>
        </div>
        <div class="layout layout-2 <?php echo ($this->options['footer_layout'] == 'layout-2' || !isset($this->options['footer_layout']) ? "" : "display-none") ?>">
          <div class="footer-options">
            <?php if(strpos($availableMenuOptions_1, "Social Media") === false && strpos($availableMenuOptions_2, "Social Media") === false && strpos($availableMenuOptions_3, "Social Media") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Social Media 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Phone") === false && strpos($availableMenuOptions_2, "Phone") === false && strpos($availableMenuOptions_3, "Phone") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Phone 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Address") === false && strpos($availableMenuOptions_2, "Address") === false && strpos($availableMenuOptions_3, "Address") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Address 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Search") === false && strpos($availableMenuOptions_2, "Search") === false && strpos($availableMenuOptions_3, "Search") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Search 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Logo") === false && strpos($availableMenuOptions_2, "Logo") === false && strpos($availableMenuOptions_3, "Logo") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Logo 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Copyright") === false && strpos($availableMenuOptions_2, "Copyright") === false && strpos($availableMenuOptions_3, "Copyright") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Copyright 
            </div>
            <?php if ($menus != null): ?>
              <?php foreach ($menus as $menu): ?>
                <?php if(strpos($availableMenuOptions_1, $menu->name) === false && strpos($availableMenuOptions_2, $menu->name) === false && strpos($availableMenuOptions_3, $menu->name) === false){
                    $strcontain = "";
                  }else{ $strcontain = "display-none"; }
                 ?>
                <div class="draggable <?=$strcontain?>" data-menuID="<?=$menu->term_id?>">
                      <?= $menu->name ?>
                </div>
              <?php endforeach; ?>
            <?php endif ?>
          </div>
          <div class="row layout-container">
            <div class="col-sm-4">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_1">
                <?php foreach ($availableMenuOptionsArray_1 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
            <div class="col-sm-4">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_2">
                <?php foreach ($availableMenuOptionsArray_2 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
            <div class="col-sm-4">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_3">
                <?php foreach ($availableMenuOptionsArray_3 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
          </div>
        </div>
        <div class="layout layout-3 <?php echo ($this->options['footer_layout'] == 'layout-3' || !isset($this->options['footer_layout']) ? "" : "display-none") ?>">
          <div class="footer-options">
            <?php if(strpos($availableMenuOptions_1, "Social Media") === false && strpos($availableMenuOptions_2, "Social Media") === false && strpos($availableMenuOptions_3, "Social Media") === false && strpos($availableMenuOptions_4, "Social Media") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Social Media 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Phone") === false && strpos($availableMenuOptions_2, "Phone") === false && strpos($availableMenuOptions_3, "Phone") === false && strpos($availableMenuOptions_4, "Phone") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Phone 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Address") === false && strpos($availableMenuOptions_2, "Address") === false && strpos($availableMenuOptions_3, "Address") === false && strpos($availableMenuOptions_4, "Address") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Address 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Search") === false && strpos($availableMenuOptions_2, "Search") === false && strpos($availableMenuOptions_3, "Search") === false && strpos($availableMenuOptions_4, "Search") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Search 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Logo") === false && strpos($availableMenuOptions_2, "Logo") === false && strpos($availableMenuOptions_3, "Logo") === false && strpos($availableMenuOptions_4, "Search") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Logo 
            </div>
            <?php if(strpos($availableMenuOptions_1, "Copyright") === false && strpos($availableMenuOptions_2, "Copyright") === false && strpos($availableMenuOptions_3, "Copyright") === false && strpos($availableMenuOptions_4, "Copyright") === false){
                $strcontain = "";
              }else{ $strcontain = "display-none"; }
             ?>
            <div class="draggable <?=$strcontain?>">
              Copyright 
            </div>
            <?php if ($menus != null): ?>
              <?php foreach ($menus as $menu): ?>
                <?php if(strpos($availableMenuOptions_1, $menu->name) === false && strpos($availableMenuOptions_2, $menu->name) === false && strpos($availableMenuOptions_3, $menu->name) === false && strpos($availableMenuOptions_4, $menu->name) === false){
                    $strcontain = "";
                  }else{ $strcontain = "display-none"; }
                 ?>
                <div class="draggable <?=$strcontain?>" data-menuID="<?=$menu->term_id?>">
                      <?= $menu->name ?>
                </div>
              <?php endforeach; ?>
            <?php endif ?>
          </div>
          <div class="row layout-container">
            <div class="col-sm-3">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_1">
                <?php foreach ($availableMenuOptionsArray_1 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
            <div class="col-sm-3">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_2">
                <?php foreach ($availableMenuOptionsArray_2 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
            <div class="col-sm-3">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_3">
                <?php foreach ($availableMenuOptionsArray_3 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
            <div class="col-sm-3">
              <div class="sortable footer-sortable" data-bindID="footer_option_fields_4">
                <?php foreach ($availableMenuOptionsArray_4 as $value): ?>
                    <?php if ($value != null): ?>
                      <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                          <?= $value ?>
                      </div>
                    <?php endif ?>
                 <?php endforeach ?> 
              </div>
            </div>
          </div>
        </div>
      <form method="post" action="options.php">
            <?php settings_fields( 'neptune_footer_fields' );  ?>
            <?php do_settings_sections( 'footer-settings' ); ?>
            <div class="display-none"> 
                <?php printf(
                    '<input type="text" id="footer_layout" name="neptune_footer_option[footer_layout]" value="%s" />',
                    isset( $this->options['footer_layout'] ) ? esc_attr( $this->options['footer_layout']) : 'layout-1'
                ); ?>
                <?php printf(
                    '<input type="text" id="footer_option_fields_1" name="neptune_footer_option[footer_option_fields_1]" value="%s" />',
                    isset( $this->options['footer_option_fields_1'] ) ? esc_attr( $this->options['footer_option_fields_1']) : ''
                ); ?>
                <?php printf(
                    '<input type="text" id="footer_option_fields_2" name="neptune_footer_option[footer_option_fields_2]" value="%s" />',
                    isset( $this->options['footer_option_fields_2'] ) ? esc_attr( $this->options['footer_option_fields_2']) : ''
                ); ?>
                <?php printf(
                    '<input type="text" id="footer_option_fields_3" name="neptune_footer_option[footer_option_fields_3]" value="%s" />',
                    isset( $this->options['footer_option_fields_3'] ) ? esc_attr( $this->options['footer_option_fields_3']) : ''
                ); ?>
                <?php printf(
                    '<input type="text" id="footer_option_fields_4" name="neptune_footer_option[footer_option_fields_4]" value="%s" />',
                    isset( $this->options['footer_option_fields_4'] ) ? esc_attr( $this->options['footer_option_fields_4']) : ''
                ); ?>
            </div>
            
            <input type="submit" name="submit" id="submit" class="btn" value="Save Changes">
      </form>
    </div>
    <?php
   }

  function register_settings(){
    register_setting(
              'neptune_footer_fields', // Option group
              'neptune_footer_option' // Option name
            //  array( $this, 'sanitize' ) // Sanitize
    );
  }

  //This function is for enqueue script only for this page nothing else
  function footer_scripts(){
    $current_screen = get_current_screen();
    if ($current_screen->base == 'main-settings_page_footer-settings') {
      wp_enqueue_script('footersettingjs', get_template_directory_uri()."/admin/js/settings/footer-settings.js", array(), null);
    }
  }
}// class end
$footerThemeSettings = new neptuneFooterThemeSettings();



