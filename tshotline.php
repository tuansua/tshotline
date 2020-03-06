<?php
/**
 * Plugin Name: Tshotline
 * Plugin URI: 24hdev.com
 * Description: Đây là plugin để thêm hotline nhấp nháy
 * Version: 1.0
 * Author: Tuấn Sữa
 * Author URI: 24hdev.com
 * License:
 */
function register_mysettings() {
        register_setting( 'ts-settings-group', 'ts_hotline' );
}
function ts_create_menu() {
        add_menu_page('Hotline Plugin Settings', 'Hotline Settings', 'administrator', __FILE__, 'ts_settings_page',plugins_url('/images/hotline-icon.png', __FILE__), 1);
        add_action( 'admin_init', 'register_mysettings' );
}
add_action('admin_menu', 'ts_create_menu'); 
 
function ts_settings_page() {
?>
<div class="wrap">
<h2>Nhập số hotline</h2>
<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
<?php } ?>
<form method="post" action="options.php">
    <?php settings_fields( 'ts-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Hotline</th>
        <td><input type="text" name="ts_hotline" value="<?php echo get_option('ts_hotline'); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php }

function enqueue_scripts_and_styles()
{
        wp_register_style( 'ts-hotline-css', plugins_url( '/css/tscss.css', __FILE__ ));
        wp_enqueue_style( 'ts-hotline-css' );
 
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );

function ts_hotline_template() {
    $string = '<!--PHONE-->
	<div class="textwidget">
		<div id="coccoc-alo-phoneIcon" class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show hidden-xs visible-sm visible-md visible-lg am-call" style="display: block;">
			<div class="coccoc-alo-ph-circle"></div>
			<div class="coccoc-alo-ph-circle-fill"></div>
			<div class="coccoc-alo-ph-img-circle">
				<a class="pps-btn-img call-des " title="Liên hệ" href="tel:'.get_option('ts_hotline').'">
				<img src="'.plugins_url('/images/hinhtron.png', __FILE__).'" alt="Liên hệ" width="50" />
				</a>
				<a class="pps-btn-img call-mb " title="Liên hệ" href="tel:'.get_option('ts_hotline').'">
				<img src="'.plugins_url('/images/hinhtron.png', __FILE__).'" alt="Liên hệ" width="50" />
				</a>
			</div>
		</div>
		<div id="coccoc-alo-phoneIcon" class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show visible-xs hidden-sm hidden-md hidden-lg am-call" style="display: block;">
			<div class="coccoc-alo-ph-circle"></div>
			<div class="coccoc-alo-ph-circle-fill"></div>
			<div class="coccoc-alo-ph-img-circle">
				<a class="pps-btn-img call-des" title="Liên hệ" href="tel:'.get_option('ts_hotline').'">
					<img src="'.plugins_url('/images/hinhtron.png', __FILE__).'" alt="Liên hệ" width="50" />
				</a>
				<a class="pps-btn-img call-mb " title="Liên hệ" href="tel:'.get_option('ts_hotline').'">
					<img src="'.plugins_url('/images/hinhtron.png', __FILE__).'" alt="Liên hệ" width="50" />
				</a>
			</div>
		</div>
	</div>
	<!--END PHONE-->';
    echo $string;
}
add_action( 'wp_footer', 'ts_hotline_template' );

?>