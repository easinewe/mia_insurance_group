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
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129401151-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-129401151-1');
	</script>
	
	<?php	
		global $wp;
		global $response;
		$home_url = home_url( $wp->request );
	?>
	<?php 
		//what language are we speaking	
		global $ins_language;	
		$current_template_slug = get_page_template_slug( get_the_id() );
		$ins_language = ($current_template_slug == 'templates/es.php' )?'spanish':'english';
	?>
	
</head>

<body <?php body_class('offscreen'); ?>>
	
	<header>
		<span>
			<h1><a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
			<h2><?php echo ($ins_language == 'spanish')? 'Seguro a Medida de sus Necesidades':get_bloginfo('description'); ?></h2>
			<ul>
				<li><?php echo INS_translate('Home','Casa'); ?></li>
				<li><?php echo INS_translate('Condo','Condominio'); ?></li>
				<li><?php echo INS_translate('Flood','Inundación'); ?>	</li>
				<li><?php echo INS_translate('Auto','Automóvil'); ?></li>
				<li><?php echo INS_translate('General Liability','Responsabilidad General'); ?></li>
			</ul>
			<?php 
			if($ins_language == 'spanish'){
				echo '<a href="'.get_site_url().'/" id="language"><span>Visit </span>English<span> Site</span></a>';
			}else{
				echo '<a href="'.get_site_url().'/es/" id="language"><span>Visita el Sitio </span>Español</a>';
			}
			?>
			<a href="tel:305-671-3589" id="phone" >(305) 671-3589</a>
			<figure>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ciaran-fitzmaurice-mia-insurance-group-miami-florida.png" alt="Ciaran Fitzmaurice">
				<figcaption>Ciaran Fitzmaurice, Agent/Owner</figcaption>
			</figure>
		</span>
	</header>
	
	<main>
