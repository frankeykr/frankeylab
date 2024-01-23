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
    if (is_post_type_archive(array('outdoor', 'blog', 'code', 'japan', 'life'))) {
        wp_enqueue_script('infinite-scroll', get_stylesheet_directory_uri() . '/dist/js/infinite_scroll.js', array(), false, true);
    }
    if (is_singular(array('outdoor', 'blog', 'code', 'japan', 'life'))) {
        wp_enqueue_script('scroll_indicator', get_stylesheet_directory_uri() . '/dist/js/scroll_indicator.js', array(), false, true);
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
add_action('init', 'add_outdoor_custom_post_type');
function add_outdoor_custom_post_type() {
    $outdoorParams = array(
        'labels' => array(
            'name' => '아웃도어',
            'singular_name' => '아웃도어',
            'add_new' => '아웃도어 추가',
            'add_new_item' => '신규 아웃도어 추가',
            'edit_item' => '편집',
            'new_item' => '신착 아웃도어',
            'all_items' => '모든 아웃도어',
            'view_item' => '아웃도어 보기',
            'search_items' => '아웃도어 검색',
            'not_found' => '찾을 수 없습니다',
            'not_found_in_trash' => '휴지통 안에 없습니다',
            'enter_title_here' => '아웃도어 이름을 입력',
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
        'menu_position' => 21,
        'show_in_rest' => true,
    );
    register_post_type('outdoor', $outdoorParams);
}

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
        'show_in_rest' => true,
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
        'show_in_rest' => true,
    );
    register_post_type('blog', $blogParams);
}

add_action('init', 'add_japan_custom_post_type');
function add_japan_custom_post_type() {
    $japanParams = array(
        'labels' => array(
            'name' => '일본',
            'singular_name' => '일본',
            'add_new' => '일본 추가',
            'add_new_item' => '신규 일본 추가',
            'edit_item' => '편집',
            'new_item' => '신착 일본',
            'all_items' => '모든 일본',
            'view_item' => '일본 보기',
            'search_items' => '일본 검색',
            'not_found' => '찾을 수 없습니다',
            'not_found_in_trash' => '휴지통 안에 없습니다',
            'enter_title_here' => '일본 이름을 입력',
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
        'show_in_rest' => true,
    );
    register_post_type('japan', $japanParams);
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
        'menu_position' => 25,
        'show_in_rest' => true,
    );
    register_post_type('life', $lifeParams);
}

/**
 * 커스텀포스트에 태그 기능 추가
 */
register_taxonomy(
    'outdoor-tag',
    'outdoor',
    array(
        'hierarchical' => false,
        'label' => '아웃도어 태그',
        'singular_label' => '아웃도어 태그',
        'public' => true,
        'query_var' => true,
        'has_archive' => false,
        'rewrite' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'labels' => array(
            'add_new_item' => '아웃도어 태그 추가',
            'search_items' => '아웃도어 태그 검색',
        )
    )
);

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
        'show_in_rest' => true,
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
        'show_in_rest' => true,
        'labels' => array(
            'add_new_item' => '블로그 태그 추가',
            'search_items' => '블로그 태그 검색',
        )
    )
);

register_taxonomy(
    'japan-tag',
    'japan',
    array(
        'hierarchical' => false,
        'label' => '일본 태그',
        'singular_label' => '일본 태그',
        'public' => true,
        'query_var' => true,
        'has_archive' => false,
        'rewrite' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'labels' => array(
            'add_new_item' => '일본 태그 추가',
            'search_items' => '일본 태그 검색',
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
        'show_in_rest' => true,
        'labels' => array(
            'add_new_item' => '라이프 태그 추가',
            'search_items' => '라이프 태그 검색',
        )
    )
);

/**
 * 커스텀포스트에 카테고리 추가
 */
register_taxonomy(
    'outdoor-category',
    'outdoor',
    array(
        'hierarchical' => true,
        'update_count_callback' => '_update_post_term_count',
        'label' => '아웃도어 카테고리',
        'singular_label' => '아웃도어 카테고리',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false, // 관리화면에서 표시 안함
        'show_in_rest' => true,
    )
);

register_taxonomy(
    'code-category',
    'code',
    array(
        'hierarchical' => true,
        'update_count_callback' => '_update_post_term_count',
        'label' => '코드 카테고리',
        'singular_label' => '코드 카테고리',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false, // 관리화면에서 표시 안함
        'show_in_rest' => true,
    )
);

register_taxonomy(
    'blog-category',
    'blog',
    array(
        'hierarchical' => true,
        'update_count_callback' => '_update_post_term_count',
        'label' => '블로그 카테고리',
        'singular_label' => '블로그 카테고리',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false, // 관리화면에서 표시 안함
        'show_in_rest' => true,
    )
);

register_taxonomy(
    'japan-category',
    'japan',
    array(
        'hierarchical' => true,
        'update_count_callback' => '_update_post_term_count',
        'label' => '일본 카테고리',
        'singular_label' => '일본 카테고리',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false, // 관리화면에서 표시 안함
        'show_in_rest' => true,
    )
);

register_taxonomy(
    'life-category',
    'life',
    array(
        'hierarchical' => true,
        'update_count_callback' => '_update_post_term_count',
        'label' => '라이프 카테고리',
        'singular_label' => '라이프 카테고리',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false, // 관리화면에서 표시 안함
        'show_in_rest' => true,
    )
);

/**
 * 카테고리 항목 추가
 */
add_common_category();
function add_common_category()
{
    // post type OUTDOOR
    wp_insert_term( '캠핑', 'outdoor-category', array('slug' => 'camping'));
    wp_insert_term( '등산', 'outdoor-category', array('slug' => 'hiking'));

    // post type CODE
    wp_insert_term( 'Wordpress', 'code-category', array('slug' => 'wordpress'));
    wp_insert_term( 'Magento2', 'code-category', array('slug' => 'magento2'));
    wp_insert_term( 'PHP', 'code-category', array('slug' => 'php'));
    wp_insert_term( 'Ruby', 'code-category', array('slug' => 'ruby'));
    wp_insert_term( 'CSS', 'code-category', array('slug' => 'css'));
    wp_insert_term( 'JavaScript', 'code-category', array('slug' => 'javascript'));

    // post type BLOG
    wp_insert_term( 'SEO', 'blog-category', array('slug' => 'seo'));
    wp_insert_term( '어필리에이트', 'blog-category', array('slug' => 'affiliate'));
    
    // post type JAPAN
    wp_insert_term( '문화', 'japan-category', array('slug' => 'culture'));
    wp_insert_term( '일상', 'japan-category', array('slug' => 'daily'));
    wp_insert_term( '여행', 'japan-category', array('slug' => 'travel'));

    // post type LIFE
    wp_insert_term( '디자인', 'life-category', array('slug' => 'design'));
    wp_insert_term( '이슈', 'life-category', array('slug' => 'issue'));
    wp_insert_term( '특이점', 'life-category', array('slug' => 'singularity'));
}

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
    if (is_post_type_archive('outdoor')) {
        return 'id="archive__pagination-next" class="archive__pagination-next-class"';
    }
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
    if (is_post_type_archive('outdoor')) {
        $query->set('posts_per_page', 1);
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
                        $blogImageUrl = get_stylesheet_directory_uri() . "/image/no-image.svg";
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
                                    <img class="image" src="<?= $blogImageUrl; ?>"
                                        alt="<?php the_title(); ?>">
                                </a>
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
add_shortcode('outdoor_list', 'add_outdoor_list_code_short_code');
function add_outdoor_list_code_short_code() {
    ob_start();
    ?>
    <section class="post">
        <?php
        $outdoorObject = new WP_Query(array(
            'post_type' => 'outdoor',
            'posts_per_page' => 3,
            'order' => 'DESC',
            'orderby' => 'date',
        ));
        ?>
        <ul class="post-list">
            <?php
            if ($outdoorObject->have_posts()):
                while ($outdoorObject->have_posts()):$outdoorObject->the_post();
                    $outdoorImageUrl = "";
                    if (has_post_thumbnail()) {
                        $outdoorImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($outdoorObject->ID), 'large')[0];
                    } else {
                        $outdoorImageUrl = get_stylesheet_directory_uri() . "/image/no-image.svg";
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
                                    <img class="image" src="<?= $outdoorImageUrl; ?>"
                                        alt="<?php the_title(); ?>">
                                </a>
                            </div>
                            <ul class="tags-container">
                            <?php
                            $outdoorTags = get_the_terms($outdoorObject->ID, 'outdoor-tag');
                            if ($outdoorTags) {
                                foreach ($outdoorTags as $tag) {
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
                        $codeImageUrl = get_stylesheet_directory_uri() . "/image/no-image.svg";
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
                                    <img class="image" src="<?= $codeImageUrl; ?>"
                                        alt="<?php the_title(); ?>">
                                </a>
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

add_shortcode('japan_list', 'add_japan_list_code_short_code');
function add_japan_list_code_short_code() {
    ob_start();
    ?>
    <section class="post">
        <?php
        $japanObject = new WP_Query(array(
            'post_type' => 'japan',
            'posts_per_page' => 3,
            'order' => 'DESC',
            'orderby' => 'date',
        ));
        ?>
        <ul class="post-list">
            <?php
            if ($japanObject->have_posts()):
                while ($japanObject->have_posts()):$japanObject->the_post();
                    $japanImageUrl = "";
                    if (has_post_thumbnail()) {
                        $japanImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($japanObject->ID), 'large')[0];
                    } else {
                        $japanImageUrl = get_stylesheet_directory_uri() . "/image/no-image.svg";
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
                                    <img class="image" src="<?= $japanImageUrl; ?>"
                                        alt="<?php the_title(); ?>">
                                </a>
                            </div>
                            <ul class="tags-container">
                            <?php
                            $japanTags = get_the_terms($japanObject->ID, 'japan-tag');
                            if ($japanTags) {
                                foreach ($japanTags as $tag) {
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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2546334153394027"
        crossorigin="anonymous"></script>
    <ins class="adsbygoogle"
        style="display:block"
        data-ad-format="fluid"
        data-ad-layout-key="-53+d8+69-ev-7q"
        data-ad-client="ca-pub-2546334153394027"
        data-ad-slot="7611660429"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
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
                        $lifeImageUrl = get_stylesheet_directory_uri() . "/image/no-image.svg";
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
                                    <img class="image" src="<?= $lifeImageUrl; ?>"
                                        alt="<?php the_title(); ?>">
                                </a>
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
 * PROFILE 숏 코드
 */
add_shortcode('profile', 'add_profile_code_short_code');
function add_profile_code_short_code() {
    ob_start();
    ?>
    <div class="sidebar-profile">
        <div class="sidebar-profile__image-container">
            <img class="sidebar-profile__image-container__image" 
            src="<?= get_stylesheet_directory_uri()?>/image/profile.png" alt="profile-img">
        </div>
        <div class="sidebar-profile__name-container">
            <span class="sidebar-profile__name-container__name">도쿄직장인, 후랑키</span>
        </div>
        <div class="sidebar-profile__content-container">
            <?php echo do_shortcode('[about]'); ?>
        </div>
    </div>
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
                대한민국 공군 전역 → 디자인 전문대학교 졸업 → 디자인 회사 인턴 → 음식점 창업 → 
                창업실패 → WEB 프로그래밍・일본어 공부 병행 → 도쿄 IT 중소기업 취직 → 외국계 IT 컨설팅 대기업 이직 → (돈 걱정없는 인생?)<br />
                <br />
                2018년 10월 도쿄에서 생활시작🗼 <br />
                2019년 1월부터 도쿄 옆동네 치바로 이사.<br />
                2024년 1월부터 장기출장으로 후쿠오카에 거주중.<br />
                <br />
                일본에서 살아가면서 느낀 경험과 여행, 생활, 취업 등 일본에 관련된 정보를 제공합니다. 누군가에게는 도움이 되었으면 하는 마음에 시작했습니다.    
            </p>
        </div>
        <div class="about__link">
            <a class="link" href="mailto:frankeykr@gmail.com" target="_blank">
                <i class="fa-regular fa-envelope fa-lg"></i>
            </a>
            <a class="link" href="https://www.instagram.com/frankeykr">
                <i class="fa-brands fa-instagram fa-lg"></i>
            </a>
            <a class="link" href="https://www.youtube.com/@frankeykr">
                <i class="fa-brands fa-youtube fa-lg"></i>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * br 태그 숏코드
 */
add_shortcode( 'br', 'line_break_shortcode' );
function line_break_shortcode() {
    return '<br />';
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
        <div class="pagination previous-page">
            <?php
            if (!empty($next_post)):
                $next_post_id = $next_post->ID; ?>
                <a class="pagination__link previous-page__link" href="<?= get_the_permalink($next_post_id); ?>">
                    <div class="pagination-container pagination-container__left">
                        <span class="arrow arrow-prev"></span>
                        <p class="pagination-title"><?= get_the_title($next_post_id); ?></p>
                    </div>
                </a>
            <?php endif; ?>
        </div>
        <div class="pagination next-page">
            <?php
            if (!empty($previous_post)):
                $previous_post_id = $previous_post->ID; ?>
                <a class="pagination__link next-page__link" href="<?= get_the_permalink($previous_post_id); ?>">
                    <div class="pagination-container pagination-container__right">
                        <span class="arrow arrow-next"></span>
                        <p class="pagination-title"><?= get_the_title($previous_post_id); ?></p>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}