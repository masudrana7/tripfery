<?php

// Location Latitude
function add_ba_locations_meta_field()
{ ?>
	<div class="form-field">
		<label for="ba_locations_meta">Location Latitude:</label>
		<input type="text" name="ba_locations_meta" id="ba_locations_meta" />
	</div>
<?php
}
add_action('ba_locations_add_form_fields', 'add_ba_locations_meta_field');

// Add custom field to edit term form
function edit_ba_locations_meta_field($term)
{
	$ba_locations_meta = get_term_meta($term->term_id, 'ba_locations_meta', true);
?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="ba_locations_meta">Location Latitude</label>
		</th>
		<td>
			<input type="text" name="ba_locations_meta" id="ba_locations_meta" value="<?php echo esc_attr($ba_locations_meta); ?>" />
		</td>
	</tr>
<?php
}
add_action('ba_locations_edit_form_fields', 'edit_ba_locations_meta_field');
// Save custom field data
function save_ba_locations_meta($term_id)
{
	if (isset($_POST['ba_locations_meta'])) {
		update_term_meta($term_id, 'ba_locations_meta', sanitize_text_field($_POST['ba_locations_meta']));
	}
}
add_action('edited_ba_locations', 'save_ba_locations_meta');
add_action('create_ba_locations', 'save_ba_locations_meta');



// Location Longitude
function add_ba_locations_longitude_meta_field()
{ ?>
	<div class="form-field">
		<label for="ba_locations_longitude_meta">Location Longitude:</label>
		<input type="text" name="ba_locations_longitude_meta" id="ba_locations_longitude_meta" />
	</div>
<?php
}
add_action('ba_locations_add_form_fields', 'add_ba_locations_longitude_meta_field');

// Add custom field to edit term form
function edit_ba_locations_longitude_meta_field($term)
{
	$ba_locations_longitude_meta = get_term_meta($term->term_id, 'ba_locations_longitude_meta', true);
?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="ba_locations_longitude_meta">Location Longitude</label>
		</th>
		<td>
			<input type="text" name="ba_locations_longitude_meta" id="ba_locations_longitude_meta" value="<?php echo esc_attr($ba_locations_longitude_meta); ?>" />
		</td>
	</tr>
<?php
}
add_action('ba_locations_edit_form_fields', 'edit_ba_locations_longitude_meta_field');
// Save custom field data
function save_ba_locations_longitude_meta($term_id)
{
	if (isset($_POST['ba_locations_longitude_meta'])) {
		update_term_meta($term_id, 'ba_locations_longitude_meta', sanitize_text_field($_POST['ba_locations_longitude_meta']));
	}
}
add_action('edited_ba_locations', 'save_ba_locations_longitude_meta');
add_action('create_ba_locations', 'save_ba_locations_longitude_meta');




