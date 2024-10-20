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
                    <div class="sidebar-ad">
                        <div class="ad-container">
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
                        </div>
                    </div>
                </aside>
            </div>
            <div class="content-bottom-ads">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2546334153394027"
                    crossorigin="anonymous"></script>
                <!-- 프론트 아래 -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-2546334153394027"
                    data-ad-slot="1994186440"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

    <!-- 사이드바 광고 Sticky -->
    <script>
        const adContainer = document.querySelector(".ad-container");
        const sidebar = document.querySelector(".sidebar-ad");
        const offsetTop = sidebar.offsetTop;
        window.addEventListener("scroll", function () {
            if (window.pageYOffset > offsetTop) {
            adContainer.classList.add("ad-fixed");
            } else {
            adContainer.classList.remove("ad-fixed");
            }
        });
    </script>
<?php
get_footer();
