<?php 

/* Template Name: New York, New York */

?>

<?php get_header(); ?>

		<?php switch_or_logout($current_user->ID); ?>

		<header>
			<h1>Neil & Nyssa</h1>
			<h2>Central Park NYC</h2>
			<div id="numbers">
				<span class="two">2</span>
				<span class="zero">0</span>
				<span class="one">1</span>
				<span class="five">5</span>
				<span class="flamingo"><img src="<?php echo get_template_directory_uri(); ?>/images/subway-flamingo.png" alt="Pink Flamingo!"></span>
			</div>
		</header>

		<div id="wrapper">

			<div id="main">

				<div class="invited">
					<h2>You're Invited <span class="directional-arrow"> </span>
						<span class="username"><?php echo $current_user->display_name; ?></span>
					</h2>

					<button id="rsvp" class="rsvp-here">RSVP</button>
				</div>

				<div class="clearfix">

				<article class="introduction">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile;
				endif; ?>
				</article>

				<?php 
					$args = array (
						'post_type'	=> 'post',
						'cat'	=> 2,
						'orderby' => 'date',
						'order' => 'asc'
					);

					$the_query = new WP_Query($args);
				?>

				<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<article class="blog">
						<h3><?php the_title(); ?></h3>
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