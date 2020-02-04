<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="content-wrap content-wrap-404">
            <div class="black-band-area"></div>
            <div class="black-band-title sidebar-title">
                <h3 class="section-title">404 NOT FOUND</h3>
            </div>

            <div class="main-content-wrap">
                <section class="main-content-area">
                    <div id="main-visual" class="main-visual">
                        <div class="main-visual-container main-visual-image"></div>
                        <h1 class="main-title">404 NOT FOUND</h1>
                    </div>
                    <div class="content-inner content-inner-404">
                        <h1>お探しのページは<br>見つかりませんでした</h1>
                        <p>URLが正しく入力されているか、確認してください。</p>

                        <div class="link-to-top-page">
                            <a class="link-to-top-page-btn" href="<?php echo home_url(); ?>">
                                <span>TOPへ戻る</span>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>

