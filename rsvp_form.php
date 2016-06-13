<?php
	require_once('../../../wp-config.php');
	global $wpdb;

	/*$guest_child = 0;

	if(isset($_POST['guest_child'])){
		$guest_child = 1;
	}

	$rsvp_array = array(
		'household_id'	=> $_POST['household_id'],
		'location_id'	=> 1,
		'name' 			=> $_POST['guest_name'],
		'is_child'		=> $guest_child
	);

	$rsvp_format = array(
		"%s", "%d", "%s", "%d"
	);

	$rsvp_table = $wpdb->prefix."rsvp";

	$wpdb->insert($rsvp_table, $rsvp_array, $rsvp_format);*/

	$rsvp_table = $wpdb->prefix."rsvp";

	foreach($_POST['rsvp'] as $attendee=>$response) {
		$wpdb->update(
			$rsvp_table,
			array(
				'attending' 	=> $response['attending'],
				'requirements'	=> $response['requirements']
			),
			array(
				'id' => $attendee
			),
			array('%d', '%s'),
			array('%d')
		);
	}

	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;