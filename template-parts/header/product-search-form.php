<form class="form-inline woo-search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	
	<div class="form-group input-serach">
		<input type="hidden" name="post_type" value="product" />
		
		<input value="<?php echo esc_attr( get_search_query() );?>" type="text" name="s"  placeholder="<?php esc_attr_e( 'Keyword here...', 'tripfery' ); ?>" />
		<i class="hide close-form fa fa-times"></i>
	</div>
	<div class="form-group form-category">
		<select name="category" class="tripfery-select">
			<option value="0"><?php esc_html_e( 'All Categories' , 'tripfery' ); ?></option>
			<?php
			$terms = get_terms( array('taxonomy' => 'product_cat') );
			foreach ( $terms as $category ) { ?>			
			<option value="<?php echo esc_attr($category->slug); ?>"><?php echo esc_attr($category->name); ?></option>
			<?php }	?>
		</select>
	</div>
	<button type="submit" aria-label="submit button" class="btn-search"><i class="fa fa-search"></i></button>
</form>