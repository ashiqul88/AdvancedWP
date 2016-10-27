<?php 

function ash_meta_box(){
	add_meta_box(
		'ash_meta',
		'Post details',
		'post_details',
		'post'
	);
}
add_action('add_meta_boxes', 'ash_meta_box');


function post_details($post){ ?>
 <?php wp_nonce_field(basename(__FILE__), "meta-box-nonce"); ?>
	<input type="hidden" name="<?php wp_create_nonce('meta_nonce'); ?>" />
	<input type="text" name="name" value="<?php echo get_post_meta($post->ID, 'name', true); ?>" />
		<div>
	<label for="color">Font color:</label>
	<input type="text" name="color" id="color_picker" value="<?php echo get_post_meta($post->ID, 'color', true); ?>" />
		</div>
	<div>
	<label for="color">Font date:</label>
	<input type="text" name="date" id="date_picker" value="<?php echo get_post_meta($post->ID, 'date', true); ?>" />
	</div>
		<?php 
			$content = get_post_meta(get_the_ID(),'content_area', true);
		
		
		wp_editor($content, 'content_area', array(
		'media_buttons' => false,
		'textarea_rows' => 5
		) ); ?>
<?php }

function post_details_save(){
	
	$autosave = wp_is_post_autosave(get_the_ID());
	$revision = wp_is_post_autorevision(get_the_ID());
	if($autosave || $revision){
		return;
	}
	if(! wp_verify_nonce('meta-box-nonce', basename(__FILE__))){
		return;
	}
	
	// Sanitize user input.
	$name = isset( $_POST[ 'car_year' ] ) ? sanitize_text_field( $_POST[ 'name' ] ) : '';
	$color = isset( $_POST[ 'car_mileage' ] ) ? sanitize_text_field( $_POST[ 'color' ] ) : '';
	$date = isset( $_POST[ 'date' ] ) ? 'checked' : '';
	update_post_meta(get_the_ID(), 'name', $name);
	update_post_meta(get_the_ID(), 'color',$color);
	update_post_meta(get_the_ID(), 'date', $date);
}
add_action('save_post', 'post_details_save');





/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function demo_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function demo_add_meta_box() {
	add_meta_box(
		'demo-demo',
		__( 'Demo', 'demo' ),
		'demo_html',
		'post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'demo_add_meta_box' );

function demo_html( $post) {
	wp_nonce_field( '_demo_nonce', 'demo_nonce' ); ?>

	<p>Demo metabox</p>

	<p>
		<label for="demo_name"><?php _e( 'name', 'demo' ); ?></label><br>
		<input type="text" name="demo_name" id="demo_name" value="<?php echo demo_get_meta( 'demo_name' ); ?>">
	</p>	<p>
		<label for="demo_gender"><?php _e( 'gender', 'demo' ); ?></label><br>
		<select name="demo_gender" id="demo_gender">
			<option <?php echo (demo_get_meta( 'demo_gender' ) === 'Male' ) ? 'selected' : '' ?>>Male</option>
			<option <?php echo (demo_get_meta( 'demo_gender' ) === 'Female' ) ? 'selected' : '' ?>>Female</option>
		</select>
	</p>	<p>

		<input type="checkbox" name="demo_wirdoress_joomla" id="demo_wirdoress_joomla" value="wirdoress-joomla" <?php echo ( demo_get_meta( 'demo_wirdoress_joomla' ) === 'wirdoress-joomla' ) ? 'checked' : ''; ?>>
		<label for="demo_wirdoress_joomla"><?php _e( 'Wirdoress Joomla', 'demo' ); ?></label>	</p>	<p>

		<input type="radio" name="demo_favourity_programe" id="demo_favourity_programe_0" value="PHP" <?php echo ( demo_get_meta( 'demo_favourity_programe' ) === 'PHP' ) ? 'checked' : ''; ?>>
<label for="demo_favourity_programe_0">PHP</label><br>

		<input type="radio" name="demo_favourity_programe" id="demo_favourity_programe_1" value="Java" <?php echo ( demo_get_meta( 'demo_favourity_programe' ) === 'Java' ) ? 'checked' : ''; ?>>
<label for="demo_favourity_programe_1">Java</label><br>

		<input type="radio" name="demo_favourity_programe" id="demo_favourity_programe_2" value="C++" <?php echo ( demo_get_meta( 'demo_favourity_programe' ) === 'C++' ) ? 'checked' : ''; ?>>
<label for="demo_favourity_programe_2">C++</label><br>
	</p><?php
}

function demo_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['demo_nonce'] ) || ! wp_verify_nonce( $_POST['demo_nonce'], '_demo_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['demo_name'] ) )
		update_post_meta( $post_id, 'demo_name', esc_attr( $_POST['demo_name'] ) );
	if ( isset( $_POST['demo_gender'] ) )
		update_post_meta( $post_id, 'demo_gender', esc_attr( $_POST['demo_gender'] ) );
	if ( isset( $_POST['demo_wirdoress_joomla'] ) )
		update_post_meta( $post_id, 'demo_wirdoress_joomla', esc_attr( $_POST['demo_wirdoress_joomla'] ) );
	else
		update_post_meta( $post_id, 'demo_wirdoress_joomla', null );
	if ( isset( $_POST['demo_favourity_programe'] ) )
		// sanitize_text_field($_POST['demo_favourity_programe'])
		update_post_meta( $post_id, 'demo_favourity_programe', esc_attr( $_POST['demo_favourity_programe'] ) );
}
add_action( 'save_post', 'demo_save' );

/*
	Usage: demo_get_meta( 'demo_name' )
	Usage: demo_get_meta( 'demo_gender' )
	Usage: demo_get_meta( 'demo_wirdoress_joomla' )
	Usage: demo_get_meta( 'demo_favourity_programe' )
*/

?>
<script type="text/javascript"> 
jQuery(document).ready(function(){
	jQuery('#color_picker').wpColorPicker();
	jQuery('#date_picker').datepicker();
});
</script>
