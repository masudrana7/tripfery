<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if( is_active_sidebar( 'shop-sidebar' )) {
	$fixedbar = 'fixed-bar-coloum';
}else {
	$fixedbar = '';
}
?>
</main>
			</div>
			<?php if ( TripferyTheme::$layout == 'right-sidebar' ) { ?>			
				<div class="col-xl-3 <?php echo esc_attr( $fixedbar ); ?>">				
					<aside class="sidebar-widget-area">
						<?php if ( is_active_sidebar( 'shop-sidebar' ) ) dynamic_sidebar( 'shop-sidebar' ); ?>
					</aside>
				</div>

			<?php } ?>
		</div>
	</div>
</div>