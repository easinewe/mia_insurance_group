<?php

/**
 * MIA Insurance functions and definitions
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */



//Enqueues scripts and styles.
function twentysixteen_scripts() {
	
	//load custom js
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array(), $version, true );
	
	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

}



/*------ADDED BY ME---------*/

//remove the posts post type
function INS_custom_menu_page_removing() {
    remove_menu_page( 'edit.php' );
}


//start session
function INS_start_session(){
	
	//on INS init start session
	if(!session_id()) {
        session_start();
    }
	
	$_SESSION['begun'] = 'INS Session has begun';
}


//register custom post types
function INS_create_post_type() {
  register_post_type( 'tout',
    array(
      'labels' => array(
        'name' => __( 'Touts' ),
        'singular_name' => __( 'Touts' )
      ),
	  'publicly_queryable'  => false,	
      'public' 				=> true,
      'has_archive' 		=> true,
	  'menu_icon' 			=> 'dashicons-format-quote',
    )
  );

	register_post_type( 'customer',
    array(
      'labels' => array(
        'name' => __( 'Customers' ),
        'singular_name' => __( 'Customer' )
      ),
	  'publicly_queryable'  => false,	
      'public' 				=> true,
      'has_archive' 		=> true,
	  'menu_icon' 			=> 'dashicons-groups',
    )
  );
}


// Define Meta Box: customer info
function DEVONA_metabox_customerInfo( $post ) {

	// set the variables
	global $timers;
	$timer = microtime(true) - .001;

	// set nonce
	wp_nonce_field( plugin_basename( __FILE__ ), 'customer_info_nonce' );
	
	// set the variables
	$first_name = 	get_post_meta( $post->ID, 'customer_first_name', 		true );
	$last_name 	= 	get_post_meta( $post->ID, 'customer_last_name', 		true );
	$email 		= 	get_post_meta( $post->ID, 'customer_email_address', 	true );
	$phone 		= 	get_post_meta( $post->ID, 'customer_phone',		 		true );
	$insurance 	= 	get_post_meta( $post->ID, 'customer_insurance_type',	true );

	//set the insurance types
	$insurance_types = ['home','condo','flood','auto','general'];
	
	// create the input
	echo '<label for="staff"></label>';
	echo '<label><strong>First Name</strong></label><br/>';
	
	echo '<input type="textarea" style="width:50%" id="customer_first_name" name="customer_first_name" placeholder="first name" value="'.$first_name.'"/><br/><br/>';
	echo '<label><strong>Last Name</strong></label><br/>';
	echo '<input type="textarea" style="width:50%" id="customer_last_name" name="customer_last_name" placeholder="last name" value="'.$last_name.'"/><br/><br/>';
	
	echo '<label><strong>Email Address</strong></label><br/>';
	echo '<input type="textarea" style="width:100%" id="customer_email_address" name="customer_email_address" placeholder="email address" value="'.$email.'"/><br/><br/>';
	
	echo '<label><strong>Phone Number</strong></label><br/>';
	echo '<input type="textarea" style="width:100%" id="customer_phone" name="customer_phone" placeholder="phone number" value="'.$phone.'"/><br/><br/>';
	
	echo '<label><strong>Insurance Type</strong></label><br/>';
	echo '<input type="textarea" style="width:100%" id="customer_insurance_type" name="customer_insurance_type" placeholder="insurance type" value="'.$insurance.'"/><br/><br/>';

	echo '<label><strong>Insurance Type</strong></label><br/>';
	echo "<select id='customer_insurance_types' name='customer_insurance_type'>";
		foreach($insurance_types as $itype){
			echo '<option value="'.$itype.'" '.( ( $insurance == $itype )? 'selected': '' ).'>'.$itype.'</option>';
		}
	echo '</select><br/>';   

	// calculate time
	$timer = microtime(true) - $timer;
	$timers['Meta Box']['Team Member Info'][] = $timer;
}

//Add Metaboxes
function INS_addMetaBoxes(){

	// set the variables
	global $timers;
	$timer = microtime(true) - .001;
	
	add_meta_box( 'staff_info_box',				'Customer Info',					'DEVONA_metabox_customerInfo',		'customer',			'normal',	'high' );
	
	// calculate time
	$timer = microtime(true) - $timer;
	$timers['Add Meta Boxes'][] = $timer;
}

// Save post meta
function INS_savePost( $post_id ){

	// set the variables
	global $timers;
	$timer = microtime(true) - .001;
	
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	
	// Check the user's permissions.
	if ( !current_user_can( 'edit_page', $post_id ) ) { return; } 
	
	// set the variables
	$updates = array();
	$verifications = array(

		// staff info box
		array(
			"nonce" => ( isset( $_POST[ 'customer_info_nonce' ] ) )? $_POST[ 'customer_info_nonce' ]: false,
			"type" => 'default',
			"fields" => array( 'customer_first_name', 'customer_last_name', 'customer_insurance_type', 'customer_email_address', 'customer_phone' )
		)
		
	);
	
	// sanatize the data
	foreach( $verifications as $potential ){
		if ( isset( $potential['nonce'] ) && wp_verify_nonce( $potential['nonce'], plugin_basename( __FILE__ ) ) ) {
			foreach( $potential['fields'] as $option ){
				if ( $potential['type'] == 'checkbox' ){
					$updates[ $option ] = ( isset( $_POST[ $option ] ) )? sanitize_html_class( $_POST[ $option ] ): ''; 
				}
				else if ( isset( $_POST[ $option ] ) ){
					$updates[ $option ] = $_POST[ $option ]; 
				}
			}
		}
	}
	
	// update the post meta
	foreach( $updates as $updatekey => $update ){
		update_post_meta( $post_id, $updatekey, $update );
	}
	
	// calculate time
	$timer = microtime(true) - $timer;
	$timers['Save Post'][] = $timer;
}



//Get INS touts
function DEVONA_get_touts(){
	
    $output = array();

	$args = array(
        'post_type' => 'tout',
        'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'ASC',
		'posts_per_page' => -1
    );

	
    //process the post query
    $query = new WP_Query( $args );
    while ( $query->have_posts() ){
        $query->the_post();
      	$id = get_the_ID();
		
		$output[] = array(
      		"id"				=> $id,
			"title"				=> get_the_title( $id ),
			"content"			=> get_the_content( $id ),
    	);

    }
    wp_reset_postdata();
    

    // return the output
    return $output;
}


//get page information
function INS_getPage($page_id){
	
	//create empty object
	$output = new stdClass();
	
	//get post data
	$post = get_post($page_id); 

	//add post data to object
	$output->featured_image = get_the_post_thumbnail($page_id,'full');
	$output->title = $post->post_title;
	$output->content = apply_filters('the_content', $post->post_content);
	
	return $output;
	
}


//Add Business Info Fields
function INS_addContactFields(){
	
	//phone
	echo '<label for="company_phone">Phone Number</label><br />';
	echo '<input type="text" class="regular-text code" value="'.get_option('DEVONA_company_phone').'" id="company_phone" name="DEVONA_company_phone"><br /><br />';
	
	//fax
	echo '<label for="company_fax">Fax Number</label><br />';
	echo '<input type="text" class="regular-text code" value="'.get_option('DEVONA_company_fax').'" id="company_fax" name="DEVONA_company_fax"><br /><br />';
	
	//email
	echo '<label for="company_email">Company Email</label><br />';
	echo '<input type="text" class="regular-text code" value="'.get_option('DEVONA_company_email').'" id="company_email" name="DEVONA_company_email"><br /><br />';
	
	//address
	echo '<label for="company_addresss">Company Address</label><br />';
	echo '<input type="text" class="regular-text code" value="'.get_option('DEVONA_company_address').'" id="company_address" name="DEVONA_company_address"><br /><br />';

}

//check if the user email address already exists
function INS_does_email_exist($email){
	
	//set variables
	$output ='';


	//check if the user email already exists	
	$args = array(
	   'fields' 	 => 'ids',
	   'post_type'   => 'customer',
	   'meta_query'  => array(
		 array(
		 'key' 	 => 'customer_email_address',
		 'value' => $email
		 )
	   )
	 );
	
	 $email_query = new WP_Query( $args );
	 
	//does the email exist in the database
	if( !empty($email_query->have_posts()) ) {
	   $output = true;
	 }else{
	   $output = false;
	 }
		
	wp_reset_postdata(); 
	
	return $output;
}

//validate user info 
function INS_customer_validate_info() {
	
	// set the variables
	global $timers;
	$timer = microtime(true) - .001;
	$response = "";

	  //response messages
	  $missing_content 	= "Please enter your name!";
	  $missing_phone	= "Please enter a phone number!";
	  $email_invalid   	= "Please enter a valid email address.";
	  $not_validated  	= "The item you are looking for is currently not available. Please try again later.";
	  $validated    	= "Thanks for submitting. An MIA agent will contact you shortly to discuss options.";
	  $registered		= "Thanks, you are already a registered MIA customer.";

	  //user posted variables
	  $insurance	= isset($_POST['insurance_type'])	?	$_POST['insurance_type']:'';
	  $first_name 	= isset($_POST['fname'])			?	$_POST['fname']:'';
	  $last_name 	= isset($_POST['lname'])			?	$_POST['lname']:'';
	  $phone 		= isset($_POST['phone'])			?	$_POST['phone']:'';
	  $email		= isset($_POST['email'])			?	$_POST['email']:'';
	
	  //is the user already registered	
	  $already_registered = INS_does_email_exist($email);

	
		if($_POST['submitted']){
			$_SESSION['status']  = "post has been submitted";
		  //validate email
		  if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
			$_SESSION['status']  = "error";
			$_SESSION['response']  = $email_invalid;
		  }else{
			//does email already exist
			if( $already_registered ){
				$_SESSION['status']  = "success";
				$_SESSION['response']  = $registered;
			//validate presence of name
			}else if( empty($first_name) ){
				$_SESSION['status']  = "error";
				$_SESSION['response']  = $missing_content;
			//validate presence of phone
			}else if( empty($phone) ){
				$_SESSION['status']  = "error";
				$_SESSION['response']  = $missing_phone;
			}else{
				//ready to go!
				$_SESSION['status']  = "success";
				$_SESSION['response']  = $validated;
				$_SESSION['user_id'] =  DEVONA_create_customer($first_name,$last_name,$email,$phone,$insurance);
			}  
		  }
		}
	
	//var_dump($_SESSION);
	//var_dump($_POST);

	
	// calculate time
	$timer = microtime(true) - $timer;
	$timers['Press Collection: Validate Info'][] = $timer;
	
//	$_SESSION['response']  = $response;

}

// Saving add or update press user
function DEVONA_create_customer($first_name,$last_name,$email,$phone,$insurance){
	
	// set the variables
	global $timers;
	$timer = microtime(true) - .001;
	$output = array();

	   $post_id = wp_insert_post(array (
		   'post_type' => 'customer',
		   'post_title' => $first_name.' '.$last_name,
		   'post_status' => 'publish',
	   ));
	
	   if ($post_id) {
		   // insert post meta
		   add_post_meta($post_id, 'customer_email_address', 		$email);
		   add_post_meta($post_id, 'customer_first_name', 			$first_name);
		   add_post_meta($post_id, 'customer_last_name', 			$last_name);
		   add_post_meta($post_id, 'customer_phone', 				$phone);
		   add_post_meta($post_id, 'customer_insurance_type', 		$insurance);

		   //set the returned id value
		   $output = $post_id;
	   }
	
	return $output;
	
	// calculate time
	$timer = microtime(true) - $timer;
	$timers['Create Customer'][] = $timer;

}


function INS_adminInit() {
	
	// remove pages
	remove_menu_page( 'index.php' ); 
	remove_menu_page( 'plugins.php' );
	remove_menu_page( 'tools.php');
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'themes.php' );
//	remove_menu_page( 'edit.php');
//	remove_menu_page( 'upload.php' ); 
		
	//register company info
	register_setting( 'general', 'DEVONA_company_phone' );
 	register_setting( 'general', 'DEVONA_company_fax' );
 	register_setting( 'general', 'DEVONA_company_email' );
 	register_setting( 'general', 'DEVONA_company_address' );
	add_settings_field(	'business_info_unique', 'Business Info', 'INS_addContactFields', 'general', 'default' );
	
}




//HOOKS//
add_action( 'add_meta_boxes', 				'INS_addMetaBoxes' );
add_action( 'admin_init', 					'INS_adminInit');
add_action( 'admin_menu', 					'INS_custom_menu_page_removing' );
add_action( 'init', 						'INS_start_session' );
add_action( 'init', 						'INS_customer_validate_info' );
add_action( 'init', 						'INS_create_post_type' );
add_action( 'save_post', 					'INS_savePost' );
add_action( 'wp_enqueue_scripts', 			'twentysixteen_scripts' );

