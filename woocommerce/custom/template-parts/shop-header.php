<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( TripferyTheme::$layout == 'full-width' ) {
	$tripfery_layout_class = 'col-sm-12 col-12';
}  else {
	$tripfery_layout_class = TripferyTheme_Helper::has_active_widget();	
}
if( is_active_sidebar( 'shop-sidebar' )) {
	$fixedbar = 'fixed-bar-coloum';
}else {
	$fixedbar = '';
}
?>
<div id="primary" class="section content-area customize-content-selector">
	<div class="container">
		<div class="row">		
			<?php if ( TripferyTheme::$layout == 'left-sidebar' ) { ?>
				<div class="col-xl-3 <?php echo esc_attr( $fixedbar ); ?>">
					<aside class="sidebar-widget-area">
						<?php if ( is_active_sidebar( 'shop-sidebar' ) ) dynamic_sidebar( 'shop-sidebar' ); ?>
					</aside>
				</div>
			<?php } ?>
			
			<div class="<?php echo esc_attr( $tripfery_layout_class );?>">		
				<main id="main" class="site-main page-content-main">