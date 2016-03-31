<?php
/**
 * The Template for displaying all single posts.
 *
 * @package create
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

// Spirits associated to this Distillery
$spirit_page_args = array(
	'sort_order' => 'asc',
	'sort_column' => 'post_title',
	'hierarchical' => 1,
	'exclude' => '',
	'include' => '',
	'meta_key' => '',
	'meta_value' => '',
	'authors' => '',
	'exclude_tree' => '',
	'number' => '',
	'offset' => 0,
	'post_type' => 'spirits',
	'post_status' => 'publish'
);
$spirits = get_pages($spirit_page_args); 



$header_class = $title_alignment;
if($title_parallax=='yes'){
	$header_class .= " parallax-section title-parallax";
}


get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div id="primary" class="content-area blog">
		
		<header class="main entry-header <?php echo $header_class; ?>" <?php if($title_parallax=="yes"){?> data-smooth-scrolling="off" data-scroll-speed="1.5" data-parallax-image="<?php echo $title_bg; ?>" data-parallax-id=".title-parallax" <?php } ?>>
			<div class="inner">
				<div class="title">	
				<?php if( $title_img ) { ?>
					<img src="<?php echo $title_img; ?>">
				<?php } ?>
				<?php if ($hide_text!='yes'){?>	
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<span class="meta <?php create_meta_class(); ?>">
							<?php create_the_post_meta(); ?>
						</span>
				<?php } ?>
				</div>
			</div><!-- .inner -->
		</header><!-- .entry-header -->
		
		<main id="main" class="site-main" role="main">
			<div class="body-wrap clear">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('content-main'); ?>>

				<?php get_template_part( 'templates/content', 'single' ); ?>


					<div>
						<?php 
						foreach( $spirits as $page ) {		

							$spirit_distillery = get_field('spirit_distillery', $page );
							if ( $spirit_distillery->ID == $id ){

								?>
									<p><a href="<?php echo get_the_permalink( $page )?>"><?php echo $page->post_title; ?></a></p>
								
								<?php

							} 
						}
						?>

					</div>

				
				<footer class="post-nav">
					<?php if(get_theme_mod( 'create_show_social_on_posts', 'yes' ) == 'yes') {
						create_social_sharing(); 
					} ?>
				
					<?php create_the_post_nav(); ?>
					
				</footer>

			</article><!-- #post-## -->
			

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>