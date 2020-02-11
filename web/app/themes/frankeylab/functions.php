<?php
// 관리 화면에서 입력한 콘텐츠의 자동성형을 off로 만든다
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');
function enqueue_styles_and_scripts() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_dequeue_style('parent-style'); // 부모 테마의 디폴트 스타일 시트를 불러오지 못하게 한다
    wp_enqueue_style('base-css', get_stylesheet_directory_uri() . '/dist/css/base.css');
    wp_enqueue_script('base-js', get_stylesheet_directory_uri() . '/dist/js/base.js', array(), false, true);
    
    if (is_post_type_archive('blog')) {
        wp_enqueue_script('infinite-scroll', get_stylesheet_directory_uri() . '/dist/js/infinite_scroll.js', array(), false, true);
    }
    if (is_post_type_archive('code')) {
        wp_enqueue_script('infinite-scroll', get_stylesheet_directory_uri() . '/dist/js/infinite_scroll.js', array(), false, true);
    }
    if (is_post_type_archive('life')) {
        wp_enqueue_script('infinite-scroll', get_stylesheet_directory_uri() . '/dist/js/infinite_scroll.js', array(), false, true);
    }
}

add_action('admin_menu', 'remove_menu');
function remove_menu() {
    remove_menu_page('index.php'); // 대쉬보드
    remove_menu_page('edit.php'); // 투고
    remove_menu_page('edit-comments.php'); // 코멘트
}

/**
 * 커스텀포스트 추가
 */
add_action('init', 'add_code_custom_post_type');
function add_code_custom_post_type() {
    $codeParams = array(
        'labels' => array(
            'name' => '코드',
            'singular_name' => '코드',
            'add_new' => '코드 추가',
            'add_new_item' => '신규 코드 추가',
            'edit_item' => '편집',
            'new_item' => '신착 코드',
            'all_items' => '모든 코드',
            'view_item' => '코드 보기',
            'search_items' => '코드 검색',
            'not_found' => '찾을 수 없습니다',
            'not_found_in_trash' => '휴지통 안에 없습니다',
            'enter_title_here' => '코드 이름을 입력',
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        "supports" => array("title", "editor", "thumbnail"),
        'menu_position' => 22,
    );
    register_post_type('code', $codeParams);
}

add_action('init', 'add_blog_custom_post_type');
function add_blog_custom_post_type() {
    $blogParams = array(
        'labels' => array(
            'name' => '블로그',
            'singular_name' => '블로그',
            'add_new' => '블로그 추가',
            'add_new_item' => '신규 블로그 추가',
            'edit_item' => '편집',
            'new_item' => '신착 블로그',
            'all_items' => '모든 블로그',
            'view_item' => '블로그 보기',
            'search_items' => '블로그 검색',
            'not_found' => '찾을 수 없습니다',
            'not_found_in_trash' => '휴지통 안에 없습니다',
            'enter_title_here' => '블로그 이름을 입력',
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        "supports" => array("title", "editor", "thumbnail"),
        'menu_position' => 23,
    );
    register_post_type('blog', $blogParams);
}

add_action('init', 'add_life_custom_post_type');
function add_life_custom_post_type() {
    $lifeParams = array(
        'labels' => array(
            'name' => '라이프',
            'singular_name' => '라이프',
            'add_new' => '라이프 추가',
            'add_new_item' => '신규 라이프 추가',
            'edit_item' => '편집',
            'new_item' => '신착 라이프',
            'all_items' => '모든 라이프',
            'view_item' => '라이프 보기',
            'search_items' => '라이프 검색',
            'not_found' => '찾을 수 없습니다',
            'not_found_in_trash' => '휴지통 안에 없습니다',
            'enter_title_here' => '라이프 이름을 입력',
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        "supports" => array("title", "editor", "thumbnail"),
        'menu_position' => 24,
    );
    register_post_type('life', $lifeParams);
}

/**
 * 커스텀포스트에 태그 기능 추가
 */
register_taxonomy(
    'code-tag',
    'code',
    array(
        'hierarchical' => false,
        'label' => '코드 태그',
        'singular_label' => '코드 태그',
        'public' => true,
        'query_var' => true,
        'has_archive' => false,
        'rewrite' => true,
        'show_ui' => true,
        'labels' => array(
            'add_new_item' => '코드 태그 추가',
            'search_items' => '코드 태그 검색',
        )
    )
);

register_taxonomy(
    'blog-tag',
    'blog',
    array(
        'hierarchical' => false,
        'label' => '블로그 태그',
        'singular_label' => '블로그 태그',
        'public' => true,
        'query_var' => true,
        'has_archive' => false,
        'rewrite' => true,
        'show_ui' => true,
        'labels' => array(
            'add_new_item' => '블로그 태그 추가',
            'search_items' => '블로그 태그 검색',
        )
    )
);

register_taxonomy(
    'life-tag',
    'life',
    array(
        'hierarchical' => false,
        'label' => '라이프 태그',
        'singular_label' => '라이프 태그',
        'public' => true,
        'query_var' => true,
        'has_archive' => false,
        'rewrite' => true,
        'show_ui' => true,
        'labels' => array(
            'add_new_item' => '라이프 태그 추가',
            'search_items' => '라이프 태그 검색',
        )
    )
);


/**
 * 관리화면 헤더 메뉴에 체크박스 추가
 */

add_action('after_setup_theme', 'menu_setup');
function menu_setup()
{
    register_nav_menus(array(
        'global' => '글로벌 메뉴',
    ));
}

/**
 * 코드 아카이브에서 무한 스크롤을 위한 코드. 
 * 다음 페이지의 링크를 표시하는 함수에서 next_posts_link()로 생성되는 a태그에 id명을 붙이는 함수
*/
add_filter('next_posts_link_attributes', 'add_next_posts_link_class');
function add_next_posts_link_class() {
    if (is_post_type_archive('blog')) {
        return 'id="archive__pagination-next" class="archive__pagination-next-class"';
    }
    if (is_post_type_archive('code')) {
        return 'id="archive__pagination-next" class="archive__pagination-next-class"';
    }
    if (is_post_type_archive('life')) {
        return 'id="archive__pagination-next" class="archive__pagination-next-class"';
    }
}

/**
 * 코드 아카이브에서 메인루프 시킨 게시물 표시수를 1페이지당 6개만 표시하도록 설정한다
 * -1로 설정하면 제한없이 표시
 */
add_action('pre_get_posts', 'change_posts_per_page');
function change_posts_per_page($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if (is_post_type_archive('blog')) {
        $query->set('posts_per_page', 1);
    }
    if (is_post_type_archive('code')) {
        $query->set('posts_per_page', 1);
    }
    if (is_post_type_archive('life')) {
        $query->set('posts_per_page', 1);
    }
    return;
}

 /**
 * TOP PAGE에 넣는 숏 코드
 */
add_shortcode('blog_list', 'add_blog_list_code_short_code');
function add_blog_list_code_short_code() {
    ob_start();
    ?>
    <section class="post">
        <?php
        $blogObject = new WP_Query(array(
            'post_type' => 'blog',
            'posts_per_page' => 3,
            'order' => 'DESC',
            'orderby' => 'date',
        ));
        ?>
        <ul class="post-list">
            <?php
            if ($blogObject->have_posts()):
                while ($blogObject->have_posts()):$blogObject->the_post();
                    $blogImageUrl = "";
                    if (has_post_thumbnail()) {
                        $blogImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($blogObject->ID), 'large')[0];
                    } else {
                        $blogImageUrl = get_stylesheet_directory_uri() . "/image/dummy.jpg";
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
                            <span class="date"><?php the_date('n/j'); ?></span>
                        </div>
                        <div class="post-list__item__image">
                            <div class="year-container">
                                <span class="year"><?php the_time('Y'); ?></span>
                            </div>
                            <div class="post-image-container">
                                <img class="image" src="<?= $blogImageUrl; ?>"
                                    alt="<?php the_title(); ?>">
                            </div>
                            <ul class="tags-container">
                            <?php
                            $blogTags = get_the_terms($blogObject->ID, 'blog-tag');
                            if ($blogTags) {
                                foreach ($blogTags as $tag) {
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
            endif;
            wp_reset_postdata();
            ?>
        </ul>
    </section>
    <?php
    return ob_get_clean();
}

add_shortcode('code_list', 'add_code_list_code_short_code');
function add_code_list_code_short_code() {
    ob_start();
    ?>
    <section class="post">
        <?php
        $codeObject = new WP_Query(array(
            'post_type' => 'code',
            'posts_per_page' => 3,
            'order' => 'DESC',
            'orderby' => 'date',
        ));
        ?>
        <ul class="post-list">
            <?php
            if ($codeObject->have_posts()):
                while ($codeObject->have_posts()):$codeObject->the_post();
                    $codeImageUrl = "";
                    if (has_post_thumbnail()) {
                        $codeImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($codeObject->ID), 'large')[0];
                    } else {
                        $codeImageUrl = get_stylesheet_directory_uri() . "/image/dummy.jpg";
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
                            <span class="date"><?php the_date('n/j'); ?></span>
                        </div>
                        <div class="post-list__item__image">
                            <div class="year-container">
                                <span class="year"><?php the_time('Y'); ?></span>
                            </div>
                            <div class="post-image-container">
                                <img class="image" src="<?= $codeImageUrl; ?>"
                                    alt="<?php the_title(); ?>">
                            </div>
                            <ul class="tags-container">
                            <?php
                            $codeTags = get_the_terms($codeObject->ID, 'code-tag');
                            if ($codeTags) {
                                foreach ($codeTags as $tag) {
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
            endif;
            wp_reset_postdata();
            ?>
        </ul>
    </section>
    <?php
    return ob_get_clean();
}

add_shortcode('life_list', 'add_life_list_code_short_code');
function add_life_list_code_short_code() {
    ob_start();
    ?>
    <section class="post">
        <?php
        $lifeObject = new WP_Query(array(
            'post_type' => 'life',
            'posts_per_page' => 3,
            'order' => 'DESC',
            'orderby' => 'date',
        ));
        ?>
        <ul class="post-list">
            <?php
            if ($lifeObject->have_posts()):
                while ($lifeObject->have_posts()):$lifeObject->the_post();
                    $lifeImageUrl = "";
                    if (has_post_thumbnail()) {
                        $lifeImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($lifeObject->ID), 'large')[0];
                    } else {
                        $lifeImageUrl = get_stylesheet_directory_uri() . "/image/dummy.jpg";
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
                            <span class="date"><?php the_date('n/j'); ?></span>
                        </div>
                        <div class="post-list__item__image">
                            <div class="year-container">
                                <span class="year"><?php the_time('Y'); ?></span>
                            </div>
                            <div class="post-image-container">
                                <img class="image" src="<?= $lifeImageUrl; ?>"
                                    alt="<?php the_title(); ?>">
                            </div>
                            <ul class="tags-container">
                            <?php
                            $lifeTags = get_the_terms($lifeObject->ID, 'life-tag');
                            if ($lifeTags) {
                                foreach ($lifeTags as $tag) {
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
            endif;
            wp_reset_postdata();
            ?>
        </ul>
    </section>
    <?php
    return ob_get_clean();
}

 /**
 * ABOUT 숏 코드
 */
add_shortcode('about', 'add_about_code_short_code');
function add_about_code_short_code() {
    ob_start();
    ?>
    <div class="about">
        <div class="about__content">
            <p>
                블로그·어필리에이트·프로그래밍을 사랑합니다. 
                신규 졸업자로 세부 섬에 취직 → 11개월 만에 퇴직 → 프리랜서 → 창업 → 창업 실패 → 블로그를 쓰다 → 
                블로그 수익 7자릿수 달성. 평소에는 방콕을 중심으로 남국에 틀어박히면서 생활비는 5만 엔 정도로 살고 있습니다.
            </p>
        </div>
        <div class="about__link">
            <a class="link" href="<?= home_url()?>/#">
                <span>상세프로필</span>
                <div class="arrow-container">
                    <div class="arrow-box">
                        <span class="arrow primera next"></span>
                        <span class="arrow segunda next"></span>
                    </div>
                </div>
            </a>
            <a class="link" href="<?= home_url()?>/#">
                <span>메일 문의하기</span>
                <div class="arrow-container">
                    <div class="arrow-box">
                        <span class="arrow primera next"></span>
                        <span class="arrow segunda next"></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * 상세 페이지에서 페이지네이션을 출력하는 함수
 */
function single_page_pagination() {
    ?>
    <div class="single-page-pagination">
        <?php
        $previous_post = get_previous_post();
        $next_post = get_next_post();
        ?>
        <div class="previous-page">
            <?php
            if (!empty($next_post)):
                $next_post_id = $next_post->ID; ?>
                <a class="previous-page__link" href="<?= get_the_permalink($next_post_id); ?>">
                    <div class="pagination-container pagination-container__left">
                        <p class="pagination-title"><?= get_the_title($next_post_id); ?></p>
                        <span class="arrow-left"></span>
                    </div>
                </a>
            <?php endif; ?>
        </div>
        <div class="next-page">
            <?php
            if (!empty($previous_post)):
                $previous_post_id = $previous_post->ID; ?>
                <a class="next-page__link" href="<?= get_the_permalink($previous_post_id); ?>">
                    <div class="pagination-container pagination-container__right">
                        <p class="pagination-title"><?= get_the_title($previous_post_id); ?></p>
                        <span class="arrow-right"></span>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}