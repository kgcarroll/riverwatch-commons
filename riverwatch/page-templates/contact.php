<?php 
/*
* Template Name: Contact
*
*/
get_header(); ?>
    <div id="contact" class="container" role="main">
        <div class="content">
        	<?php print_main_page_content(); ?>
        	<div id="form-and-hours">
        		<div class="background-wrap">
        			<div class="form-and-hours-wrap wrapper-small">
        				<?php print_contact_form(); ?>
        				<?php print_office_hours(); ?>
                        <div class="address-container">
                            <div class="title">Address</div>
                            <?php print_address(); ?>
                            <?php if($residents_link = get_field('resident_portal_link','options')){
                                echo '<div class="residents-links"><a target="_blank" href="'.$residents_link.'">Resident Portal</a></div>';
                            }?>
                            <?php if($applicant_link = get_field('applicant_portal_link','options')){
                                echo '<div class="residents-links"><a target="_blank" href="'.$applicant_link.'">Applicant Portal</a></div>';
                            }?>
                            <?php if($apply_link = get_field('apply_now_link','options')){
                                echo '<div class="residents-links"><a target="_blank" href="'.$apply_link.'">Apply Now</a></div>';
                            }?>
                        </div>
        			</div>
        		</div>
        	</div>
        	
        	<?php print_call_to_actions(); ?>
        	<?php print_signup_form(); ?>
        </div>  
    </div>
<?php get_footer(); ?>