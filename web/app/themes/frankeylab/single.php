<?php
get_header();

$postType = get_post_type($post);
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
                <div class="content-wrap single-page-wrap">
                    <div class="single-page">
                        <div class="single-page__title-and-date">
                            <h1 class="title"><?php the_title(); ?></h1>
                            <span class="date"><?php the_date('Y.n.j'); ?></span>
                        </div>
                        <div class="single-page__image-container">
                            <ul class="single-page__image-container__tags">
                                <?php
                                $postTags = get_the_terms($post->ID, $postType . '-tag');
                                if ($postTags) {
                                    foreach ($postTags as $tag) {
                                        echo '<li class="tag"><p>#' . esc_html($tag->name) . '</p></li>';
                                    }
                                } ?>
                            </ul>
                            <img class="single-page__image-container__image" src="<?= $singlePageImageUrl; ?>" alt="<?php the_title(); ?>">
                        </div>
                        <div class="single-page__content">
                            <?php the_content(); ?>
                        </div>
                        <?php
                        global $post;
                            $args = array(
                            'numberposts' => 3,
                            'post_type' => $postType,
                            'taxonomy' => $postType . '-tag',
                            'orderby' => 'rand', //랜덤표시
                            'post__not_in' => array($post->ID) //현재 표시중인 포스트는 예외
                            );
                            ?>
                            <div class="single-page__related-post">
                                <ul class="related-post-list">
                                    <?php $myPosts = get_posts($args); if($myPosts) : ?>
                                        <?php foreach($myPosts as $post) : setup_postdata($post); ?>
                                            <li class="related-post-list__item">
                                                <a href="<?php the_permalink(); ?>">
                                                    <div class="related-post-img">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </div>
                                                    <div class="related-post-title">
                                                        <p><?php the_title(); ?></p>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                    <li>관련 포스트가 없습니다.</li>
                                </ul>
                            </div>
                        <?php endif; 
                        wp_reset_postdata(); 
                        ?>
                    </div>

                </div>
            </main><!-- .site-main -->
        </div><!-- .content-area -->

    <?php
    endwhile;
endif;
get_footer();

