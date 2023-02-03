<?php


// LINE QRリンクURL生成
global $line_qr_default;
global $line_qr;

// その他のURL
$line_qr_default = "https://aura-mico.jp/qr-codes/59577/preview";
$line_qr = $line_qr_default;

// カテゴリーごとにURL出し分け
$page_url = $_SERVER['REQUEST_URI'];
// その他脱毛
if (strpos($page_url, '/depi/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59582/preview";
}
// 全身脱毛
if (strpos($page_url, '/depi/whole_body/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59578/preview";
}
// ＶＩＯ脱毛
if (strpos($page_url, '/depi/vio/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59579/preview";
}
// フリセレ脱毛
if (strpos($page_url, '/depi/free_select/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59580/preview";
}
// フリセレ脱毛（LP）
if (strpos($page_url, '/depi/free_select-ad/')) {
    $line_qr = "/reserve/";
}
// 選べる2部位
if (strpos($page_url, '/depi/parts_choice/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59581/preview";
}
// 美白・美肌
if (strpos($page_url, '/skin/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59583/preview";
}
// 毛穴・ニキビ治療
if (strpos($page_url, '/pores/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59584/preview";
}
// たるみ・エイジング治療
if (strpos($page_url, '/age/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59585/preview";
}
// メディカルダイエット
if (strpos($page_url, '/diet/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59586/preview";
}
// アートメイク
if (strpos($page_url, '/artmake/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59587/preview";
}
// その他治療
if (strpos($page_url, '/others/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59588/preview";
}

// 背中3回コース（LP）
if (strpos($page_url, '/depi/nape-back/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/74193/preview";
}
// 椿式 よくばり全身脱毛（合計5部位）
if (strpos($page_url, '/depi/all/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/74192/preview";
}
// 白玉注射
if (strpos($page_url, '/skin/glutathione/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/74190/preview";
}
// プラセンタ注射
if (strpos($page_url, '/age/placenta_shot/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/74189/preview";
}
// マッサージピール
if (strpos($page_url, '/age/massage/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/74188/preview";
}
// ウルトラリフト4D 医療ハイフ
if (strpos($page_url, '/skin/hifu/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/74187/preview";
}
// レーザートーニング
if (strpos($page_url, '/skin/toning/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/74105/preview";
}
// 医療レーザー脱毛おすすめプラン
if (strpos($page_url, '/depi/camp/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/59581/preview";
}
// ゼオスキン
if (strpos($page_url, '/skin/zoskinhealth/')) {
    $line_qr = "https://aura-mico.jp/qr-codes/70335/preview";
}



function twpp_change_sort_order($query)
{
    if ($query->is_archve()) {
        $query->set('order', 'ASC');
        $query->set('orderby', 'ID');
    }
}
add_action('pre_get_posts', 'twpp_change_sort_order');


// JS・CSSファイルを読み込む
function add_files()
{
    //キャッシュ無効（開発時はこちらをコメント解除）
    $cache = date('YmdHis');
    //キャッシュ有効（公開後はこちらをコメント解除）
    //$cache = 1.0.0;
    // WordPress提供のjquery.jsを読み込まない
    wp_deregister_script('jquery');
    // jQueryの読み込み
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', "", $cache, false);
    // サイト共通JS
    wp_enqueue_script('main-script', get_template_directory_uri() . '/js/script.js', array('jquery'), $cache, true);
    // サイト共通のCSSの読み込み
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', "", $cache);
}
add_action('wp_enqueue_scripts', 'add_files');


// jQueryをCDNからに一本化
// function load_google_cdn()
// {
//     if (!is_admin()) {
//         // jQueryを登録解除
//         wp_deregister_script('jquery');

//         // Google CDNのjQueryを出力
//         wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true);
//     }
// }
// add_action('init', 'load_google_cdn');


/*********************
OGPタグ/Twitterカード設定を出力
 *********************/
function my_meta_ogp()
{
    if (is_front_page() || is_home() || is_singular()) {
        global $post;
        $ogp_title = '';
        $ogp_descr = '';
        $ogp_url = '';
        $ogp_img = '';
        $insert = '';

        if (is_singular()) { //記事＆固定ページ
            setup_postdata($post);
            $ogp_title = $post->post_title;
            $ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
            $ogp_url = get_permalink();
            wp_reset_postdata();
        } elseif (is_front_page() || is_home()) { //トップページ
            $ogp_title = get_bloginfo('name');
            $ogp_descr = get_bloginfo('description');
            $ogp_url = home_url();
        }

        //og:type
        $ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';

        //og:image
        if (is_singular() && has_post_thumbnail()) {
            $ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $ogp_img = $ps_thumb[0];
        } else {
            $ogp_img = 'https://tsubaki-grp.com/wp/wp-content/uploads/2020/06/deamapen_image.jpg';
        }

        //出力するOGPタグをまとめる
        $insert .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '" />' . "\n";
        $insert .= '<meta property="og:description" content="' . esc_attr($ogp_descr) . '" />' . "\n";
        $insert .= '<meta property="og:type" content="' . $ogp_type . '" />' . "\n";
        $insert .= '<meta property="og:url" content="' . esc_url($ogp_url) . '" />' . "\n";
        $insert .= '<meta property="og:image" content="' . esc_url($ogp_img) . '" />' . "\n";
        $insert .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
        $insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        $insert .= '<meta name="twitter:site" content="@tsubaki_clinic" />' . "\n";
        $insert .= '<meta property="og:locale" content="ja_JP" />' . "\n";

        //facebookのapp_id（設定する場合）
        $insert .= '<meta property="fb:app_id" content="3320261768019808">' . "\n";
        //app_idを設定しない場合ここまで消す

        echo $insert;
    }
} //END my_meta_ogp

add_action('wp_head', 'my_meta_ogp'); //headにOGPを出力




//titleタグの出力
function insert_title()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'insert_title');

//titleタグのカスタム
// function correct_title($title)
// {
//     //ページ名
//     $title_page = get_field('seo_title');
//     if ($title_page) {
//         $title['title'] = $title_page;
//     }
//     //サイト名
//     if (get_post_type() === 'column' || is_page('doctor')) {
//         $title['site'] = '医療レーザー脱毛なら椿クリニック【公式】';
//     }

//     return $title;
// }
// add_filter('document_title_parts', 'correct_title');

//titleタグのセパレーター設定
// function change_title_separator($sep)
// {
//     $sep = '|';
//     return $sep;
// }
// add_filter('document_title_separator', 'change_title_separator');


//アイキャッチ
add_theme_support('post-thumbnails');


//カスタムメニュー
function menu_setup()
{
    register_nav_menus(array(
        'gNav' => 'グローバルナビメニュー',
        'fNav' => 'フッターナビメニュー',
        'hNav' => 'ヘッダーナビメニュー',
        'fMenu' => 'フッター施術メニューナビ',
    ));
}
add_action('after_setup_theme', 'menu_setup');


//画像のカスタムサイズ
// function twpp_setup_theme()
// {
//     add_theme_support('post-thumbnails');
//     add_image_size('harf_bannar', 550, 278, false);
//     add_image_size('clinic_thumb', 200, 135, false);
// }
// add_action('after_setup_theme', 'twpp_setup_theme');


// ACFプロ用 オプションページ
acf_add_options_page(
    array(
        'page_title' => 'トップページ', // ページで表示されるタイトル
        'menu_title' => 'トップページ', // メニューで表示されるタイトル
        'menu_slug'  => 'top-settings', // 管理画面のメニュースラッグ
        'capability' => 'edit_posts', // このメニューが表示されるユーザーの権限
        'redirect'   => true, // メニュークリック時、sub_pageにリダイレクトするか（デフォルトはtrue）
        'position' => 5,
        'icon_url' => 'dashicons-welcome-write-blog'
    )
);
acf_add_options_page(
    array(
        'page_title' => 'おすすめプラン', // ページで表示されるタイトル
        'menu_title' => 'おすすめプラン', // メニューで表示されるタイトル
        'menu_slug'  => 'recommend-settings', // 管理画面のメニュースラッグ
        'capability' => 'edit_posts', // このメニューが表示されるユーザーの権限
        'redirect'   => true, // メニュークリック時、sub_pageにリダイレクトするか（デフォルトはtrue）
        'position' => 6,
        'icon_url' => 'dashicons-welcome-write-blog'
    )
);
acf_add_options_page(
    array(
        'page_title' => 'クリニック紹介', // ページで表示されるタイトル
        'menu_title' => 'クリニック紹介', // メニューで表示されるタイトル
        'menu_slug'  => 'clinic-settings', // 管理画面のメニュースラッグ
        'capability' => 'edit_posts', // このメニューが表示されるユーザーの権限
        'redirect'   => true, // メニュークリック時、sub_pageにリダイレクトするか（デフォルトはtrue）
        'position' => 8,
        'icon_url' => 'dashicons-welcome-write-blog'
    )
);
// acf_add_options_page(
//     array(
//         'page_title' => '医師登録', // ページで表示されるタイトル
//         'menu_title' => '医師登録', // メニューで表示されるタイトル
//         'menu_slug'  => 'doctor-settings', // 管理画面のメニュースラッグ
//         'capability' => 'edit_posts', // このメニューが表示されるユーザーの権限
//         'redirect'   => true, // メニュークリック時、sub_pageにリダイレクトするか（デフォルトはtrue）
//         'position' => 9,
//         'icon_url' => 'dashicons-welcome-write-blog'
//     )
// );

// // サブオプションページ
// acf_add_options_sub_page(
//     array(
//         'page_title'  => '3つ並びコンテンツ',
//         'menu_title'  => '3つ並びコンテンツ',
//         'menu_slug'   => 'top-3contents',
//         'parent_slug' => 'common-data-settings',
//     )
// );
// acf_add_options_sub_page(
//     array(
//         'page_title'  => 'フッターバナー',
//         'menu_title'  => 'フッターバナー',
//         'menu_slug'   => 'footer-bannar',
//         'parent_slug' => 'common-data-settings',
//     )
// );
// acf_add_options_sub_page(
//     array(
//         'page_title'  => 'フッターリンク',
//         'menu_title'  => 'フッターリンク',
//         'menu_slug'   => 'footer-link',
//         'parent_slug' => 'common-data-settings',
//     )
// );


add_action('admin_menu', 'add_page_admin_menu');
function add_page_admin_menu()
{
    add_menu_page(
        '椿クリニックとは',
        '椿クリニックとは',
        'read',
        'post.php?post=5&action=edit',
        '',
        'dashicons-welcome-write-blog',
        6
    );
    add_menu_page(
        '料金表',
        '料金表',
        'read',
        'post.php?post=7&action=edit',
        '',
        'dashicons-welcome-write-blog',
        7
    );
    add_menu_page(
        '未成年の方へ',
        '未成年の方へ',
        'read',
        'post.php?post=9&action=edit',
        '',
        'dashicons-welcome-write-blog',
        9
    );
}


//管理画面のメニューの管理
add_action('admin_menu', 'remove_menus');
function remove_menus()
{
    if (current_user_can('administrator')) { //administrator, editor, author, contributor, subscriber
        //remove_menu_page('index.php'); //ダッシュボード
        remove_menu_page('edit.php'); //投稿メニュー
        //remove_menu_page('upload.php'); //メディア
        //remove_menu_page('edit.php?post_type=page'); //ページ追加
        remove_menu_page('edit-comments.php'); //コメントメニュー
        //remove_menu_page('themes.php'); //外観メニュー
        //remove_menu_page('plugins.php'); //プラグインメニュー
        //remove_menu_page('tools.php'); //ツールメニュー
        //remove_menu_page('options-general.php'); //設定メニュー
    }
}


//投稿画面のカスタマイズ（CSS）
// function gutenberg_support_setup()
// {
//     wp_die($hook_suffix);
//     if ($hook_suffix === 'post.php') {
//         add_theme_support('editor-styles');
//         add_editor_style('editor-style.css');
//     }
// }
// add_action('after_setup_theme', 'gutenberg_support_setup');
function add_gutenberg_editor_style()
{
    global $post;
    //var_dump(get_post_type());
    $slug = $post->post_name;

    $post_type = get_post_type();

    if ($slug === 'price') {
        wp_enqueue_style('block-editor-style-price', get_theme_file_uri('css/editor-style.css'));
    }
    if ($post_type === 'menu') {
        wp_enqueue_style('block-editor-style', get_theme_file_uri('css/editor-style-menu.css'));
    }
    if ($post_type === 'style') {
        wp_enqueue_style('block-editor-style', get_theme_file_uri('css/editor-style-style.css'));
    }
    if ($post_type === 'column') {
        wp_enqueue_style('block-editor-style', get_theme_file_uri('css/editor-style-column.css'));
    }
}
add_action('enqueue_block_editor_assets', 'add_gutenberg_editor_style');





//Wordpressのバージョン非表示
remove_action('wp_head', 'wp_generator');


/* パーマリンクを拡張 */
add_action('generate_rewrite_rules', 'my_rewrite');
function my_rewrite($wp_rewrite)
{
    $taxonomies = get_taxonomies();
    $taxonomies = array_slice($taxonomies, 4, count($taxonomies) - 1);

    foreach ($taxonomies as $taxonomy) :

        $args['taxonomy'] = $taxonomy;
        $args['hide_empty'] = false;

        $cats = get_categories($args);

        foreach ($cats as $k => $v) {
            $new_rules['menu/' . $taxonomy . '/' . $v->category_nicename . '/page/([0-9]{1,})/?$'] = 'index.php?post_type=menus_category&taxonomy=' . $taxonomy . '&term=' . $v->category_nicename . '&paged=$matches[1]';
            $new_rules['menu/' . $v->category_nicename . '/?$'] = 'index.php?post_type=menus_category&taxonomy=' . $taxonomy . '&term=' . $v->category_nicename;
            $new_rules['menu/' . $v->category_nicename . '/page/([0-9]{1,})/?$'] = 'index.php?post_type=menus_category&taxonomy=' . $taxonomy . '&term=' . $v->category_nicename . '&paged=$matches[1]';
        }
        $post_types = get_taxonomy($taxonomy)->object_type;

        foreach ($post_types as $post_type) {
            $new_rules[$post_type . '/' . $taxonomy . '/(.+?)/?$'] = 'index.php?taxonomy=' . $taxonomy . '&term=' . $wp_rewrite->preg_index(1);
        }
        $wp_rewrite->rules = array_merge($new_rules, $wp_rewrite->rules);

    endforeach;
}



//WordPress5.5からの新オプション有効化

// 段落で行間追加
add_theme_support('custom-line-height');

// 画像カバーで単位追加
add_theme_support('custom-units', 'px', 'em', 'rem', 'vh', 'vw');

// XMLサイトマップが不要な場合
remove_action('init', 'wp_sitemaps_get_server');

// Lazy load 不要
add_filter('wp_lazy_loading_enabled', '__return_false');

// ウィジェット
add_theme_support('html5', array('navigation-widgets'));

//保護中：の削除
add_filter('protected_title_format', 'remove_protected');
function remove_protected($title)
{
    return '%s';
}

//canonicalの削除
remove_action('wp_head', 'rel_canonical');


//
function counseling_shortcode() {
	return '<div class="counseling-bnr">
            <div class="counseling-bnr-main">
              <img src="https://tsubaki-grp.com/wp/wp-content/uploads/2023/01/bnr-top.png" alt="無料カウンセリング予約 皆さまのお悩みやご質問をお伺いします。まずは、お気軽にご予約ください。">
            </div>
            <div class="counseling-bnr-line">
              <a target="_blank" href="https://tsubaki-grp.com/eh2p"><img src="https://tsubaki-grp.com/wp/wp-content/uploads/2023/01/bnr-line.png" alt="LINEでの予約（かんたん、60秒で入力完了！）"></a>
            </div>
            <div class="counseling-bnr-tel">
              <a target="_blank" href="https://tsubaki-grp.com/clinics/"><img src="https://tsubaki-grp.com/wp/wp-content/uploads/2023/01/bnr-tel.png" alt="お電話での予約"></a>
            </div>
          </div>';
}
add_shortcode( 'counseling', 'counseling_shortcode' );
