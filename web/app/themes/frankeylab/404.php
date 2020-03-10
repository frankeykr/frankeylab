<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="content-wrap not-found">
            <div class="content">
                <div class="english">
                    <span>404</span>
                    <span>NOT FOUND</span>
                </div>
                <div class="korean">
                    <p>찾을수 없는 페이지 입니다.</p>
                </div>
                <div class="link-to-page">
                    <a href="<?= home_url();?>" class="link">
                        <span>HOME</span>
                    </a>
                </div>
            </div>
        </div>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>

