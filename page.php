<?php /**
 * Page
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <main class="page" id="site-content">

    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('post-thumbnail',
        array( 'class' => 'page-thumb__img')
      ); ?>
    <?php endif; ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

  </main>

<?php endwhile; else: ?>

  <main class="page" id="site-content">

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
