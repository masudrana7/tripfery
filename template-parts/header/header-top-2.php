<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$tripfery_socials = TripferyTheme_Helper::socials();
$container = ( TripferyTheme::$header_style == 6 ) ? 'container-custom' : 'container';
?>
<div id="tophead" class="header-top-bar">
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="top-bar-wrap">
			<div class="topbar-left">
				<ul class="top-address">
					<li><i class="icon-tripfery-location"></i><?php echo wp_kses( TripferyTheme::$options['address'] , 'alltext_allow' );?></li>
				</ul>
			</div>
			<div class="tophead-right">							
				<?php if ( $tripfery_socials ) { ?>					
					<ul class="tophead-social">
						<?php foreach ( $tripfery_socials as $tripfery_social ): ?>
							<li><a target="_blank" aria-label="Social Link" href="<?php echo esc_url( $tripfery_social['url'] );?>"><i class="fab <?php echo esc_attr( $tripfery_social['icon'] );?>"></i></a></li>
						<?php endforeach; ?>
					</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</div>