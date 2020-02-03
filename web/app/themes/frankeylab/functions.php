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
 * ContactForm7のカスタムバリデーション
 */
add_filter('wpcf7_validate_text*', 'custom_validate_name_kana', 1, 2);

function check_if_input_is_kana($result, $tag, $form_name) {
    $value = isset($_POST[$form_name]) ? trim($_POST[$form_name]) : '';
    if(!preg_match("/^[ぁ-ん]+$/u", $value) && $value !== "") {
        $result->invalidate($tag, 'ひらがなで入力してください');
    }
    return;
}

function custom_validate_name_kana($result, $tag) {
    switch($tag->name) {
        case 'family-name-kana' :
            check_if_input_is_kana($result, $tag, 'family-name-kana');
            break;
        case 'given-name-kana' :
            check_if_input_is_kana($result, $tag, 'given-name-furigana');
            break;
    }
    return $result;
}
