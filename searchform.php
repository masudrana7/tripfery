<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="custom-search-input">
		<div class="input-group">
		<input type="text" class="search-query form-control" placeholder="<?php esc_attr_e( 'Search here ...', 'tripfery' ) ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<span class="input-group-btn">
				<button class="btn" aria-label="Search button" type="submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</span>
		</div>
	</div>
</form>