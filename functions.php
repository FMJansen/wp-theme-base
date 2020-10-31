<?php

  /* Contents:
   * - Includes
   * - Add theme support for post thumbnails, search input, title tag
   * - Image url function
   * - Register menus
   * - Security edits
   * - Removing emoji
   * - Removing comments
   * - Removing jQuery */


  /* Includes */
  include( 'inc/CHANGE-post-type.php' );
  include( 'inc/CHANGE-custom-fields.php' );





  /* Add theme support for a few things */
  add_action( 'after_setup_theme', 'custom_theme_setup' );
  function custom_theme_setup() {
		add_theme_support( 'post-thumbnails' ); // Allow posts to have thumbnails
		add_theme_support( 'html5' ); // Make the search form input type="search"
		add_theme_support( 'title-tag' ); // Fix the document title tag
	}





  /* Get url for image based on filename */
  function image_url($filename) {
    return get_bloginfo('template_directory') . '/static/img/' . $filename;
  }



  /* Register menus */
  register_nav_menus( array(
      'primary' => 'Primary Menu',
      'sitemap' => 'Footer Sitemap'
  ) );





  /* Security edits */
  /* Prevent some exploits and block username enum by
	 * - disabling XML-RPC
	 * - blocking unauthorized access to the JSON API
	 * - removing author archives
	 */
	add_filter( 'xmlrpc_enabled', '__return_false' );
	add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
	});
	function disable_author_archives() {
		if (is_author()) {
			global $wp_query;
			$wp_query->set_404();
			status_header(404);
		} else {
			redirect_canonical();
		}
	}
	remove_filter( 'template_redirect', 'redirect_canonical' );
	add_action( 'template_redirect', 'disable_author_archives' );





  /* Remove emoji */
  /* Stop loading emoji styles and scripts */
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );





  /* Remove comment support */
  // Removes from admin menu
  add_action( 'admin_menu', 'custom_admin_menus' );
  function custom_admin_menus() {
      remove_menu_page( 'edit-comments.php' );
  }
  // Removes from post and pages
  add_action('init', 'remove_comment_support', 100);

  function remove_comment_support() {
      remove_post_type_support( 'post', 'comments' );
      remove_post_type_support( 'page', 'comments' );
  }
  // Removes from admin bar
  function custom_admin_bar_render() {
      global $wp_admin_bar;
      $wp_admin_bar->remove_menu('comments');
  }
  add_action( 'wp_before_admin_bar_render', 'custom_admin_bar_render' );





  /* Remove jQuery */
  if ( !is_admin() ) wp_deregister_script('jquery');
