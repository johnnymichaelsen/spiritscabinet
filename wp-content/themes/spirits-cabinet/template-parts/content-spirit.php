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


// User data
$user_id = get_current_user_id();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="spirit_page_header">

			<!-- Spirit image -->
			<div class="spirit_page_image">
				<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail( 'original' );
				} 
				?>
			</div> <!-- END Spirit image -->

			<!-- Spirit marquee -->
			<div class="spirit_page_marquee">
				
				<!-- Spirit details -->
				<div class="spirit_page_details"> 

					<!-- Spirit category -->
					<div class="spirit_category">
						<p><?php the_category( ', ' ); ?></p>
					</div> <!-- END Spirit category -->
					
					<!-- Spirit title -->
					<div class="spirit_page_labels">	
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					
						<!-- Distillery details -->
						<?php if( $spirit_distillery ) { ?>
							<p class="entry-subtitle">Produced by <?php echo $distillery_name; ?> in <?php if ( $distillery_region ){ echo $distillery_region; }?>, <?php echo $distillery_country_label; ?>
							</p>
						<?php } ?>
					</div>

					<div class="spirit_page_excerpt content_height">
						<p><?php echo get_the_excerpt(); ?></p>
					</div>

				</div><!-- .details -->

			</div><!-- END Spirit marquee -->
		
	</header><!-- .entry-header -->

	<main id="main" class="site-main" role="main">
			
		<div class="body-wrap clear">
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="body-wrap">

					<!-- CMS content -->
					<div class="entry-content">

						<div class="spirit_page_content content_height">

							<?php the_content(); ?>

							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'create' ),
									'after'  => '</div>',
								) );
							?>

						</div><!-- .entry-content -->

					</div><!-- .entry-content -->

				</div>

			</article><!-- #post-## -->
		
		</div>

	</main><!-- #main -->

</article><!-- #post-## -->
