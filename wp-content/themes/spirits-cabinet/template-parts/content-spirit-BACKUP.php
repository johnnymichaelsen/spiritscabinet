<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package spirits-cabinet
 */

// Grab the metabox values
$id = get_the_ID();
$show_title = get_post_meta( $id, '_create_title_show', true ); 
$hide_text = get_post_meta( $id, '_create_title_hide_text', true ); 
$subtitle = get_post_meta( $id, '_create_title_subtitle', true ); 
$title_img = get_post_meta( $id, '_create_title_img', true );
$title_parallax = get_post_meta( $id, '_create_title_parallax', true );
$title_alignment = get_post_meta( $id, '_create_title_alignment', true );
$title_bg = get_post_meta( $id, '_create_title_bg_img', true );
$title_style = "";
$full_width_content = get_post_meta( $id, '_create_post_full_width', true );

// Distillery data
$spirit_distillery = get_field('spirit_distillery');
$distillery_name = get_field('distillery_name', $spirit_distillery);
$distillery_permalink = get_permalink( $spirit_distillery );
$distillery_country_field = get_field_object('distillery_country', $spirit_distillery);
$distillery_country_value = get_field('distillery_country', $spirit_distillery);
$distillery_country_label = $distillery_country_field['choices'][ $distillery_country_value ];
$distillery_region = get_field('distillery_region', $spirit_distillery);

// Reviews data
$spirit_reviews = get_post_meta( $id, 'spirit_reviews', true );
$spirit_reviews_arr = explode(",", $spirit_reviews);

// Reviews data
$spirit_sources = get_post_meta( $id, 'spirit_sources', true );
$spirit_sources_arr = explode(",", $spirit_sources);

// User data
$user_id = get_current_user_id();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

			<!-- Spirit image -->
			<div id="spirit_image">
				<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail( 'original' );
				} 
				?>
			</div> <!-- END Spirit image -->

			<!-- Spirit marquee -->
			<div id="spirit_marquee">
				
				<!-- Spirit details -->
				<div id="spirit_details"> 

					<!-- Spirit category -->
					<div class="spirit_category">
						<p><?php the_category( ', ' ); ?></p>
					</div> <!-- END Spirit category -->
					
					<!-- Spirit title -->
					<div>	
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					
						<!-- Distillery details -->
						<?php if( $spirit_distillery ) { ?>
							<p class="entry-subtitle">Produced by <a href="<?php echo $distillery_permalink; ?>"><?php echo $distillery_name; ?></a> in <?php if ( $distillery_region ){ ?><a href="<?php echo get_site_url(); ?>/?s=<?php echo $distillery_region; ?>"><?php echo $distillery_region; } ?></a>, <a href="<?php echo get_site_url(); ?>/?s=<?php echo $distillery_country_label; ?>"><?php echo $distillery_country_label; ?></a>
							</p>
						<?php } ?>
					</div>

					<div id="spirit_title_description">
						<p><?php echo get_the_excerpt(); ?></p>
					</div>

					<div>
						<?php if(function_exists("kk_star_ratings")) : echo kk_star_ratings($pid); endif; ?>
					</div>

					<button id="addSpiritButton" value="<?php echo $id ?>">Add to my cabinet</button>
					<div id="textHint"></div>

				</div><!-- .details -->

			</div><!-- END Spirit marquee -->

			<!-- Spirit title sticky -->
			<div id="spirit_title_sticky">
				<?php the_title( '<p>', '</p>' ); ?>
			</div><!-- END Spirit title sticky -->

		
	</header><!-- .entry-header -->

	<main id="main" class="site-main" role="main">
			
		<div class="body-wrap clear">
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="body-wrap">

					<!-- CMS content -->
					<div class="entry-content">

						<div id="spirit_content">

							<?php the_content(); ?>

							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'create' ),
									'after'  => '</div>',
								) );
							?>

							<?php if(get_theme_mod( 'create_show_social_on_pages', 'no' ) == 'yes') {
								create_social_sharing(); 
							} ?>

							<!-- TEMP TAGS -->			
							<?php the_tags( '<div id="spirit_tags"><ul><li><p>', '</p></li><li><p>', '</p></li></ul></div>' ); ?>
						</div><!-- .entry-content -->

					</div><!-- .entry-content -->


					<!-- Reviews -->	
					<div id="spirit_reviews">
						<h3>Video reviews</h3>
						<ul>
							<?php
							if( !empty( $spirit_reviews ) ) {
								//for each value in the array, display the link
								foreach ( $spirit_reviews_arr as $url ) { ?>
									<li style="display:block; width:320px; height:240px;">
										<?php echo do_shortcode( '[su_youtube url="' . $url . '"]' ); ?>
									</li>
								<?php
								} //end foreach
							} //end if
							?>
						</ul>
					</div> <!-- END Reviews -->


					<!-- Sources -->	
					<div id="spirit_sources">
						<h3>Online sources</h3>
						<ul>
							<?php

							print_r(array_values($spirit_sources_arr));

							if( !empty( $spirit_sources ) ) {
								//for each value in the array, display the link
								foreach ( $spirit_sources_arr as $arr ) { 
								
									

								} //end foreach
							} //end if
							?>
						</ul>
					</div> <!-- END Sources -->


					<!-- Related spirits -->	
					<div id="spirit_others">
						<h3>Other spirits from <?php echo $distillery_name; ?></h3>
						<ul>
							<li>Other spirit goes here</li>
							<li>Other spirit goes here</li>
						</ul>
					</div> <!-- END Related -->


					<!-- Related spirits -->	
					<div id="spirit_related">
						<h3>Related spirits</h3>
						<ul>
							<li>Related spirit goes here</li>
							<li>Related spirit goes here</li>
							<li>Related spirit goes here</li>
						</ul>
					</div> <!-- END Related -->


					<!-- User compare spirits -->	
					<div id="spirit_user_compare">
						
						<p>Find users with similar cabinets function</p>
						<?php
						$array1 = array("5", "2", "38", "42", "200");
						$array2 = array("200", "42", "3", "38", "242");

						foreach ($array1 as $value) {
						    if (in_array($value, $array2)) {
						        $array3[] = $value;
						    }
						}

						print_r($array3);
						?>
						

						<p>Customizing BuddyPress: https://webdevstudios.com/2015/06/02/creating-custom-templates-for-buddypress/</p>

						<p>How to setup AJAX: https://premium.wpmudev.org/blog/using-ajax-with-wordpress/</p>
					</div> <!-- END User compare spirits -->


				</div>

			</article><!-- #post-## -->
		
		</div>

	</main><!-- #main -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'spirits-cabinet' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
