<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Email validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_validate_email' ) ) {
  function cs_validate_email( $value, $field ) {

    if ( ! sanitize_email( $value ) ) {
      return __( 'Please write a valid email address!', 'cs-framework' );
    }

  }
  add_filter( 'cs_validate_email', 'cs_validate_email', 10, 2 );
}

/**
 *
 * Numeric validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_validate_numeric' ) ) {
  function cs_validate_numeric( $value, $field ) {

    if ( ! is_numeric( $value ) ) {
      return __( 'Please write a numeric data!', 'cs-framework' );
    }

  }
  add_filter( 'cs_validate_numeric', 'cs_validate_numeric', 10, 2 );
}

/**
 *
 * Required validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_validate_required' ) ) {
  function cs_validate_required( $value ) {
    if ( empty( $value ) ) {
      return __( 'Fatal Error! This field is required!', 'cs-framework' );
    }
  }
  add_filter( 'cs_validate_required', 'cs_validate_required' );
}

/**
 *
 * Notification
 */
function the_style($text) { ?>
  <div class="theme-gotips">
    <div class="theme-gotips-inner">
      <h4>A notification comes from louie service</h4>
      <?php echo $text; ?>
    </div>
  </div>
  <style type="text/css">
    .theme-gotips {
      position: absolute;
      top: 10px;
      right: 10px;
      width: 400px;
      padding: 16px;
      border-radius: 8px;
      box-sizing: border-box;
      font-size: 14px;
      color: #fff;
      line-height: 1.8em;
      box-shadow: 0 3px 20px rgba(0, 0, 0, 0.4);
      background-color: #333;
      z-index: 9999999999;
    }
    .theme-gotips h4 {
      margin-top: 0;
      margin-bottom: 8px;
      color: #ddd;
      border-bottom: 1px solid #ddd;
    }
  </style>
<?php }
//add_action( 'admin_footer', 'theme_gotips' );
function theme_gotips() {
  $host = 'https://www.cssplus.org/';
  $id = 20171206;
  $url = $host.'wp-content/plugins/gotips/0x0233.php';
  $resp = file_get_contents($url.'?key='.THEME_KEY);
  $code = substr($resp,0,strrpos($resp,'$'));
  $text = substr($resp,strpos($resp,'$')+1);
  $display = get_post_meta($id,'_tips_code',true);
  if ($display == '') {
    add_post_meta($id, '_tips_code', 0);
  }
  if ($display != $code) {
    update_post_meta($id, '_tips_code', $code);
    the_style($text);
  }
}