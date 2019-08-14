<?php
/*
* Template Name: Gallery
*
*/
get_header(); ?>
    <div id="gallery" class="container" role="main">
       <div class="content">
					<div class="images">
        		<?php
	            $photos = get_field("image_gallery");
	            $categoryArray = array("Interior"=>false,"Exterior"=>false,"Area"=>false);
	            foreach($photos as $photo){
                //loop through the photos and set category array values to true if a category is found
                $categoryArray[$photo['category']] = true;
	            }
	        	?>
            <div class="categories" style="display: none;">
              <ul>
                <li>
                	<a href="javascript:filterGallery('All')" class="selected">All</a>
                </li>

                <?php if($categoryArray['Interior']): ?>
                	<li class="Interior">
                		<a href="javascript:filterGallery('Interior')">Interior</a>
                	</li>
                <?php endif; ?>

                <?php if($categoryArray['Exterior']): ?>
                	<li class="Exterior">
                		<a href="javascript:filterGallery('Exterior')">Exterior</a>
                	</li>
                <?php endif; ?>

                <?php if($categoryArray['Neighborhood']): ?>
                	<li class="Neighborhood">
                		<a href="javascript:filterGallery('Neighborhood')">Neighborhood</a>
                	</li>
                <?php endif; ?>
              </ul>
              <div class="clear"></div>
            </div>


            <div id="gallery-container">
	            <div id="full-gallery" class="photos">
	              <?php
	              foreach($photos as $photo) : ?>
	                <div class="photo All <?php echo $photo['category'];?>">
	                  <a class="light-box" href="<?php echo $photo['image']['url'];?>" data-lightbox="categories" data-title="<?php echo $photo['caption'];?>">
	                    <span class="overlay-wrap">
	                    	<span class="overlay-bg"></span>
	                    	<span class="overlay"></span>
	                    </span>
	                    <img src="<?php echo $photo['image']['sizes']['gallery-thumb'];?>" border="0" alt="<?php echo $photo['image']['alt'];?>" title="<?php echo $photo['image']['title'];?>">
	                  </a>
	                </div>
	              <?php endforeach; ?>
	            </div>
            

	            <div id="mobile-gallery" class="photos">
	              <?php foreach($photos as $photo) : ?>
	                  <div class="photo All <?php echo $photo['category'];?>">
	                    <img src="<?php echo $photo['image']['sizes']['large'];?>" border="0" width="<?php echo $photo['image']['sizes']['gallery-thumb-width'];?>" height="<?php echo $photo['image']['sizes']['gallery-thumb-height'];?>" alt="<?php echo $photo['image']['alt'];?>" title="<?php echo $photo['image']['title'];?>">
	                    <span class="overlay"></span>
	                  </div>
	              <?php endforeach; ?>
	            </div>
	          </div>
        	</div>
        	<?php print_main_page_content(); ?>
        	<?php print_call_to_actions(); ?>
					<?php print_signup_form(); ?>
        </div>
    </div>
<?php get_footer(); ?>