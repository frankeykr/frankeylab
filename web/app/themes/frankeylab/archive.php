<?php get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="content-wrap">
                <?php
                $postType = get_post_type($post);
                $currentSelectedTagName = 'ALL';
                $currentSelectedTagSlug = get_query_var($postType . '-tag');
                if (!empty($currentSelectedTagSlug)) {
                    $currentSelectedTagName = '#' . get_term_by('slug', $currentSelectedTagSlug, $postType . '-tag')->name;
                }
                ?>
                <div class="content archive-page">
                    <!-- <h1 class="archive-page-title"><?= get_post_type($post); ?></h1>
                    <div class="archive-page__selected-tag">
                        <p class="selected-tag"><span>#<?= $currentSelectedTagName; ?></span></p>
                    </div> -->
                    <div class="post archive-page__posts">
                        <ul class="post-list">
                            <?php
                            if (have_posts()):
                                while (have_posts()):the_post();
                                $postImageUrl = "";
                                if (has_post_thumbnail()) {
                                    $postImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0];
                                } else {
                                    $postImageUrl = get_stylesheet_directory_uri() . "/image/no-image.svg";
                                }
                                ?>
                                    <li class="post-list__item">
                                        <div class="post-list__item__new-icon">
                                            <?php
                                            $today = date_i18n('U');
                                            $postPublishDay = get_the_time('U');
                                            $dayDifference = ($today - $postPublishDay) / 86400;
                                            if ($dayDifference < 14) { ?>
                                                <span class="new-icon">NEW!</span>
                                            <?php } ?>
                                        </div>
                                        <div class="post-list__item__title">
                                            <a href="<?php the_permalink(); ?>" class="link-to-single-page">
                                                <h2 class="title"><?= wp_trim_words(get_the_title(), 52, '⋯'); ?></h2>
                                            </a>
                                        </div>
                                        <div class="post-list__item__date">
                                            <span class="date"><?php the_date('Y/n/j'); ?></span>
                                        </div>
                                        <div class="post-list__item__image">
                                            <div class="post-image-container">
                                                <a href="<?php the_permalink(); ?>" class="link-to-single-page">
                                                    <img class="image" src="<?= $postImageUrl; ?>"
                                                        alt="<?php the_title(); ?>">
                                                </a>
                                            </div>
                                            <ul class="tags-container">
                                                <?php
                                                $eachPostTags = get_the_terms($post->ID, $postType . '-tag');
                                                if ($eachPostTags) {
                                                    foreach ($eachPostTags as $tag) {
                                                        echo '<li class="tag"><span>#' . esc_html($tag->name) . '</span></li>';
                                                    }
                                                } ?>
                                            </ul>
                                        </div>
                                        <div class="post-list__item__content">
                                            <p class="content"><?= wp_trim_words(get_the_content(), 30, '⋯'); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="link">
                                                <span>READ MORE</span>
                                                <div class="arrow-container">
                                                    <div class="arrow-box">
                                                        <span class="arrow primera next"></span>
                                                        <span class="arrow segunda next"></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                <?php
                                endwhile;
                            endif; ?>
                        </ul>
                        <?php
                        $loadingImage = '<img class="archive-page__pagination-next__image" src="'. get_stylesheet_directory_uri() .'/image/loader-icon.gif">';
                        next_posts_link($loadingImage);
                        ?>
                    </div>
                </div>

                <aside class="sidebar">
                    <?php echo do_shortcode('[profile]'); ?>
                    <div class="sidebar-tags">
                        <ul class="tag-list">
                            <?php
                            $isTheTagSelected = '';
                            if (empty($currentSelectedTagSlug)) {
                                $isTheTagSelected = 'current-selected-tag';
                            } ?>
                            <li class="tag-list__item <?= $isTheTagSelected; ?>">
                                <a href="<?= get_post_type_archive_link($postType); ?>" class="tag-link">
                                    <p>전체</p>
                                </a>
                            </li>
                            <?php
                            $allTags = get_terms($postType . '-tag');
                            if ($allTags) {
                                foreach ($allTags as $tag) :
                                    $linkToTagLimitedArchivePage = get_post_type_archive_link($postType) . '?' . $postType . '-tag=' . $tag->slug;
                                    $isTheTagSelected = '';
                                    if (urldecode($tag->slug) == $currentSelectedTagSlug) {
                                        $isTheTagSelected = 'current-selected-tag';
                                    }
                                    ?>
                                    <li class="tag-list__item <?= $isTheTagSelected; ?>">
                                        <a href="<?= $linkToTagLimitedArchivePage ?>" class="tag-link">
                                            <p>#<?= $tag->name ?></p>
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                            } ?>
                        </ul>
                    </div>

                </aside>

            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    
<?php
get_footer();
