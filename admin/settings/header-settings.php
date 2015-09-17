<?php
/*
  neptune Header Theme Setting Page
*/

class neptuneHeaderThemeSettings
{

  public function __construct()
  {
    //add main setting page
    add_action( 'admin_menu', array( $this, 'header_settings_page' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
  }
  /**
  * Add Header settings page
  */
  function header_settings_page(){
  	add_submenu_page(
  	     'main-theme-settings',
  	     'Header Settings',
  	     'Header Settings',
  	     'manage_options',
  	     'header-settings',
  	     array($this, 'header_setting_page')
  	);
  }


   /**
    * Main Theme Settings Page
    */
   function header_setting_page()
   {
    $this->options = get_option( 'neptune_header_option' );
    $availableMenuOptions = isset( $this->options['header_option_fields'] ) ? esc_attr( $this->options['header_option_fields']) : '';
    $availableMenuOptionsArray = explode (',', $availableMenuOptions);
    ?>
    <div class="wrap">
        <h2 class="nav-tab-wrapper">
          <a class='nav-tab' href='?page=main-theme-settings'>Main Settings</a>
          <a class='nav-tab nav-tab-active' href='?page=header-settings'>Header Settings</a>
        </h2>
        <h1>Header Settings</h1>
        <h3>Fixed Header?</h3>
          <div class="switch-btn <?php echo ($this->options['fixed_header'] == 'true' ? "yes-please" : "") ?>">
            <span>No</span>
            <span>Yes</span>
            <div class="round-block"></div>
          </div>
        <h3>Choose Header Layout</h3>
        <select class="select-layout-option" data-bindID="header_layout">
          <option value="1" <?php echo ($this->options['header_layout'] == 'layout-1' ? "selected" : "") ?>>Layout 1</option>
          <option value="2" <?php echo ($this->options['header_layout'] == 'layout-2' ? "selected" : "") ?>>Layout 2</option>
        </select>
        <div class="layout layout-1 <?php echo ($this->options['header_layout'] == 'layout-1' || !isset($this->options['header_layout']) ? "" : "display-none") ?>">
          <div class="header-options">
            <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Social Medias") === false  ? "" : "display-none") ?>">
              Social Medias 
            </div>
            <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Phone") === false  ? "" : "display-none") ?>">
              Phone 
            </div>
            <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Address") === false  ? "" : "display-none") ?>">
              Address 
            </div>
            <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Search") === false  ? "" : "display-none") ?>">
              Search 
            </div>
          </div>
          <div class="row layout-container">
            <div class="col-sm-2"><div class="cover">Logo</div></div>
            <div class="col-sm-5"><div class="cover">Menu</div></div>
            <div class="col-sm-5">
              <div class="sortable" data-bindID="header_option_fields">
              <?php if ($this->options['header_layout'] == 'layout-1') { ?>
                  <?php foreach ($availableMenuOptionsArray as $value): ?>
                      <?php if ($value != null): ?>
                        <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                            <?= $value ?>
                        </div>
                      <?php endif ?>
                   <?php endforeach ?> 
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="layout layout-2 <?php echo ($this->options['header_layout'] == 'layout-2' ? "" : "display-none") ?>">
          <div class="header-options">
              <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Social Medias") === false  ? "" : "display-none") ?>">
                Social Medias 
              </div>
              <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Phone") === false  ? "" : "display-none") ?>">
                Phone 
              </div>
              <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Address") === false  ? "" : "display-none") ?>">
                Address 
              </div>
              <div class="draggable  <?php echo ( strpos($availableMenuOptions, "Search") === false  ? "" : "display-none") ?>">
                Search 
              </div>
          </div>
          <div class="row layout-container">
            <div class="col-sm-2 dummy-logo"><div class="cover">Logo</div></div>
            <div class="col-sm-10">
              <div class="sortable" data-bindID="header_option_fields">
              <?php if ($this->options['header_layout'] == 'layout-2') { ?>
                  <?php foreach ($availableMenuOptionsArray as $value): ?>
                      <?php if ($value != null): ?>
                        <div class="ui-sortable-handle" style="width: 100px; height: 26px;">
                            <?= $value ?>
                        </div>
                      <?php endif ?>
                   <?php endforeach ?> 
              <?php } ?>
              </div>
              <div class="cover">Menu</div>
            </div>
          </div>
        </div>
      <form method="post" action="options.php">
            <?php settings_fields( 'neptune_header_fields' );  ?>
            <?php do_settings_sections( 'header-settings' ); ?>
            <div class="display-none"> 
                <?php printf(
                    '<input type="text" id="fixed_header" name="neptune_header_option[fixed_header]" value="%s" />',
                    isset( $this->options['fixed_header'] ) ? esc_attr( $this->options['fixed_header']) : ''
                ); ?>
                <?php printf(
                    '<input type="text" id="header_layout" name="neptune_header_option[header_layout]" value="%s" />',
                    isset( $this->options['header_layout'] ) ? esc_attr( $this->options['header_layout']) : 'layout-1'
                ); ?>
                <?php printf(
                    '<input type="text" id="header_option_fields" name="neptune_header_option[header_option_fields]" value="%s" />',
                    isset( $this->options['header_option_fields'] ) ? esc_attr( $this->options['header_option_fields']) : ''
                ); ?>
            </div>
            
            <input type="submit" name="submit" id="submit" class="btn" value="Save Changes">
      </form>
    </div>
    <?php
   }

	function register_settings(){
		register_setting(
		          'neptune_header_fields', // Option group
		          'neptune_header_option' // Option name
		        //  array( $this, 'sanitize' ) // Sanitize
		);
	}




}// class end
$headerThemeSettings = new neptuneHeaderThemeSettings();



