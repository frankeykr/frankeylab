<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="content-wrap front-page">
                <article class="content">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </article>
                <aside class="sidebar front-page__sidebar">
                    <?php echo do_shortcode('[profile]'); ?>
                </aside>
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();
