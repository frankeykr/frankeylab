<?php
get_header(); ?>

<main id="main" class="page" role="main">
    <article class="page__content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
    </article>
</main>

<?php
get_footer();
