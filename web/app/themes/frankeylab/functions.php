<?php
// 管理画面から入力したコンテンツの自動整形をoffにする
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');
function enqueue_styles_and_scripts() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_dequeue_style('parent-style'); // 親テーマのデフォルトスタイルシートを読み込ませない
    wp_enqueue_style('base-css', get_stylesheet_directory_uri() . '/dist/css/base.css');
    wp_enqueue_script('base-js', get_stylesheet_directory_uri() . '/dist/js/base.js', array(), false, true);
}

add_action('admin_menu', 'remove_menu');
function remove_menu() {
    remove_menu_page('index.php'); // ダッシュボード
    remove_menu_page('edit.php'); // 投稿
    remove_menu_page('edit-comments.php'); // コメント
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
            'new_item' => '新着物件事例',
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