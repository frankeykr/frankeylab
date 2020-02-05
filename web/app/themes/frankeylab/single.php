<?php
get_header();

if (have_posts()):
    while (have_posts()):the_post();
        if (has_post_thumbnail()) {
            $singlePageImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0];
        } else {
            $singlePageImageUrl = get_stylesheet_directory_uri() . "/image/dummy.jpg";
        }
        ?>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="content-wrap">
                    <div class="single-page">
                        <div class="single-page__image-container">
                            <img class="single-page__image-container__item" src="<?= $singlePageImageUrl; ?>" alt="<?php the_title(); ?>">
                        </div>
                        <div class="single-page__title-and-date">
                            <h1 class="title"><?php the_title(); ?></h1>
                            <span class="date"><?php the_date('Y.n.j'); ?></span>
                        </div>
                        <ul class="single-page__tags">
                            <?php
                            $postType = get_post_type($post);
                            $postTags = get_the_terms($post->ID, $postType . '-tag');
                            if ($resultsTags) {
                                foreach ($postTags as $tag) {
                                    echo '<li class="single-tags-container__tag"><p>' . esc_html($tag->name) . '</p></li>';
                                }
                            } ?>
                        </ul>
                        <div class="single-page__content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php single_page_pagination();?>

                </div>
            </main><!-- .site-main -->
        </div><!-- .content-area -->

    <?php
    endwhile;
endif;
get_footer();

