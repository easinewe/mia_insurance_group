
		<section id="mission">
			<?php
				$mission = INS_getPage(13,105);
				echo '<h3>'.$mission->title.'</h3>';
				echo $mission->content;
			?>
		</section>
		
		<section id="insurance_quote">
			<div id="cq_form">
				<h2><?php INS_translate('Get a Free Custom Quote Today.','Obtenga una cotización personalizada gratuita hoy')?></h2>	
				<?php 
					if($_SESSION['response']){
						echo '<p>'.$_SESSION['response'].'</p>';
					}
				?>
				<form action="<?php echo $home_url; ?>" method="post">
					<span class="custom-dropdown custom-dropdown--white">
						<select name="insurance_type" class="custom-dropdown__select custom-dropdown__select--white">
    						<option value="" disabled 	<?php echo empty($_POST['insurance_type'])?'selected':''; ?>>Select Type of Insurance</option>
							<option value="home" 		<?php echo ($_POST['insurance_type'] == 'home')?'selected':''; ?>>Home</option>
							<option value="condo" 		<?php echo ($_POST['insurance_type'] == 'condo')?'selected':''; ?>>Condo</option>
							<option value="flood" 		<?php echo ($_POST['insurance_type'] == 'flood')?'selected':''; ?>>Flood</option>
							<option value="auto" 		<?php echo ($_POST['insurance_type'] == 'auto')?'selected':''; ?>>Auto</option>
							<option value="general"		<?php echo ($_POST['insurance_type'] == 'general')?'selected':''; ?>>General Liability</option>
						</select>
					</span>
					<input type="text" 	value="<?php echo esc_attr($_POST['fname']); ?>" name="fname" placeholder="<?php INS_translate('First Name','Primero Nombre'); ?>">
					<input type="text" 	value="<?php echo esc_attr($_POST['lname']); ?>" name="lname" placeholder="<?php INS_translate('Last Name','Nombre Segundo'); ?>">
					<input type="tel"  	value="<?php echo esc_attr($_POST['phone']); ?>" name="phone" placeholder="Phone Number">
					<input type="email" value="<?php echo esc_attr($_POST['email']); ?>" name="email" placeholder="Email Address">
					<input type="hidden" name="submitted" value="1">
					<input class="submit_button" type="submit" value="Submit">
				</form>
			</div>	
			
			<?php
				$iq = INS_getPage(10,103);
				echo $iq->featured_image;
				echo '<h3>'.$iq->title.'</h3>';
				echo $iq->content;
			?>
		</section>
	
		<section id="about">
			<?php
				$about = INS_getPage(7,107);
				echo $about->featured_image;
				echo '<h3>'.$about->title.'</h3>';
				echo $about->content;
			?>

			<aside>
				<?php
					$touts = DEVONA_get_touts();
					$i=0;
					foreach($touts as $tout){
						$state = ($i==0)?'active':'';
						echo '<p class="'.$state.'">"'.$tout['content'].'"';
						echo '<span>- '.$tout['title'].'</span></p>';
						$i++;
					}
				?>
			</aside>
		</section>
		
		
		<section id="providers">
			<?php
				$providers = INS_getPage(18,114);
				echo $providers->featured_image;
				echo '<h3>'.$providers->title.'</h3>';
				echo $providers->content;
			?>
		</section>	
