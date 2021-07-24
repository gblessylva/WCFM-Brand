<?php
global $WCFM, $wp_query;

?>

<div class="collapse wcfm-collapse" id="wcfm_service_listing">
	
	<div class="wcfm-page-headig">
		<span class="fa fa-cubes"></span>
		<span class="wcfm-page-heading-text"><?php _e( 'Service', 'wcfm-custom-menus' ); ?></span>
		<?php do_action( 'wcfm_page_heading' ); ?>
	</div>
	<div class="wcfm-collapse-content">
		<div id="wcfm_page_load"></div>
		<?php do_action( 'before_wcfm_service' ); ?>
		
		<div class="wcfm-container wcfm-top-element-container">
			<h2><?php _e('Service', 'wcfm-custom-menus' ); ?></h2>
			<div class="wcfm-clearfix"></div>
	  </div>
	  <div class="wcfm-clearfix"></div><br />
		<div class="wcfm-container">
			<div id="wcfm_service_listing_expander" class="wcfm-content">
				<?php
					$url = parse_url($_SERVER['REQUEST_URI']);
					$siteURL = get_site_url();
					$brand_id = $_GET['id'];
					$term = get_term($brand_id, 'store') ;
					$brand_image = get_term_meta($brand_id, 'brandimage', true);
					$term_meta = get_term_meta($brand_id);
					$keyword = get_term_meta($brand_id, 'rank_math_focus_keyword', true);
					
					?>
					
					<form id="customBrand" name="customBrand" method="post" >
						<?php
							$rich_editor = apply_filters( 'wcfm_is_allow_rich_editor', 'rich_editor' );
							$wpeditor = apply_filters( 'wcfm_is_allow_product_wpeditor', 'wpeditor' );
							if( $wpeditor && $rich_editor ) {
								$rich_editor = 'wcfm_wpeditor';
							} else {
								$wpeditor = 'textarea';
							}
							$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'wcfm_product_manage_fields_content', array(
																																																		"brand_name" => array('label' => __('Brand Name', 'wc-frontend-manager') , 'type' => 'text', 'class' => 'wcfm-textarea wcfm_ele wcfm_full_ele simple variable external grouped booking ' . $rich_editor , 'label_class' => 'wcfm_title wcfm_full_ele', 'rows' => 5, 'value' => $term->name, 'teeny' => true),
																																																		"description" => array('label' => __('Brand Description', 'wc-frontend-manager') , 'type' => $wpeditor, 'class' => 'wcfm-textarea wcfm_ele wcfm_full_ele simple variable external grouped booking ' . $rich_editor, 'label_class' => 'wcfm_title wcfm_full_ele', 'rows' => 10, 'value' => $term->description ),
																																																		"keyword" => array('label' => __('SEO Keyword', 'wc-frontend-manager') , 'type' => 'text', 'class' => 'wcfm-textarea wcfm_ele wcfm_full_ele simple variable external grouped booking ' . $rich_editor , 'label_class' => 'wcfm_title wcfm_full_ele', 'rows' => 5, 'value' => $keyword, 'teeny' => true),
																																																		"pro_id" => array('type' => 'hidden', 'value' => $term->term_id),
																																																		"brand_image"=>array('type'=>'hidden', 'value'=>$brand_image),
																																																		'upload-button'=> array('type'=> 'button', 'value'=>'Upload Logo', 'class'=>'wcfm_submit_button')
							
																																										), $term->term_id ) );

							?>

						<img src="<?php echo $brand_image; ?>" alt="" srcset="" id="preview" width='150px' style="margin-top:50px;"/>
																																										
						<input type="submit" name="update_brand" value="Update Brand" class="wcfm_submit_button">

						</form> 
						

				<?php				

				if(isset($_POST['update_brand'])) {
					if(trim($_POST['brand_name']) === '') {
						$nameError = 'Please enter Brand name.';
						$hasError = true;
						echo $nameError;
					} elseif(trim($_POST['description']) === '') {
						$nameError = 'Please enter Brand Description.';
						$hasError = true;
						echo $nameError;
					}elseif(trim($_POST['keyword']) === '') {
						$nameError = 'Please enter Focus Keyword.';
						$hasError = true;
						echo $nameError;
					}
					else {
						$name = trim($_POST['brand_name']);
						$new_keyword = trim($_POST['keyword']);
						$description = trim($_POST['description']);	
						$new_brand_image = trim($_POST['brand_image']);		
						$term = get_term_by('name', $name, 'store');
						$slug= $term->slug;
					
						
						wp_update_term($brand_id, 'store', array(
							'name' => $name,
							'description' => $description
						));
						
						update_term_meta($brand_id, 'rank_math_focus_keyword', $new_keyword, $keyword);
						update_term_meta($brand_id, 'brandimage', $new_brand_image, $brand_image);	
						
						$message = "<div class='flash_message'><p>$name has been added succesfully. <a href='$siteURL/brand/$slug/'>Click here to view</a></p></div>";
							// setcookie("brand_id", $brand_id, time() + 3600)
							echo $message;

					}
				

				}		
								?>
								
			
				<div class="wcfm-clearfix"></div>
			</div>
			<div class="wcfm-clearfix"></div>
		</div>
	
		<div class="wcfm-clearfix"></div>
		<?php
		do_action( 'after_wcfm_service' );
		?>
	</div>
	<script>
		jQuery(document).ready(function($){

var mediaUploader;

$('#upload-button').click(function(e) {
  e.preventDefault();
  // If the uploader object has already been created, reopen the dialog
	if (mediaUploader) {
	mediaUploader.open();
	return;
  }
  // Extend the wp.media object
  mediaUploader = wp.media.frames.file_frame = wp.media({
	title: 'Choose Image',
	button: {
	text: 'Choose Image'
  }, multiple: false });

  // When a file is selected, grab the URL and set it as the text field's value
  mediaUploader.on('select', function() {
	attachment = mediaUploader.state().get('selection').first().toJSON();
	$('#brand_image').val(attachment.url);
	var image_url = $('#brand_image').val();
	$('#preview').attr("src", image_url);
  });
  // Open the uploader dialog
  mediaUploader.open();
});

});
		console.log("working")
	</script>
</div>