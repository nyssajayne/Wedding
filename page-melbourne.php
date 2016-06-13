<?php 

/* Template Name: Melbourne */

?>

<?php get_header(); ?>

		<?php switch_or_logout($current_user->ID); ?>

		<header>
			<img src="<?php echo get_template_directory_uri(); ?>/images/mel-sign.png" alt="Neil and Nyssa 2015" />
		</header>

		<svg>
			<text y="36" font-size="3.6rem" font-weight="600" stroke="#DF00DD" stroke-width="2.1" fill="none">
				<tspan x="50%" text-anchor="middle">You're Invited <tspan class="homecoming">to the Homecoming</tspan></tspan>
				<tspan x="50%" dy="45" text-anchor="middle"><?php echo $current_user->display_name; ?></tspan>
			</text>
			<text y="36" width="100%" height="40" font-size="3.6rem" font-weight="600" stroke="#FFFFFF" stroke-width="0.7" fill="none" text-anchor="middle">
				<tspan x="50%" text-anchor="middle">You're Invited <tspan class="homecoming">to the Homecoming</tspan></tspan>
				<tspan x="50%" dy="45" text-anchor="middle"><?php echo $current_user->display_name; ?></tspan>
			</text>

			<text id="rsvp" x="50%" y="120" width="100%" height="40" font-size="2.4rem" font-weight="300" stroke="#9EC8E9" stroke-width="0.8" fill="#FFFFFF" text-anchor="middle">CLICK TO RSVP</text>
		</svg>

		<div id="wrapper">

			<div id="main">

				<article class="introduction">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endwhile;
				endif; ?>
				</article>

				<?php 
					$args = array (
						'post_type'	=> 'post',
						'cat'	=> 4,
						'orderby' => 'date',
						'order' => 'asc'
					);

					$the_query = new WP_Query($args);
				?>

				<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<article class="blog">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</article>
					<?php endwhile; ?>
				<?php endif;
				wp_reset_query(); ?>
			</div>
		</div>

		<footer>
			<p>If you have any questions, or you just want to email us, drop us a line at <a href="mailto:neilandnyssa@gmail.com">neilandnyssa@gmail.com</a></p>
		</footer>

		<div class="overlay"> </div>
		
		<i id="close" class="fa fa-times"></i>

		<div class="modal">
			<section id="rsvp-form">
				<?php require_once('rsvp.php'); ?>
			</section>
		</div>

<?php get_footer(); ?>