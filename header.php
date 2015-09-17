<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package neptune
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '-', true, 'right' ); ?></title>

	<?php wp_head(); ?>

	<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style-lte-ie9.css" />
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/respond.js"></script>
	<![endif]-->

</head>

<body <?php body_class(); ?>>

<?php include_once("assets/images/defs.svg"); ?>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'neptune' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>

	</header>

	<div id="content" class="site-content">