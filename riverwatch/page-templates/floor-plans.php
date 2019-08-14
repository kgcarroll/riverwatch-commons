<?php
/*
* Template Name: Floor Plans
*
*/
get_header(); ?>
    <div id="floorplans" class="container" role="main">
        <div class="content">

        <?php $rows=get_field('floor_plans');

					if ($background_image=get_field('header_image')) : ?>

					<script>var headerHeight = <?php echo $background_image['height']; ?></script>
					<div class="categories" style="background-image: url(<?php echo $background_image['url']; ?>">
						<div class="stripes">
							<?php if ($rows) : $i=0; ?>
								<div class="static-landing hide-mobile">

									<?php if ($headline=get_field('floor_plans_headline')) : ?>
										<div class="headline-top"><h2><?php echo $headline; ?></h2></div>
									<?php endif; ?>
								
									<div class="category-wrapper">
										<?php foreach($rows as $row) : ?>
										 	<?php if (!$row['hide_category']) : $i++; ?>
												<a href="javascript:void(0)" class="landing-category" onclick="displayFP('fp<?php echo $i; ?>');">
													<div class="title"><?php echo $row['category_name']; ?></div>
												</a>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="bottom-section">


				<?php if ($bottom_headline=get_field('bottom_headline')) : ?>
					<div class="headline-bottom"><h1><?php echo $bottom_headline; ?></h1></div>
				<?php endif; ?>
					<div class="floor-plans">
						<div class="inner-column">
							<?php
							if ($rows){
								$i=0;
								foreach($rows as $row){
									if (!$row['hide_category']){ $i++; $j=0; $pages=1; ?>
										<div class="floor-plan-title display-mobile center" onclick="toggleFP('fp<?php echo $i; ?>');">
											<h2><?php echo $row['category_name']; ?></h2>
										</div>
										<div class="floor-plan-container hide-mobile" id="fp<?php echo $i; ?>">
											<?php if ($apply_online_url=get_field('apply_online_url')){ ?>
												<div class="center">
													<a class="apply-online" href="<?php echo $apply_online_url; ?>" target="_blank">
														<h2>Apply Online</h2>
													</a>
												</div>
											<?php } ?>
											<div class="floor-plan-page active" id="fp<?php echo $i; ?>-page<?php echo $pages; ?>">
												<?php foreach($row['floor_plans'] as $fp){
													if (!$fp['hide']){
														$j++;
														/* only show 7 plans at a time */
														if ($j % 7 == 0){$pages++;
														?>
															</div>
															<div class="floor-plan-page" id="fp<?php echo $i; ?>-page<?php echo $pages; ?>">
														<?php } ?>
														<div class="floor-plan clearfix">
															<div class="one-third-column float-left fp-info center">
																<?php if ($fp['name']){ ?>
																	<div class="name">
																		<?php echo $fp['name']; ?>
																	</div>
																<?php } ?>
															</div>

															<?php if ($fp['floor_plan_image']) : ?>
																<div class="one-third-column float-left fp-image right">


																	<a class="light-box" href="<?php echo $fp['floor_plan_image']['url']; ?>" data-lightbox="floorplan" data-title="<?php if ($fp['name']){ ?><span class='name'><?php echo $fp['name']; ?></span><?php } ?><?php if ($fp['square_footage']){ ?><span class='sqft'><?php echo $fp['square_footage']; ?> sq. ft.</span><?php } ?><?php if ($fp['bedrooms']){ ?><?php if ($fp['bedrooms'] == 'studio') { ?><span class='bedrooms'><?php echo $fp['bedrooms']; ?></span><?php } else { ?><span class='bedrooms'><?php echo $fp['bedrooms']; ?> bedroom<?php if ($fp['bedrooms'] != 1){ echo 's';} ?></span><?php } ?><?php } ?><?php if ($fp['bathrooms']){ ?><span class='bathrooms'> , <?php echo $fp['bathrooms']; ?> bathroom<?php if ($fp['bathrooms'] != 1){ echo 's';} ?></span><?php } ?>">
																		<img src="<?php echo $fp['floor_plan_thumbnail']['url']; ?>" alt="<?php echo $fp['floor_plan_thumbnail']['alt']; ?>" />
																	</a>
																</div>
															<?php endif; ?>
															<div class="one-third-column float-left fp-info">
																<div class="top-info">
																	<?php if ($fp['square_footage']){ ?>
																		<div class="sqft">
																			<span><?php echo $fp['square_footage']; ?></span> sq. ft.
																		</div>
																	<?php } ?>
																	<?php if ($fp['bedrooms']){ ?>
																		<?php if ($fp['bedrooms'] == 'studio') { ?>
																		<div class="bedrooms">
																			<?php echo $fp['bedrooms']; ?>
																		</div>
																		<?php } else { ?>
																			<div class="bedrooms">
																				<?php echo $fp['bedrooms']; ?> bedroom<?php if ($fp['bedrooms'] != 1){ echo 's';} ?>
																			</div>
																		<?php } ?>
																	<?php } ?>
																	<?php if ($fp['bathrooms']){ ?>
																		<div class="bathrooms">
																			| <?php echo $fp['bathrooms']; ?> bathroom<?php if ($fp['bathrooms'] != 1){ echo 's';} ?>
																		</div>
																	<?php } ?>
																</div>
																<div class="bottom-info">
																	<?php if ($fp['pdf']){ ?>
																		<div class="pdf-link">
																			<a href="<?php echo $fp['pdf']['url']; ?>" target="_blank">
																				VIEW PDF
																			</a>
																		</div>
																	<?php } ?>
																	<?php if ($availability_link = get_field('availablity_link')){ ?>
																		<div class="availability-link">
																			<a href="<?php echo $availability_link; ?>" target="_blank">AVAILABILITY</a>
																		</div>
																	<?php } ?>
																</div>
															</div>
														</div>
													<?php
													}
												}
												?>
											</div>
											<?php
											/* assemble pagination if more than 7 plans exist for current category */
											if ($pages > 1){
											?>
												<div class="pagination hide-mobile center">
													<ul class="clearfix">
														<?php for ($k=1;$k<=$pages;$k++){ ?>
															<li id="pagination-fp<?php echo $i; ?>-page<?php echo $k; ?>"<?php echo ($k == 1) ? ' class="active"' : ''; ?> onclick="displayPage(<?php echo $i; ?>,<?php echo $k; ?>);">
																<?php echo $k; ?>
															</li>
														<?php } ?>
													</ul>
												</div>
											<?php } ?>
										</div>
									<?php
									}
								}
							}
							?>
						</div>
					</div>
				</div>
        	<?php print_call_to_actions(); ?>
					<?php print_signup_form(); ?>
        </div>
    </div>
<?php get_footer(); ?>