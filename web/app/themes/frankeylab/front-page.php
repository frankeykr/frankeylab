<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="content-wrap front-page">
                <article class="content">
                    <?php the_content(); ?>
                </article>
                <aside class="sidebar front-page__sidebar">
                    <div class="profile">
                        <div class="profile__image-container">
                            <img class="profile__image-container__image" 
                            src="<?= get_stylesheet_directory_uri()?>/image/profile.png" alt="profile-img">
                        </div>
                        <div class="profile__name-container">
                            <span class="profile__name-container__name">FRANKEY</span>
                        </div>
                        <div class="profile__content-container">
                            <?php echo do_shortcode('[about]'); ?>
                        </div>
                    </div>
                </aside>
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();
