<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<?php	
		global $wp;
		global $response;
		$home_url = home_url( $wp->request );
	?>
	
</head>

<body <?php body_class(); ?>>
	
	<header>
		<span>
			<h1><?php echo get_bloginfo('name'); ?></h1>
			<h2><?php echo get_bloginfo('description'); ?></h2>
			<ul>
				<li>Home</li>
				<li>Condo</li>
				<li>Flood</li>
				<li>Auto</li>
				<li>General Liability</li>
			</ul>
			<a href="http://www.nytimes.com" id="language">Hablamos Espa&ntilde;ol!</a>
			<a href="tel:305-671-3589" id="phone" >305-671-3589</a>
			<figure>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ciaran-fitzmaurice-mia-insurance-group-miami-florida.png" alt="Ciaran Fitzmaurice">
				<figcaption>Ciaran Fitzmaurice, Agent/Owner</figcaption>
			</figure>
		</span>
	</header>
	
	<main>
