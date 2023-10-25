<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="col-xl-4 fixed-bar-coloum">
	<aside class="sidebar-widget-area">
		<?php
			if ( is_active_sidebar( 'service-sidebar' ) ) dynamic_sidebar( 'service-sidebar' );
		?>
	</aside>
</div>