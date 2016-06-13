<?php 

/* Template Name: Chesterfield */

?>

<?php get_header(); ?>

		<?php switch_or_logout($current_user->ID); ?>

		<header>
			<img src="<?php echo get_template_directory_uri(); ?>/images/chf_header.png" alt="A Wedding Party!" />
		</header>

		<section id="details-wrapper">
			<div id="details">
				<div id="us">
					<div id="names">
						<p>Neil Mark McGwyre</p>
						<p>and</p>
						<p>Nyssa Jayne Tyers</p>
					</div>

					<div id="date">
						<p>September</p>
						<p><strong>26th</strong></p>
						<p>2015</p>
					</div>
				</div>

				<div id="place">
					<p class="stadium">The Proact Stadium, Chesterfield</p>
					<p class="address">1866 Sheffield Road, Chesterfield, S41&nbsp;8NZ</p>
				</div>
			</div>
		</section>

		<section class="invited">
			<h2>You're Invited
				<span class="username"><?php echo $current_user->display_name; ?></span>
			</h2>

			<button id="rsvp" class="rsvp-here">Click to RSVP</button>
		</section>

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
						'cat'	=> 3,
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