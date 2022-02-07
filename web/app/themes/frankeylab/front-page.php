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
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2546334153394027"
                        crossorigin="anonymous"></script>
                    <!-- 사이드바 -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-2546334153394027"
                        data-ad-slot="4689451836"
                        data-ad-format="auto"
                        data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </aside>
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();
