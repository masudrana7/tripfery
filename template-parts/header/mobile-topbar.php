<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$tripfery_socials = TripferyTheme_Helper::socials();

$tripfery_mobile_meta  = ( TripferyTheme::$options['mobile_date'] || TripferyTheme::$options['mobile_address'] || TripferyTheme::$options['mobile_opening'] || TripferyTheme::$options['mobile_phone'] || TripferyTheme::$options['mobile_email'] || TripferyTheme::$options['mobile_button'] || TripferyTheme::$options['mobile_social'] && $tripfery_socials ) ? true : false;

?>
<?php if ( $tripfery_mobile_meta ) { ?>
<div class="mobile-top-bar" id="mobile-top-fix">
	<div class="mobile-top">
		<ul class="mobile-address">
			<?php if ( TripferyTheme::$options['mobile_date'] ) { ?>
			<li><i class="icon-tripfery-calendar"></i><?php echo date_i18n( get_option('date_format') ); ?></li>
			<?php } if ( TripferyTheme::$options['mobile_address'] ) { ?>
			<li><i class="icon-tripfery-location"></i><?php echo wp_kses( TripferyTheme::$options['address'] , 'alltext_allow' );?></li>
			<?php } if ( TripferyTheme::$options['mobile_opening'] ) { ?>
			<li><i class="icon-tripfery-time"></i><span class="opening-label"><?php echo wp_kses( TripferyTheme::$options['opening_label'] , 'alltext_allow' );?></span> <?php echo wp_kses( TripferyTheme::$options['opening'] , 'alltext_allow' );?></li>
			<?php } if ( TripferyTheme::$options['mobile_phone'] ) { ?>
			<li><i class="icon-tripfery-phone"></i><a href="tel:<?php echo esc_attr( TripferyTheme::$options['phone'] );?>"><?php echo wp_kses( TripferyTheme::$options['phone'] , 'alltext_allow' );?></a></li>
			<?php } if ( TripferyTheme::$options['mobile_email'] ) { ?>
			<li><i class="icon-tripfery-message"></i><a href="mailto:<?php echo esc_attr( TripferyTheme::$options['email'] );?>"><?php echo wp_kses( TripferyTheme::$options['email'] , 'alltext_allow' );?></a></li>
			<?php } ?>
		</ul>

		<?php if ( TripferyTheme::$options['mobile_social'] && $tripfery_socials ) { ?>
			<ul class="mobile-social">
				<?php foreach ( $tripfery_socials as $tripfery_social ): ?>
					<li><a target="_blank" href="<?php echo esc_url( $tripfery_social['url'] );?>"><i class="fab <?php echo esc_attr( $tripfery_social['icon'] );?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
		<?php } ?>

		<?php if ( TripferyTheme::$options['mobile_button'] ) { ?>
			<?php get_template_part( 'template-parts/header/icon', 'button' );?>
		<?php } ?>

	</div>
</div>
<?php } ?>