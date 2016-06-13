<?php 

/* Template Name: Landing Page */

?>

<?php get_header(); ?>

	<?php $locations = fetch_location($current_user->ID); 
		$no_of_locations = 100/count($locations); ?>

		<div id="wrapper">

			<?php
				foreach($locations as $location):
					$city_class;
					$city_code;

					switch ($location->location_id) {
						case 1:
							$city_class = "nyc";
							$city_code = "<a href=\"" . home_url() . "/new-york\"><p><span class=\"one\">N</span><span class=\"two\">Y</span><span class=\"three\">C</span></p></a>";
							break;
						case 2:
							$city_class = "chf";
							$city_code = "<a href=\"" . home_url() . "/chesterfield\"><p><span class=\"one\">C</span><span class=\"two\">H</span><span class=\"three\">F</span></p></a>";
							break;
						case 3:
							$city_class = "mel";
							$city_code = "<a href=\"" . home_url() . "/melbourne\"><p><span class=\"one\">M</span><span class=\"two\">E</span><span class=\"three\">L</span></p></a>";
							break;
					} ?>

					<div id="<?php echo $city_class; ?>" class="city" style="width: <?php echo $no_of_locations; ?>%; <?php if(count($locations) == 1){ echo "height:100% !important"; } ?>">
						<div class="place">
							<?php echo $city_code; ?>
						</div>
					</div>
				<?php endforeach;
			?>
		</div>

<?php get_footer(); ?>