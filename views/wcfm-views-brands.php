<?php
global $WCFM, $wp_query;


?>

<div class="collapse wcfm-collapse" id="wcfm_brandsd_listing">
	
	<div class="wcfm-page-headig">
		<span class="fa fa-cubes"></span>
		<span class="wcfm-page-heading-text"><?php _e( 'Brands', 'wcfm-custom-menus' ); ?></span>
		<?php do_action( 'wcfm_page_heading' ); ?>
	</div>
	<div class="wcfm-collapse-content">
		<div id="wcfm_page_load"></div>
		<?php do_action( 'before_wcfm_brands' ); ?>
		
		<div class="wcfm-container wcfm-top-element-container">
			<h2><?php _e('Brands', 'wcfm-custom-menus' ); ?></h2>
			<div class="wcfm-clearfix"></div>

			<?php
			if( $allow_wp_admin_view = apply_filters( 'wcfm_allow_wp_admin_view', true ) ) {
				?>
				<a target="_blank" class="wcfm_wp_admin_view text_tip" href="<?php echo admin_url('edit.php?'); ?>" data-tip="<?php _e( 'WP Admin View', 'wcfm-custom-menus' ); ?>"><span class="fab fa-wordpress"></span></a>
				<?php
			}
			
			if( $has_new = apply_filters( 'wcfm_add_new_cpt1_sub_menu', true ) ) {
				echo '<a id="add_new_cpt1_dashboard" class="add_new_wcfm_ele_dashboard text_tip" href="'.get_site_url().'/store-manager/add-brand" data-tip="' . __('Add New ' , 'wcfm-custom-menus') . '"><span class="fa fa-cube"></span><span class="text">' . __( 'Add New', 'wcfm-custom-menus') . '</span></a>';
			}
			?>
			
			<?php	echo apply_filters( 'wcfm_cpt1_limit_label', '' ); ?>

	  </div>
	  <div class="wcfm-clearfix"></div><br />
		

		<div class="wcfm-container">
			<div id="wcfm_brandsd_listing_expander" class="wcfm-content">
			
				<!---- Add Content Here ----->
				<table id="wcfm-custom-menus1" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><span class="fa fa-image text_tip" data-tip="<?php _e( 'Logo', 'wcfm-custom-menus' ); ?>"></span></th>
							<th style="max-width: 250px;"><?php _e( 'Brand Name', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'Description', 'wcfm-custom-menus' ); ?></th>
							<!-- <th><span class="fa fa-eye text_tip" data-tip="
							<
								?php _e( 'Views', 'wcfm-custom-menus' ); ?>
							
							"></span></th> -->
							<th><?php _e( 'Products', 'wc-frontend-manager' ); ?></th>
							<th><?php _e( 'Slug', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'Keyword', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'SEO Score', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'Actions', 'wcfm-custom-menus' ); ?></th>
						</tr>
					</thead>
					<tbody>
					
					<?php 
					
					$terms = get_terms( array( 
						'taxonomy' => 'store',
						'hide_empty' => false,
						'orderby' => 'DATE',
            			'order' => 'ASC'
					) );
					
					// var_dump($terms);
					
					foreach($terms as $term){
						$termID = $term->term_id;
						$brand_image = get_term_meta($termID, 'brandimage', true);
						$term_meta = get_term_meta($termID);
						$keyword = get_term_meta($termID, 'rank_math_focus_keyword', true);
						$seo_score = get_term_meta($termID, 'rank_math_seo_score', true);
						$siteURL = get_site_url();

						$action = 
						'<ul>
							<li><a href="'.$siteURL.'/store-manager/manage-brand?id='.$termID.'">Edit</a></li>
							<li><a href="'.$siteURL.'/brand/'.$term->slug.'">View</a></li>						
						<ul>';
						// var_dump($term_meta);
	
						

						?>
						<tr class='odd' role='row' style="text-align:center;">
							<td ><?php echo "<IMG SRC='$brand_image' width='50px'>"?></td>
							<td ><?php _e($term->name, 'wcfm-custom-menus') ?></td>
							<td style="max-width:200px;"><?php _e($term->description, 'wcfm-custom-menus') ?></td>
							<td><?php _e($term->count, 'wcfm-custom-menus') ?></td>
							<td><?php _e($term->slug, 'wcfm-custom-menus') ?></td>
							<td><?php _e($keyword, 'wcfm-custom-menus') ?></td>
							<td><?php _e($seo_score, 'wcfm-custom-menus') ?></td>
							<td><?php _e($action, 'wcfm-custom-menus') ?></td>
						</tr>
						<?php
					}

					?>
					
					</tbody>
					<tfoot>
						<tr>
							<th><span class="fa fa-image text_tip" data-tip="<?php _e( 'Logo', 'wcfm-custom-menus' ); ?>"></span></th>
							<th style="max-width: 250px;"><?php _e( 'Brand Name', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'Description', 'wcfm-custom-menus' ); ?></th>
							
							<th><?php _e( 'Products', 'wc-frontend-manager' ); ?></th>
							<th><?php _e( 'Slug', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'Keyword', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'SEO Score', 'wcfm-custom-menus' ); ?></th>
							<th><?php _e( 'Actions', 'wcfm-custom-menus' ); ?></th>
						</tr>
					</tfoot>
				</table>

				<div class="wcfm-clearfix"></div>
			</div>
			<div class="wcfm-clearfix"></div>
		</div>
	
		<div class="wcfm-clearfix"></div>
		<?php
		do_action( 'after_wcfm_brands' );
		?>
	</div>
</div>