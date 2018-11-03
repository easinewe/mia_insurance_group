
		<section id="mission">
			<?php
				$mission = INS_getPage(13,105);
				echo '<h3>'.$mission->title.'</h3>';
				echo $mission->content;
			?>
		</section>
		
		<section id="insurance_quote">
			
			<?php
				$iq = INS_getPage(10,103);
				echo $iq->featured_image;
				echo '<h3>'.$iq->title.'</h3>';
				echo $iq->content;
			?>

			<div id="cq_form">
				<h2><?php echo INS_translate('Get a Free Custom Quote Today.','Obtenga una cotización personalizada gratuita hoy')?></h2>	
				<?php 
					if($_SESSION['response']){
						echo '<p>'.$_SESSION['response'].'</p>';
				?>		
					<!--scroll to the form-->	
					<script>document.getElementById("cq_form").scrollIntoView();</script>
				<?php	
					}
				?>
				<form action="<?php echo $home_url; ?>" method="post">
					<span class="custom-dropdown custom-dropdown--white">
						<select id="insurance_type" name="insurance_type" class="custom-dropdown__select custom-dropdown__select--white">
    						<option value="" disabled 	<?php echo empty($_POST['insurance_type'])?'selected':''; ?>><?php echo INS_translate('Select Type of Insurance','Seleccione el tipo de seguro'); ?></option>
							<option value="home" 		<?php echo ($_POST['insurance_type'] == 'home')?'selected':''; ?>	>	<?php echo INS_translate('Home','Casa'); ?>					</option>
							<option value="condo" 		<?php echo ($_POST['insurance_type'] == 'condo')?'selected':''; ?>	>	<?php echo INS_translate('Condo','Condominio'); ?>			</option>
							<option value="flood" 		<?php echo ($_POST['insurance_type'] == 'flood')?'selected':''; ?>	>	<?php echo INS_translate('Flood','Inundar'); ?>				</option>
							<option value="auto" 		<?php echo ($_POST['insurance_type'] == 'auto')?'selected':''; ?>	>	<?php echo INS_translate('Auto','Automóvil'); ?>				</option>
							<option value="general"		<?php echo ($_POST['insurance_type'] == 'general')?'selected':''; ?>>	<?php echo INS_translate('General Liability','Responsabilidad General'); ?></option>
						</select>
					</span>
					<input type="text" 	value="<?php echo esc_attr($_POST['fname']); ?>" name="fname" placeholder="<?php echo INS_translate('First Name','Primero Nombre'); ?>">
					<input type="text" 	value="<?php echo esc_attr($_POST['lname']); ?>" name="lname" placeholder="<?php echo INS_translate('Last Name','Nombre Segundo'); ?>">
					<input type="tel"  	value="<?php echo esc_attr($_POST['phone']); ?>" name="phone" placeholder="<?php echo INS_translate('Phone Number"','Número de Teléfono'); ?>	">
					<input type="email" value="<?php echo esc_attr($_POST['email']); ?>" name="email" placeholder="<?php echo INS_translate('Email Address','Dirección de Correo Electrónico'); ?>	">
					
					<span class="auto_ins_q">
						<input type="text" 	value="<?php echo esc_attr($_POST['customer_auto_details']); ?>" name="customer_auto_details" placeholder="<?php echo INS_translate('Car Make/Model/Year','Car Make/Model/Year'); ?>">
					</span>
					
					<span class="home_ins_q">
						<input type="text" 	value="<?php echo esc_attr($_POST['home_address']); ?>" name="home_address" placeholder="<?php echo INS_translate('Home Address','Direccion de Casa'); ?>">
						<span class="custom-dropdown custom-dropdown--white">
						<select name="customer_home_ownership" class="custom-dropdown__select custom-dropdown__select--white">
								<option value="" disabled 	<?php echo empty($_POST['customer_home_ownership'])?'selected':''; ?>><?php echo INS_translate('Do you own your home?','Eres dueno de tu casa?'); ?></option>
								<option value="owned" 		<?php echo ($_POST['customer_home_ownership'] == 'owned')?'selected':''; ?>><?php echo INS_translate('Owned','Propiedad'); ?></option>
								<option value="rent"		<?php echo ($_POST['customer_home_ownership'] == 'rent')?'selected':''; ?>><?php echo INS_translate('Rent','Alquilar'); ?></option>
						</select>
						</span>
					</span>
						
					<input type="hidden" name="user_language" value="<?php echo INS_translate('english','spanish'); ?>">
					<input type="hidden" name="submitted" value="1">
					<input class="submit_button" type="submit" value="Submit">
				</form>
			</div>	
			
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
