<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

	</main><!-- .site-content -->
	<footer>
		<span>
		<h4>MIA Insurance Group</h4>
		<address><!--note: display-table and header footer attributes to change direction-->
			<div id="contact" class="row">
				<span>Phone</span> 		<?php echo get_option('DEVONA_company_phone'); ?><br/>
				<span>Fax</span> 		<?php echo get_option('DEVONA_company_fax'); ?><br/>
				<span>Email</span> 		<a href="mailto:info@miainsurancegroup.com"><?php echo get_option('DEVONA_company_email'); ?></a>
			</div>
			<div id="office" class="row">
				<span>Office</span> 	9600 NW 25 Street<br/>
				<span></span>			Suite #4A<br/>
				<span></span>			Doral, FL 33172
			</div>
			<div id="map" class="row">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.226349634342!2d-80.35310414119701!3d25.79610559885068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9c741bf1b27a9%3A0xd5867c95c215e311!2sMIA+Insurance+Group!5e0!3m2!1sen!2sus!4v1534807241748" width="372" height="158" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</address>
		<section id="social">
			<ul>
				<li id="social_fb"><a href="<?php echo get_option('INS_company_facebook'); ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook.svg"><span>Facebook</span></a></li>
				<li id="social_insta"><a href="<?php echo get_option('INS_company_instagram'); ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/instagram.svg"><span>Instagram</span></a></li>
			</ul>	
		</section>	
		<div id="copyright">© 2009 – 2018 MIA Insurance Group</div>
		</span>		
	</footer>	

<?php wp_footer(); ?>
</body>
</html>
