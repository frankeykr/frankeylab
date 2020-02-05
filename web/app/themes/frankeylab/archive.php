<?php get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="content-wrap">
                <div class="archive-page">
                    <h1 class="archive-page-title"><?= get_post_type($post); ?></h1>
                    <div class="archive-page__selected-tag">
                        <?php
                        $postType = get_post_type($post);
                        $currentSelectedTagName = 'ALL';
                        $currentSelectedTagSlug = get_query_var($postType . '-tag');
                        if (!empty($currentSelectedTagSlug)) {
                            $currentSelectedTagName = '#' . get_term_by('slug', $currentSelectedTagSlug, $postType . '-tag')->name;
                        }
                        ?>
                        <p class="selected-tag"><span><?= $currentSelectedTagName; ?></span> ← 검색결과</p>
                    </div>
                    <div class="archive-page__tags">
                        <ul class="tag-list">
                            <?php
                            $isTheTagSelected = '';
                            if (empty($currentSelectedTagSlug)) {
                                $isTheTagSelected = 'current-selected-tag';
                            } ?>
                            <li class="tag-list__item <?= $isTheTagSelected; ?>">
                                <a href="<?= get_post_type_archive_link($postType); ?>" class="tag-link">
                                    <p>ALL</p>
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


                    <div class="archive-page__posts">
                        <ul class="post-list">
                            <?php
                            if (have_posts()):
                                while (have_posts()):the_post();
                                $postImageUrl = "";
                                if (has_post_thumbnail()) {
                                    $postImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0];
                                } else {
                                    $postImageUrl = get_stylesheet_directory_uri() . "/image/dummy.jpg";
                                }
                                ?>
                                    <li class="post-list__item">
                                        <a href="<?php the_permalink(); ?>" class="link-to-single-page">
                                            <div class="new-icon-container">
                                                <?php
                                                $today = date_i18n('U');
                                                $postPublishDay = get_the_time('U');
                                                $dayDifference = ($today - $postPublishDay) / 86400;
                                                if ($dayDifference < 14) { ?>
                                                    <p class="new-icon">NEW!</p>
                                                <?php } ?>
                                            </div>
                                            <div class="post-image-container">
                                                <img class="post-image-container__image" src="<?= $postImageUrl; ?>" alt="<?php the_title(); ?>">
                                            </div>
                                            <div class="post-title-and-tags">
                                                <h2 class="post-title"><?php the_title(); ?></h2>
                                                <ul class="each-post-tags-container">
                                                    <?php
                                                    $eachPostTags = get_the_terms($post->ID, $postType . '-tag');
                                                    if ($eachPostTags) {
                                                        foreach ($eachPostTags as $tag) {
                                                            echo '<li class="each-post-tags-container__tag"><p>#' . esc_html($tag->name) . '</p></li>';
                                                        }
                                                    } ?>
                                                </ul>
                                            </div>
                                        </a>
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
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    
<?php
get_footer();
