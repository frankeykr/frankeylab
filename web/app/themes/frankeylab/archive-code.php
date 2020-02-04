<?php get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            
            <div class="wrapper">
                <div class="archive-page">
                    <h1 class="archive-page-title">코드 아카이브</h1>
                    
                    <div class="archive-page__selected-tag">
                        <?php
                        $currentSelectedTagName = '전체';
                        $currentSelectedTagSlug = get_query_var('code-tag');
                        if (!empty($currentSelectedTagSlug)) {
                            $currentSelectedTagName = '#' . get_term_by('slug', $currentSelectedTagSlug, 'code-tag')->name;
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
                                <a href="<?= get_post_type_archive_link('code'); ?>" class="tag-link">
                                    <p>전체</p>
                                </a>
                            </li>
                            <?php
                            $allTags = get_terms('code-tag');
                            if ($allTags) {
                                foreach ($allTags as $tag) :
                                    $linkToTagLimitedArchivePage = get_post_type_archive_link('code') . '?code-tag=' . $tag->slug;
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
                                    //アイキャッチ画像があればそのurlを返す
                                    $postImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0];
                                } else {
                                    //アイキャッチ画像がない場合は代替画像のurlを返す
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
                                                    $eachPostTags = get_the_terms($post->ID, 'code-tag');
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
                        $loadingImage = '<img class="archive-code__pagination-next__image" src="'. get_stylesheet_directory_uri() .'/image/loader-icon.gif">';
                        next_posts_link($loadingImage);
                        ?>
                    </div>
                </div>
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
<?php
get_footer();
