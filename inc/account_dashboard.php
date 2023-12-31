<?php
class Tripfery_BA_DashBoard
{
    public function __construct()
    {
        add_filter('babe_myaccount_manager_all_posts', array($this, 'rt_get_user_allposts'), 1, 3);
        add_action('tripfery_get_all_posts_wishlist', array($this, 'rt_get_user_allwishlist'));
    }
    public static function rt_get_user_allposts($output, $post_type, $user_info)
    {
        $output = '';
        $post_type_obj = get_post_type_object($post_type);
        $args = array(
            'post_type'           => $post_type,
            'posts_per_page'     => 10,
            'paged'                 => get_query_var('paged'),
            'post_status'         => 'any',
            'orderby'             => 'post_date',
            'order'                 => 'DESC'
        );
        if (!(in_array('manager', $user_info->roles) || in_array('administrator', $user_info->roles))) {
            $args['author__in'] = [$user_info->ID];
        }
        $args = apply_filters('babe_myaccount_all_posts_get_post_args', $args, $post_type, $user_info);
        $the_query = new WP_Query($args);
        $max_num_pages = $the_query->max_num_pages;
        $found_posts = $the_query->found_posts;
        while ($the_query->have_posts()) : $the_query->the_post();
            $post_id = get_the_ID();
            $edit_url = BABE_Settings::get_my_account_page_url(array('inner_page' => 'edit-post', 'edit_post_id' => $post_id));
            $thumbnail = '';
            if (has_post_thumbnail($post_id)) {
                $thumbnail .= '<div class="image">';
                $thumbnail .= '<a href="' . get_the_permalink($post_id) . '">';
                $thumbnail .= get_the_post_thumbnail($post_id, 'post-thumbnail');
                $thumbnail .= '</a>';
                $thumbnail .= '</div>';
            }
            $output .= '
		 		<tr>
			 		<td class="tripfery_account_posts_td tripfery_account_posts_td_title">
			 			<div class="title-image">
			 				' . $thumbnail . '
			 				<div class="title"><a href="' . get_the_permalink($post_id) . '">' . get_the_title($post_id) . '</a></div>
			 			</div>	
			 		</td>
			 		<td class="tripfery_account_posts_td tripfery_account_posts_td_date">' . get_the_date('', $post_id) . '</td>
			 		<td class="tripfery_account_posts_td tripfery_account_posts_td_action">
			 			<a href="' . esc_url($edit_url) . '"><i class="fa-regular fa-pen-to-square"></i></a>
			 		</td>
		 		</tr>';
        endwhile;
        wp_reset_postdata();
        if ($output) {
            $output = '
		 		<div class="tripfery_account_posts_total">' . esc_html__('Total: ', 'tripfery') . $found_posts . '</div>    
		 		<table class="tripfery_account_posts_table">
				 	<thead>
				 		<tr>
				 			<td> ' . esc_html__('Title & Image', 'tripfery') . ' </td>
				 			<td> ' . esc_html__('Published Date', 'tripfery') . ' </td>
				 			<td> ' . esc_html__('Action', 'tripfery') . ' </td>
				 		</tr>
				 	</thead>			
			  		<tbody>
			 			' . $output . '
			  		</tbody>
		 		</table> 
		 	';
        }
        $output = '
			<div class="my_account_inner_page_block tripfery_account_posts">
			  	<h2>' . $post_type_obj->labels->all_items . '</h2>
			  	<div class="tripfery_account_posts_inner">
					' . $output . '
					' . BABE_Functions::pager($max_num_pages) . '
			 	</div>
			</div>
		';
        return $output;
    }
    public function rt_get_user_allwishlist()
    {
        $output = '';
        $post_type = 'to_book';
        $user = wp_get_current_user();
        $userid = $user->ID;
        $post_ids = get_user_meta($userid, 'rt_wishlist', true);
        $post_type_obj = get_post_type_object($post_type);
        $args = array(
            'post_type'           => $post_type,
            'posts_per_page'     => 8,
            'paged'                 => get_query_var('paged'),
            'post_status'         => 'any',
            'orderby'             => 'post_date',
            'order'                 => 'DESC',
            'post__in'            => $post_ids
        );

        $the_query = new WP_Query($args);
        $max_num_pages = $the_query->max_num_pages;
        $found_posts = $the_query->found_posts;
        while ($the_query->have_posts()) : $the_query->the_post();
            $post_id = get_the_ID();
            $thumbnail = '';
            if (has_post_thumbnail($post_id)) {
                $thumbnail .= '<div class="image">';
                $thumbnail .= '<a href="' . get_the_permalink($post_id) . '">';
                $thumbnail .= get_the_post_thumbnail($post_id, 'post-thumbnail');
                $thumbnail .= '</a>';
                $thumbnail .= '</div>';
            }
            $output .= '
		 		<tr>
			 		<td class="tripfery_account_posts_td tripfery_account_posts_td_title">
			 			<div class="title-image">
			 				' . $thumbnail . '
			 				<div class="title"><a href="' . get_the_permalink($post_id) . '">' . get_the_title($post_id) . '</a></div>
			 			</div>	
			 		</td>
			 		<td class="tripfery_account_posts_td tripfery_account_posts_td_date">' . get_the_date('', $post_id) . '</td>
                    <td class="tripfery_account_posts_td tripfery_account_posts_td_action">' . RTWishlist::wishlist_html($post_id) . '</td>
		 		</tr>';
        endwhile;
        wp_reset_postdata();
        if ($output) {
            $output = '
		 		<div class="tripfery_account_posts_total">' . __('Total: ', 'tripfery') . $found_posts . '</div>    
		 		<table class="tripfery_account_posts_table">
				 	<thead>
				 		<tr>
				 			<td> ' . esc_html__('Title & Image', 'tripfery') . ' </td>
				 			<td> ' . esc_html__('Published Date', 'tripfery') . ' </td>
				 			<td> ' . esc_html__('Action', 'tripfery') . ' </td>
				 		</tr>
				 	</thead>			
			  		<tbody>
			 			' . $output . '
			  		</tbody>
		 		</table> 
	 		';
            
        }
        $output = '
			<div class="my_account_inner_page_block tripfery_account_posts">
			  	<h2>' . esc_html__('Wishlist', 'tripfery') . '</h2>
			  	<div class="tripfery_account_posts_inner">
					' . $output . '
					' . BABE_Functions::pager($max_num_pages) . '
			 	</div>
			</div>
		';
        echo wp_kses_stripslashes($output);
    }
}
new Tripfery_BA_DashBoard();
