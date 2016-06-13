<h2>RSVP</h2>

<form action="<?php echo get_stylesheet_directory_uri(); ?>/rsvp_form.php" method="POST" id="guest">

<?php 
	$locations = fetch_location($current_user->ID);
	$city;

	foreach($locations as $location) {
		//1: New York, 2: Chesterfield, 3: Melbourne

		switch ($post->ID) {
			case 12:
				$city = 1;
				break;
			case 22:
				$city = 2;
				break;
			case 24:
				$city = 3;
				break;
		}
	}

	$guests = fetch_guests($current_user->ID, $city); 

	foreach($guests as $guest) : ?>
	<p><span class="guest-name">Is <?php echo $guest->name; ?> attending?</span>
		<input id="yes-<?php echo $guest->id; ?>" name="rsvp[<?php echo $guest->id; ?>][attending]" value="1" type="radio" <?php if((isset($guest->attending)) && ($guest->attending)){ echo "checked"; } ?> data-guest-id="<?php echo $guest->id; ?>" data-answer="yes" class="yes">
		<label for="yes-<?php echo $guest->id; ?>" class="yes">Yes</label>
		<input id="no-<?php echo $guest->id; ?>" name="rsvp[<?php echo $guest->id; ?>][attending]" value="0" type="radio" <?php if((isset($guest->attending)) && (!$guest->attending)){ echo "checked"; } ?> data-guest-id="<?php echo $guest->id; ?>" data-answer="no" class="no">
		<label for="no-<?php echo $guest->id; ?>" class="no">No</label>

		<div class="diet" data-guest-id="<?php echo $guest->id; ?>" style="display:none">
		<label for="diet">Dietary Requirements:</label>
			<input id="diet" name="rsvp[<?php echo $guest->id; ?>][requirements]" type="text" value="<?php if(isset($guest->requirements)){ echo $guest->requirements; }?>">
		</div>
<?php endforeach; ?>
	
	<p><input id="guest_submit" type="submit"></p>

	<script>
	
	</script>

</form>