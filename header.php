<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="theme-color" content="#f15a2c">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php $theme_info = wp_get_theme(); ?>

    <?php wp_enqueue_script( 'scripts',
      get_template_directory_uri() . '/static/js/main.js',
      ['jquery'], $theme_info->version, true ); ?>

    <?php wp_enqueue_style('main',
      get_template_directory_uri() . '/static/css/main.css',
      [], $theme_info->version ); ?>

    <meta name="ajaxurl" content="<?php echo admin_url( 'admin-ajax.php' ); ?>">

    <?php wp_head(); ?>

  </head>
  <body>

    <a href="#site-content" class="skip">Ga naar de inhoud</a>

    <header class="site-header">

      <a href="<?php echo get_site_url(); ?>">
        <picture>
          <source type="image/svg+xml"
            srcset="<?php echo image_url('logo-mark.svg'); ?>">
          <img alt="<?php bloginfo( 'name' ); ?>"
            title="<?php bloginfo( 'name' ); ?>"
            class="logo"
            srcset="<?php echo image_url('logo.png'); ?> 1x,
              <?php echo image_url('logo@2x.png'); ?> 2x"
            src="<?php echo image_url('logo.png'); ?>">
        </picture>
        <?php bloginfo( 'name' ); ?>
      </a>

      <a href="#menu" class="js-menu-toggle">Menu</a>

      <nav class="site-menu" id="menu">
        <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'site-menu__list' ) ); ?>
      </nav>

    </header>
