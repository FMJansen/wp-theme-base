# Wordpress theme base

This repository contains the basic files to start a Wordpress theme. It uses Gulp to preprocess files from `src/` into `static/`, with these actions:

- JS is concatenated, then minified
- SCSS is turned into minified css and then prefixed
- Images are compressed
- Fonts are just copied
- Browsersync automatically reloads when a PHP file is updated and injects changed JS/SCSS

In `functions.php` are some useful basics, but jQuery is also deregistered for non-admins to decrease the payload, assuming you don’t use it.

In `inc/`, there’s a file for [Advanced Custom Fields](https://advancedcustomfields.com/) PHP exports and one for custom post types.

The string `CHANGE` is used to highlight bits which need to be changed to e.g. the theme name or custom post type slug.

Many traditional WP functionalities (comments, widgets, sidebars, etc.) are left out.
