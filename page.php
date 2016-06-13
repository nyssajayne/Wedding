<?php 

get_header(); ?>

		<h2 class="invited small">You're Invited <span class="directional-arrow"> </span>
			<span class="username"><?php echo $current_user->display_name; ?></span>
		</h2>

		<div id="wrapper">
			<?php get_sidebar(); ?>

			<div id="main">

				<h2 class="invited large">You're Invited <span class="directional-arrow"> </span>
					<span class="username"><?php echo $current_user->display_name; ?></span>
				</h2>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>

<?php get_footer(); ?>