<?php
/*
	Plugin Name: WPJobster Colors
	Plugin URL: http://wpjobster.com/
	Description: WPJobster Colors System.
	Version: 1.0.2
	Author: WPJobster
	Author URI: http://wpjobster.com/
*/

add_action('custom_colors_panel', 'wpjobster_custom_color');
function wpjobster_custom_color(){
	$protocol = is_ssl() ? 'https://' : 'http://';
	$url = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$color_margin = '0px';

	if ( WPJ_Form::get( 'color1', '' ) && WPJ_Form::get( 'color2', '' ) ) {
		$_SESSION['color1'] = WPJ_Form::get( 'color1', '' );
		$_SESSION['color2'] = WPJ_Form::get( 'color2', '' );
	}

	if ( isset( $_SESSION['color1'] ) && isset( $_SESSION['color2'] ) ) {
		add_filter( 'primary_color', 'primary_color', 10);
		function primary_color($primary_color){
			return '#' . $_SESSION['color1'];
		}
		add_filter( 'secondary_color', 'secondary_color', 10);
		function secondary_color($secondary_color){
			return '#' . $_SESSION['color2'];
		}
		$color_margin = '-72px';
	}
	?>

	<div id="cnt-color" class="white-cnt" style="position: fixed; right: 0; top: 140px; padding: 0px; z-index: 1000; margin-right: <?php echo $color_margin; ?>;">

		<div id="close-color" class="white-cnt" style="cursor: pointer; width: 40px; height: 40px; padding: 9px; position: absolute; left: -40px; top: -1px; border-right: 1px solid #fff;">
			<img src="<?php echo get_template_directory_uri() . '/images/settings39.png'; ?>" />
		</div>

		<?php
		$color_array = array(
			array( '83C124', '2d5767' ),
			array( 'fbbc05', 'd29c01' ),
			array( 'EA6A51', 'af4530' ),
			array( 'dd3333', '911414' ),
			array( 'DB5461', '9c3d46' ),
			array( '4076bc', '03274b' ),
			array( '698C9D', '486471' ),
			array( '4a4d52', '23282d' ),
		);

		foreach ( $color_array as $color ) {
		?>
			<a href="<?php echo add_query_arg( array( 'color1' => $color[0], 'color2' => $color[1] ), $url ); ?>">
				<div style="width: 10px; height: 20px; margin: 10px; background: #fff; border-left: 20px solid #<?php echo $color[0]; ?>; border-right: 20px solid #<?php echo $color[1]; ?>;"></div>
			</a>
		<?php
		}
		?>
	</div>

	<script>
	jQuery( document ).ready(function($){
		$( '#close-color' ).click(function(){
			if ( $( '#cnt-color' ).css( "margin-right" ) == "0px" ) {
				$( '#cnt-color' ).css( "margin-right", "-72px" );
			} else {
				$( '#cnt-color' ).css( "margin-right", "0px" );
			}
		});
	});
	</script>
<?php }
