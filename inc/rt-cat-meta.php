<?php
/*------------------
		add tripfery  Booking Category color meta
	--------------------*/
function tripfery_colorpicker_field_add_new_category($taxonomy)
{ ?>
	<div class="form-field term-colorpicker-wrap">
		<label for="term-colorpicker"><?php esc_html_e('Category Color', 'tripfery'); ?></label>
		<input name="rt_category_color" value="#384bff" class="colorpicker" id="term-colorpicker" />
		<p><?php esc_html_e('This is category background color.', 'tripfery'); ?></p>
	</div>
<?php
}
add_action('categories_add_form_fields', 'tripfery_colorpicker_field_add_new_category');

function tripfery_colorpicker_field_edit_category($term)
{
	$color = get_term_meta($term->term_id, 'rt_category_color', true);
	$color = (!empty($color)) ? "#{$color}" : '#384bff';
	$image = get_term_meta($term->term_id, 'rt_term_image', true);
?>
	<tr class="form-field term-colorpicker-wrap">
		<th scope="row"><label for="term-colorpicker"><?php esc_html_e('Category Color', 'tripfery'); ?></label></th>
		<td>
			<input name="rt_category_color" value="<?php echo esc_attr($color); ?>" class="colorpicker" id="term-colorpicker" />
			<p class="description"><?php esc_html_e('This is category background color.', 'tripfery'); ?></p>
		</td>
	</tr>
<?php
}
add_action('categories_edit_form_fields', 'tripfery_colorpicker_field_edit_category');

function tripfery_save_termmeta($term_id)
{
	// Save term color 
	if (isset($_POST['rt_category_color']) && !empty($_POST['rt_category_color'])) {
		update_term_meta($term_id, 'rt_category_color', sanitize_hex_color_no_hash($_POST['rt_category_color']));
	} else {
		delete_term_meta($term_id, 'rt_category_color');
	}
}
add_action('created_categories', 'tripfery_save_termmeta');
add_action('edited_categories',  'tripfery_save_termmeta');

function tripfery_category_colorpicker_enqueue($taxonomy)
{
	if (null !== ($screen = get_current_screen()) && 'edit-categories' !== $screen->id) {
		return;
	}
	// Colorpicker Scripts
	wp_enqueue_script('wp-color-picker');
	// Colorpicker Styles
	wp_enqueue_style('wp-color-picker');
}
add_action('admin_enqueue_scripts', 'tripfery_category_colorpicker_enqueue');

//Category Color column
add_filter('manage_edit-categories_columns', 'tripfery_edit_term_columns', 10, 3);
function tripfery_edit_term_columns($columns)
{
	$columns['rt_category_color'] = esc_html__('Color', 'tripfery');
	return $columns;
}

// RENDER COLUMNS
add_filter('manage_categories_custom_column', 'tripfery_manage_term_custom_column', 10, 3);
function tripfery_manage_term_custom_column($out, $column, $term_id)
{
	if ('rt_category_color' === $column) {
		$value  = get_term_meta($term_id, 'rt_category_color', true);
		if (!$value)
			$value = '';
		$out = sprintf('<span class="term-meta-color-block" style="background:#%s" ></span>', esc_attr($value));
	}
	return $out;
}




	// Add custom field to add term form
	function add_tripfery_service_category_meta_field()
	{
	?>
		<div class="form-field">
			<label for="tripfery_service_category_meta">Custom Taxonomy Meta:</label>
			<input type="text" name="tripfery_service_category_meta" id="tripfery_service_category_meta" />
		</div>
	<?php
	}
	add_action('tripfery_service_category_add_form_fields', 'add_tripfery_service_category_meta_field');

	// Add custom field to edit term form
	function edit_tripfery_service_category_meta_field($term)
	{
		$tripfery_service_category_meta = get_term_meta($term->term_id, 'tripfery_service_category_meta', true);
	?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="tripfery_service_category_meta">Custom Taxonomy Meta:</label>
			</th>
			<td>
				<input type="text" name="tripfery_service_category_meta" id="tripfery_service_category_meta" value="<?php echo esc_attr($tripfery_service_category_meta); ?>" />
			</td>
		</tr>
	<?php
	}
	add_action('tripfery_service_category_edit_form_fields', 'edit_tripfery_service_category_meta_field');

	// Save custom field data
	function save_tripfery_service_category_meta($term_id)
	{
		if (isset($_POST['tripfery_service_category_meta'])) {
			update_term_meta($term_id, 'tripfery_service_category_meta', sanitize_text_field($_POST['tripfery_service_category_meta']));
		}
	}
	add_action('edited_tripfery_service_category', 'save_tripfery_service_category_meta');
	add_action('create_tripfery_service_category', 'save_tripfery_service_category_meta');
?>