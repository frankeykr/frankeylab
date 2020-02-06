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

    if (is_post_type_archive('code')) {
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
 * 커스텀포스트 기능 추가
 */
add_action('init', 'add_custom_post_type');
function add_custom_post_type() {
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
    if (is_post_type_archive('code')) {
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
    if (is_post_type_archive('code')) {
        $query->set('posts_per_page', 1);
    }
    return;
}

 /**
 * TOP PAGE에 넣는 숏 코드
 */
add_shortcode('code_list', 'add_code_short_code');
function add_code_short_code() {
    ob_start();
    ?>
    <section class="post">
        <?php
        $codeObject = new WP_Query(array(
            'post_type' => 'code',
            'posts_per_page' => 4,
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
                        <a href="<?php the_permalink(); ?>" class="link-to-single-page">
                            <div class="post-list__item__date">
                                <span class="date"><?php the_date('Y.n.j'); ?></span>
                            </div>
                            <div class="post-list__item__title">
                                <h3 class="title"><?= wp_trim_words(get_the_title(), 52, '⋯'); ?></h3>
                            </div>
                            <div class="post-list__item__image">
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
                                    <img class="image" src="<?= $codeImageUrl; ?>"
                                        alt="<?php the_title(); ?>">
                                </div>
                            </div>
                            <div class="post-list__item__content">
                                <p class="content"><?= wp_trim_words(get_the_content(), 30, '⋯'); ?></p>
                            </div>
                        </a>
                    </li>
                <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </ul>
        <div class="link-to-archive">
            <a class="link-to-archive-btn" href="<?= get_post_type_archive_link('code'); ?>">
                <span>VIEW ALL</span>
            </a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * 상세 페이지에서 페이지네이션을 출력하는 함수
 */
function single_page_pagination() {
    ?>
    <div class="single-page-pagination animate-transform">
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