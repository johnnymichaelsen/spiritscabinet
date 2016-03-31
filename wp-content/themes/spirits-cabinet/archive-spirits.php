<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package spirits-cabinet
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="spirit_list">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			?>
				<div class="spirit_list_item">
					<!-- Spirit image -->
					<div class="spirit_list_image">
						<?php 
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							the_post_thumbnail( 'thumbnail' );
						} 
						?>
					</div>

					<div class="spirit_list_info">
					 	<!-- Display the Title as a link to the Post's permalink. -->
					 	<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					 	<!-- Display the Post's content in a div box. -->
					 	<div class="entry">
					 		<?php echo get_the_excerpt(); ?>
					 	</div>
				 	</div>
				</div>
			<?php
			endwhile;
			?>
			</div> <!-- closes the list div box -->
			<?php	

			else :

				get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
