<?php 
/*
* Front page template
*
*/
get_header(); ?>
<div id="home" class="container" role="main">
	<div class="content">
		<?php print_main_page_content(); ?>
		<?php print_call_to_actions(); ?>
		<?php print_signup_form(); ?>
	</div>
</div>
<?php get_footer(); ?>