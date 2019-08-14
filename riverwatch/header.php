<!DOCTYPE html>
<html>
  <head>
    <title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/style.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/css/screen.css">
    
    <script> var templateURL="<?php bloginfo("template_url"); ?>"; </script>
    
    <link rel="icon" href="<?php bloginfo("template_url"); ?>/images/favicon.ico">

    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/ie.css">
    <script src="<?php bloginfo('template_url'); ?>/js/html5shiv.js"></script>
    <![endif]-->

    <?php print_head_snippets(); ?>
    <?php mtc_print_microdata(); ?>  
    <?php wp_head(); ?>

    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '715536731965397');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=715536731965397&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
  </head>

  	<body <?php body_class(); ?>>
      <div id="wrapper">
      <header id="mobile-header">
        <div class="header-wrap">
          <?php print_mobile_slideout(); ?>
          <?php print_logo(); ?>
          <?php print_mobile_menu_trigger(); ?>
          <nav class="navigation"><?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'main_menu') ); ?></nav>
        </div>
      </header>
        <?php print_landing_page_content(); ?>
        <header id="header">
          <div class="header-wrap">
            <?php print_slideout(); ?>
            <nav class="navigation"><?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'main_menu') ); ?></nav>
          </div>
        </header>