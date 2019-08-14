<?php

add_action ('init', 'init_template');

function init_template(){
  setup_template_theme();
  add_action( 'wp_enqueue_scripts', 'enqueue_template_scripts', 'enqueue_template_styles' );

}

// Override 'Howdy' Message
function howdy_message($translated_text, $text, $domain) {
  $new_message = str_replace('Howdy', 'Welcome', $text);
  return $new_message;
}
add_filter('gettext', 'howdy_message', 10, 3);

function setup_template_theme(){
	// Remove added padding from Admin Bar
	remove_action('wp_head', '_admin_bar_bump_cb');

  //Setting up theme
  if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    add_theme_support( 'post-thumbnails' );
  }

  if (function_exists('register_sidebar')){
    register_sidebar(array('name'=>'Sidebar %d'));
  }

  if (function_exists('register_nav_menu')) {
    register_nav_menu( 'main_menu', 'Main Menu' );
    register_nav_menu( 'mobile_menu', 'Mobile Menu' );
  }

  if (function_exists('add_image_size')){
      add_image_size( 'gallery-thumb', 480, 342, true );
      add_image_size( 'header-nineteen', 1920, 675, true );
      add_image_size( 'header-sixteen', 1680, 591, true );
      add_image_size( 'header-fourteen', 1440, 506, true );
      add_image_size( 'header-twelve', 1280, 450, true );
      add_image_size( 'header-ten', 1024, 360, true );
      add_image_size( 'header-tablet', 768, 270, true );
  }

  if( function_exists('acf_add_options_page') ) {
      acf_add_options_page();
  }
}

// Add javascript files here.
function enqueue_template_scripts() {
  // Font Awesome
  wp_register_style( 'fontawesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
  wp_enqueue_style( 'fontawesome-css' );

  // Custom Icons
  wp_register_style( 'icomoon', get_bloginfo('template_directory') . '/icons/style.css');
  wp_enqueue_style( 'icomoon' );

  // Google hosted jQuery
  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js' );
  wp_enqueue_script( 'jquery' );

  // jQuery Placeholder
  wp_deregister_script( 'placeholder-js' );
  wp_register_script( 'placeholder-js', get_bloginfo('template_directory') . '/js/jquery.placeholder.min.js', array ( 'jquery' ) );
  wp_enqueue_script( 'placeholder-js' );

  // HTML5Shiv
  wp_register_script( 'html5shiv-js', get_bloginfo('template_directory') . '/js/html5shiv.js' );
  wp_enqueue_script( 'html5shiv-js' );


  // Custom javascript
  wp_register_script( 'template-js', get_bloginfo('template_directory') . '/js/template.js', array ( 'jquery' ) );
  wp_enqueue_script( 'template-js' );

  // Google Fonts  
  wp_register_style( 'googlefont-css', 'https://fonts.googleapis.com/css?family=Open+Sans|Squada+One' );
  wp_enqueue_style( 'googlefont-css' );

  if(is_front_page()){
    // Add popup script to the homepage.
    wp_register_script( 'popup-js', get_bloginfo('template_directory') . '/js/popup.js' );
    wp_enqueue_script( 'popup-js' );
  }

  if (is_page_template('page-templates/area.php')){
    // Google Map API
    wp_register_script( 'google_map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&#038;ver=4.5.1' );
    wp_enqueue_script( 'google_map' );
    // Custom Map JS
    wp_register_script( 'area-map-js', get_bloginfo('template_directory') . '/js/map.js', array ( 'jquery', 'google_map' ), false, false );
    wp_enqueue_script( 'area-map-js' );
  }

  if (is_page_template('page-templates/floor-plans.php')){
    // Static Floor Plans
    wp_register_script( 'floor-plans-js', get_bloginfo('template_directory') . '/js/static-floor-plans.js' );
    wp_enqueue_script( 'floor-plans-js' );
    // Lightbox JS
    wp_register_script( 'lightbox-js', get_bloginfo('template_directory') . '/js/lightbox.min.js' );
    wp_enqueue_script( 'lightbox-js' );
  }


  if (is_page_template('page-templates/gallery.php')){
    // Static Floor Plans
    wp_register_script( 'gallery-js', get_bloginfo('template_directory') . '/js/gallery.js' );
    wp_enqueue_script( 'gallery-js' );
    // Lightbox JS
    wp_register_script( 'lightbox-js', get_bloginfo('template_directory') . '/js/lightbox.min.js' );
    wp_enqueue_script( 'lightbox-js' );
  }
}

// Add CSS files here.
function enqueue_template_styles() {
	// Custom Icons
	wp_register_style( 'icomoon', get_bloginfo('template_directory') . '/icons/style.css');
  wp_enqueue_style( 'icomoon' );
}

function acf_admin_enqueue_scripts() {
  // register style
    wp_register_style( 'my-acf-input-css', get_bloginfo('template_directory') . '/css/acf.css', false, '1.0.0' );
    wp_enqueue_style( 'my-acf-input-css' );
}
add_action( 'acf/input/admin_enqueue_scripts', 'acf_admin_enqueue_scripts' );

// Adds page slug to Body Class function
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Returns property schema data
function mtc_print_microdata() {
	$microdata = array();
	if (is_page_template('page-templates/contact.php')) {
		
		// Creating the contact page microdata
		$contactMicrodata = array(
			'@context' => 'http://schema.org',
			'@type' => 'ContactPage'
		);

		// Adding The Elms microdata and then the Contact Page Microdata
		array_push($microdata, mtc_get_microdata());
		array_push($microdata, $contactMicrodata);

	} else {
		$microdata = mtc_get_microdata();
	}

	echo '<script type="application/ld+json">';
	echo json_encode($microdata, JSON_PRETTY_PRINT);
	echo '</script>';
}

function mtc_get_microdata() {
	if (function_exists('get_option')){
		$microdata = array(
			'@context' => 'http://schema.org',
			'@type' => 'Organization',
			'name' => get_field('property_name', 'options'),
			'address' => array(
				'@type' => 'PostalAddress',
				'streetAddress' => get_field('address', 'options'),
				'addressLocality' => get_field('city', 'options').', '.get_field('state', 'options'),
				'postalCode' => get_field('zip', 'options'),
			),
			'telephone' => get_field('phone', 'options'),
			'url' => get_home_url()
		);
		if ($header_logo=get_field('header_logo','options')){
			$microdata['logo']=$header_logo['url'];
		}
		return $microdata;
	}
}

// Takes an alphabetic character and returns the phone numeric equivalent
function alpha_to_phone($char){
	$conversion=array('a' => 2, 'b' => 2, 'c' => '2', 'd' => 3, 'e' => 3, 'f' => 3, 'g' => 4, 'h' => 4, 'i' => 4, 'j' => 5, 'k' => 5, 'l' => 5, 'm' => 6, 'n' => 6, 'o' => 6, 'p' => 7, 'q' => 7, 'r' => 7, 's' => 7, 't' => 8, 'u' => 8, 'v' => 8, 'w' => 9, 'x' => 9, 'y' => 9, 'z' => 9);
	return $conversion[$char];
}

// Takes phone number, returns cleaned numeric equivalent for mobile link functionality
function clean_phone($phone){
	$chars=str_split(strtolower($phone));
	$phone='';
	foreach($chars as $char){
		if (ctype_lower($char)){
			$char=alpha_to_phone($char);
		}
		$phone .= $char;
	}
	$phone=preg_replace("/[^0-9]/", "",$phone);
	return $phone;
}

// Save POI JSON
// Save POIs data to JSON file on page save
function save_poi_json($post_id){
  if (get_page_template_slug($post_id) == 'page-templates/area.php'){
    if ($rows=get_field('poi_map',$post_id)){
      $pois=array(
        'categories' => array()
      );  
      // Categories
      foreach($rows as $row){ 
        // POI Location
        $location=array();
        if (!empty($row['pois'])){
          foreach ($row['pois'] as $row2){
            $location[]=array(
              'name'=>$row2['name'],
              'address'=>$row2['address'],
              'city'=>$row2['city'],
              'state'=>$row2['state'],
              'zip'=>$row2['zip'],
              'latitude'=>$row2['latitude'],
              'longitude'=>$row2['longitude']
            );
          }
        }
        $pois['categories'][]=array(
          'category_name'=>$row['category_name'],
          'category_map_marker'=>$row['category_map_marker'],
          'pois'=>$location
        );
      }
      $property= array(
        'property_name'=>get_field('property_name', 'options'),
        'address'=>get_field('address', 'options'),
        'city'=>get_field('city', 'options'),
        'state'=>get_field('state', 'options'),
        'zip'=>get_field('zip', 'options'),
        'latitude'=>get_field('latitude', 'options'),
        'longitude'=>get_field('longitude', 'options'),
        'property_map_marker'=>get_field('property_map_marker', 'options')
      );
      $pois['property'] = $property;
      file_put_contents(get_template_directory() . '/JSON/area.json',json_encode($pois));
    }
  }
}
add_action( 'save_post', 'save_poi_json' );


// ****************  Custom Functions **************** //
// Use these functions to print content anywhere in the template.
// This allows for clarity and simplicity.
// Feel free to add/remove/change these as needed to suit your needs.
/* Example Usage:  <?php print_logo; ?> */

// Header Functions
function print_logo(){
  if($logo = get_field('logo', 'options')) {
    echo '<div id="logo">';
      echo '<a href="'. home_url('') .'">';
        echo '<img src="'. $logo['url'] .'" />';
      echo '</a>';
    echo '</div>';
  }
}

function print_mobile_menu_trigger() {
	echo '<div class="trigger">';
  	echo '<span class="line"></span>';
  	echo '<span class="line"></span>';
  	echo '<span class="line"></span>';
	echo '</div>';
}

function print_mobile_phone_link(){
  if ($phone=get_field('phone','options')){
    echo '<a href="tel:+1'.clean_phone($phone).'" class="phone-link"><i class="fa fa-phone"></i></a>';
  }
}

function print_mobile_address_link(){
  $address=get_field('address','options');
  $city=get_field('city','options');
  $state=get_field('state','options');
  $zip=get_field('zip','options');
  echo '<a class="address-link" href="https://maps.google.com/?daddr='.$address.', '.$city.', '.$state.' '.$zip.'" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>';
}

function print_landing_page_content(){
  if($background_image = get_field('background_image')) {
    $headline = get_field('headline');
    $content = get_field('content');
    $jumplink = get_field('jump_link_text');
    echo '<div class="landing-page-content" style="background-image: url('.$background_image['url'].')">';
      echo '<div class="stripes">';
        echo '<div class="headline">'.$headline.'</div>';
        echo '<div class="content"><h1>'.$content.'</h1></div>';
        echo '<div id="scroll">';
          echo '<div class="link">'.$jumplink.'</div>';
          echo '<img src="'.get_bloginfo('template_directory').'/images/down-arrow.png" />';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}

function print_main_page_content(){
  if($concept_headeline = get_field('concept_headline')) {
    if(get_field('background_image_check')) {
      $main_background_image = get_field('main_background_image');
      echo '<script>var headerHeight = '.$main_background_image['height'].'</script>';
      echo '<div id="main-page-content" class="header-image" style="background-image: url('.$main_background_image['url'].')">';
        echo '<div id="content-wrapper-image">';
          echo '<div id="main-headline" class="wrapper">'.$concept_headeline.'</div>';
          if($h1_headline = get_field('headline_h1')) {
            echo '<h1 id="headline-h1" class="wrapper">'.$h1_headline.'</h1>';
          }
          if($main_content = get_field('main_content')) {
            echo '<div id="main-content" class="wrapper">'.$main_content.'</div>';
          }
        echo '</div>';
      echo '</div>';
    } else {
      echo '<div id="main-page-content">';
        echo '<div id="content-wrapper">';
          echo '<div id="main-headline" class="wrapper">'.$concept_headeline.'</div>';
          if($h1_headline = get_field('headline_h1')) {
            echo '<h1 id="headline-h1" class="wrapper">'.$h1_headline.'</h1>';
          }
          if($main_content = get_field('main_content')) {
            echo '<div id="main-content" class="wrapper">'.$main_content.'</div>';
          }
        echo '</div>';
      echo '</div>';
    }
  }
}

function print_area_list() {
  if($area_list = get_field('area_bullet_list')) {
    echo '<div id="area-list">';
      echo '<ul class="area-list-items">';
      foreach ($area_list as $list) {
        echo '<li>'.$list['list_item'].'</li>';
      }
      echo '</ul>';
    echo '</div>';
  }
}
 
function print_list_items() {
  if($background_image = get_field('list_background_image')) {
    echo '<div id="list-background-image" style="background-image: url('.$background_image['url'].'); ">';
      echo '<div class="overlay-wrapper">';
        echo '<div class="list-wrapper wrapper-small">';
          if($list_left = get_field('list_left')) {
            echo '<ul class="left">';
            foreach ($list_left as $list) {
              echo '<li>'.$list['list_item_left'].'</li>';
            }
            echo '</ul>';
          }

          if($list_right = get_field('list_right')) {
            echo '<ul class="right">';
            foreach ($list_right as $list) {
              echo '<li>'.$list['list_item_right'].'</li>';
            }
            echo '</ul>';
          }
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}

function print_call_to_actions(){
  $i = 0;
  if($call_to_actions = get_field('call_to_action')) {
    echo '<div id="call-to-action">';
      echo '<div class="cta-wrapper wrapper">';
        foreach ($call_to_actions as $cta) {
          $i++;
          echo '<div class="cta-block block-'.$i.'">';
            echo '<div class="link">';
              echo '<div class="cta-block-wrapper" style="background-image: url('.$cta['cta_image']['url'].');">';
                echo '<span class="cta-link">';
                  echo '<span class="link-text">'.$cta['link_text'].'</span>';
                echo '</span>';
              echo '</div>';
            echo '</div>';
            echo '<div class="text">';
              echo '<div class="text-wrapper-outer">';
                echo '<div class="text-wrapper-inner">';
                  echo '<a class="" href="'.$cta['link'].'">';
                    echo '<span class="cta-title">'.$cta['title'].'</span>';
                  echo '</a>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }
      echo '</div>';
    echo '</div>';
  }
}

// Footer functions
function print_footer_logo(){
  if($footer_logo = get_field('footer_logo', 'options')) {
    echo '<div id="footer-logo">';
      echo '<a href="'. home_url('') .'">';
        echo '<img src="'. $footer_logo['url'] .'" />';
      echo '</a>';
    echo '</div>';
  }
}

function print_management_logo(){
  if($management_logo = get_field('management_logo', 'options')) {
    if($management_url = get_field('management_url', 'options')){
      echo '<div class="management-logo"><a href="'.$management_url.'" target="_blank">';
        echo '<img src="'. $management_logo['url'] .'" />';
      echo '</a></div>';
    } else {
    	echo '<div class="management-logo"><img src="'. $management_logo['url'] .'" /></div>';
    }
  }
}

function print_office_hours(){
  if ($rows=get_field('office_hours','options')) {
    echo '<div class="office-hours">';
      echo '<div class="title">Office Hours: </div>';
      foreach ( $rows as $row ) {
        echo '<div class="office-hour">';
          echo '<span class="day">'.$row['day'].' </span>';
          echo '<span class="hours">'.$row['hours'].'</span>';
        echo '</div>';
      }
    echo '</div>';
  }
}

function print_social(){
  if ($rows=get_field('social_media','options')){
    echo '<div class="icons social">';
    foreach($rows as $row){
      echo '<a class="icon" href="'.$row['url'].'" target="_blank">';
      	echo '<i class="fa '.$row['social_media_type'].'"></i>';
      echo '</a>';
    }
    echo '</div>';
  }
}

function print_privacy_policy(){
  if ($privacy = get_field('privacy_policy','options')){
    echo '<div id="privacy"><a href="'.$privacy.'">Privacy Policy</a></div>';
  }
}

function print_phone_number(){
  if ($phone=get_field('phone','options')){
    echo '<a href="tel:+1'.clean_phone($phone).'" class="phone-number">'.$phone.'</a>';
  }
}

function print_address(){
  $address=get_field('address','options');
  $city=get_field('city','options');
  $state=get_field('state','options');
  $zip=get_field('zip','options');
  echo '<div class="address">';
	  echo '<a href="https://maps.google.com/?daddr='.$address.', '.$city.', '.$state.' '.$zip.'" target="_blank">';
	    echo '<span class="first-line">'.$address.'</span><br />';
	    echo '<span class="second-line">'.$city.', '.$state.' '.$zip.'</span>';
	  echo '</a>';
  echo '</div>';
}

function print_address_one_line(){
  $address=get_field('address','options');
  $city=get_field('city','options');
  $state=get_field('state','options');
  $zip=get_field('zip','options');
  echo '<div class="address">';
    echo '<a href="https://maps.google.com/?daddr='.$address.', '.$city.', '.$state.' '.$zip.'" target="_blank">';
      echo '<span class="one-line">'.$address.', '.$city.', '.$state.' '.$zip.'</span>';
    echo '</a>';
  echo '</div>';
}

function print_address_and_phone(){
  $address = get_field('address','options');
  $city = get_field('city','options');
  $state = get_field('state','options');
  $zip = get_field('zip','options');
  $phone = get_field('phone','options');
  echo '<div class="contact-details">';
  	echo '<a class="address" href="https://maps.google.com/?daddr='.$address.', '.$city.', '.$state.' '.$zip.'" target="_blank">';
    	echo $address.'</br>'.$city.', '.$state.' '.$zip;
  	echo '</a>';
  	echo '<span class="phone">';
  		echo '<a href="tel:+1'.clean_phone($phone).'" class="phone-number">'.$phone.'</a>';
  	echo '</span>';
  echo '</div>';
}

function print_footer_icons() {
  if(get_field('eho_logo', 'options') || get_field('handi_logo', 'options') || get_field('pet_logo', 'options')) {
    echo '<div class="footer-icons">';
    if(get_field('handi_logo', 'options')) {
      if($handi_link = get_field('handi_link', 'options')) {
        echo '<span class="footer-icon"><a href="'.$handi_link.'" target="_blank"><span class="icon-handi"></span></a></span>';
      } else {
        echo '<span class="footer-icon"><span class="icon-handi"></span></span>';
      }
    }
    if(get_field('eho_logo', 'options')) {
      if($eho_link = get_field('eho_link', 'options')) {
        echo '<span class="footer-icon"><a href="'.$eho_link.'" target="_blank"><span class="icon-eho"></span></a></span>';
      } else {
        echo '<span class="footer-icon"><span class="icon-eho"></span></span>';
      }
    }
    if(get_field('pet_logo', 'options')) {
      echo '<span class="footer-icon"><span class="icon-paw"></span></span>';
    }
    echo '</div>';
  }
}

function print_slideout() {
  if(get_field('activate_slide_out', 'options')) {
    $trigger_title = get_field('slide_out_trigger_text', 'options');
    $title = get_field('slide_out_title', 'options');
    $content = get_field('slide_out_content', 'options');
    $disclaimer = get_field('slide_out_disclaimer', 'options');
    echo '<div id="specials-container">';
      echo '<div id="specials-button">'.$trigger_title.'</div>';
      echo '<div id="specials">';
        echo '<div class="inner">';
            echo '<div class="special">';
              echo '<div class="special-title">'.$title.'</div>';
              echo '<div class="special-disclaimer">'.$disclaimer.'</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}

function print_mobile_slideout() {
  if(get_field('activate_slide_out', 'options')) {
    $trigger_title = get_field('slide_out_trigger_text', 'options');
    $title = get_field('slide_out_title', 'options');
    $content = get_field('slide_out_content', 'options');
    $disclaimer = get_field('slide_out_disclaimer', 'options');
    echo '<div id="mobile-specials-container">';
      echo '<div id="mobile-specials-button">'.$trigger_title.'</div>';
      echo '<div id="specials">';
        echo '<div class="inner">';
            echo '<div class="special">';
              echo '<div class="special-title">'.$title.'</div>';
              echo '<div class="special-disclaimer">'.$disclaimer.'</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}

function print_signup_form() {
  if ($form_code=get_field('quick_signup','options')) {
    echo '<div id="quick-signup">';
      echo '<div id="quick-signup-title">keep up with the stuff that\'s going on</div>';
      echo '<div id="signup-form">';
        eval($form_code);
      echo '</div>';
    echo '</div>';
  }
}

function print_contact_form() {
  if ($form_code=get_field('contact_form_snippet')) {
    echo '<div id="contact-form">';
        eval($form_code);
    echo '</div>';
  }
}

function print_thank_you() {
  if ($thanks_message=get_field('thank_you_message')) {
    echo '<div id="thank-you">';
      echo '<div class="thanks-message">'.$thanks_message.'</div>';
    echo '</div>';
  }
}

// 404 Function
function print_404_content() {
	if($background = get_field('background_image','options')){
		$error_title = get_field('404_title','options');
		$error_content = get_field('404_content','options');
    echo '<div id="error" class="background" style="background-image: url('.$background['url'].')">';
      echo '<div class="error-wrapper pattern-overlay">';
    		echo '<h1 class="title">'.$error_title.'</h1>';
    		echo '<div class="error-content">'.$error_content.'</div>';
    		if($error_links = get_field('404_links', 'options')) {
    			foreach ($row as $link) {
    				echo '<div class="error-links">';
    					echo '<div class="link"><a href="'.$link['link_page'].'">'.$link['link_text'].'</a></div>';
    				echo '</div>';
    			}
    		}
      echo '</div>';
    echo '</div>';
	} else {
    $error_title = get_field('404_title','options');
    $error_content = get_field('404_content','options');
    echo '<div id="error" class="no-background">';
      echo '<div class="error-wrapper">';
        echo '<h1 class="title">'.$error_title.'</h1>';
        echo '<div class="error-content">'.$error_content.'</div>';
        if($error_links = get_field('404_links', 'options')) {
          foreach ($row as $link) {
            echo '<div class="error-links">';
              echo '<div class="link"><a href="'.$link['link_page'].'">'.$link['link_text'].'</a></div>';
            echo '</div>';
          }
        }
      echo '</div>';
    echo '</div>';
  }
}

// Code Snippets printed in <head> tag
function print_head_snippets() {
	if($head_snippets = get_field('head_snippets', 'options')) {
		echo $head_snippets;
	}
}

// Code Snippets printed after opening <body> tag
function print_body_open_snippets() {
	if($body_open_snippets = get_field('body_open_snippets', 'options')) {
		echo $after_body_snippets;
	}
}

// Code Snippets printed before closing </body> tag
function print_body_close_snippets() {
	if($body_close_snippets = get_field('body_close_snippets', 'options')) {
		echo $body_close_snippets;
	}
}