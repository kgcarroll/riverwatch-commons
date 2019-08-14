<?php
/*
  * Template Name: Area
  *
  *
  */
get_header();?>
<div id="area" class="container" role="main">
	<div id="map-container">
		<div class="categories-container">
			<ul id="categories"></ul>
		</div>
		<div id="map"></div>
	</div>
	<?php print_main_page_content(); ?>
	<?php print_area_list(); ?>
	<?php print_call_to_actions(); ?>
	<?php print_signup_form(); ?>
</div>
<?php get_footer(); ?>