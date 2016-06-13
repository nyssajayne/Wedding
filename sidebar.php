<section>
	<?php
		$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

		if ( $login === "failed" ) {
			echo '<p class="login-msg">Invalid username and/or password.</p>';
		}
		elseif ( $login === "empty" ) {
			echo '<p class="login-msg">Username and/or Password is empty.</p>';
		}
		elseif ( $login === "false" ) {
			echo '<p class="login-msg">You are now logged out.</p>';
		}

		if (!is_user_logged_in()) {
			my_force_login();
		}
		else {
			global $current_user;
			get_currentuserinfo();

			echo "<h2>Hi ". $current_user->display_name ."!</h2>";

			$locations = fetch_location($current_user->ID);

			foreach($locations as $location) {
				$city;

				switch ($location->location_id) {
					case 1:
						$city = "<a href=\"" . home_url() . "/new-york\">RSVP to NYC</a>";
						break;
					case 2:
						$city = "<a href=\"" . home_url() . "/chesterfield\">RSVP to Chesterfield</a>";
						break;
					case 3:
						$city = "<a href=\"" . home_url() . "/melbourne\">RSVP to Melbourne</a>";
						break;
				}

				echo $city;
			}

			echo "<a href=\"". wp_logout_url( home_url() ) ."\">Logout &nbsp; &#xf072;</a>";
		}
	?>
</section>