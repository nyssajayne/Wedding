<?php 

/* Template Name: Main Page */

?>

<?php get_header(); ?>
	
	<div id="header-wrapper">
		<div id="map-canvas"> </div>
		
		<header>
			<h1><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php the_title(); ?>" /></h1>
		</header>

	</div>

	<div id="wrapper">

		<?php get_sidebar(); ?>

		<div id="main">

			<article>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile;
				endif; ?>
			</article>
				
		</div>
	</div>

<?php get_footer(); ?>