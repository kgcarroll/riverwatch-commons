	    <footer id="mobile-footer">
	    	<div class="footer-wrapper">
		    	<div class="wrapper">
				    <?php print_footer_logo(); ?>
				    <div class="footer-social"><?php print_social(); ?></div>
					  <div class="footer-phone"><?php print_phone_number(); ?></div>
				    <div class="footer-address"><?php print_address(); ?></div>
				    <div class="management-links">
					    <?php print_footer_icons(); ?>
					    <?php print_management_logo(); ?>
				    </div>
				  </div>
			  </div>
	    </footer>

    <footer id="footer">
    	<div class="footer-wrapper">
	    	<div class="wrapper">
			    <?php print_footer_logo(); ?>
			    <div class="footer-address">
			    	<div class="title">Address</div>
				    <?php print_address_one_line(); ?>
				  </div>
				  <div class="footer-phone">
				  	<div class="title">Phone</div>
			    	<?php print_phone_number(); ?>
			    </div>
			    <div class="footer-social">
			    	<div class="title">Follow Us</div>
			    	<?php print_social(); ?>
			    </div>
			    <div class="management-links">
				    <?php print_footer_icons(); ?>
				    <?php print_management_logo(); ?>
			    </div>
			  </div>
		  </div>
    </footer>
	<?php wp_footer();?>
	</body>
</html>