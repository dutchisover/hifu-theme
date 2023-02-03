<?php
if (empty($_SERVER['HTTPS'])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>

    <?php
    //$seo_description = get_field('seo_description');
    //if (!$seo_description) {
    //$seo_description = get_bloginfo('description');
    //}
    $ld_json = get_field('localbusiness', $post->ID);
    if ($ld_json) {
        echo $ld_json;
    }

    $seo_h2 = get_field('seo_h2');
    if (!$seo_h2) {
        $seo_h2 = "医療脱毛と美肌治療なら椿クリニック<br>銀座院・名古屋院・心斎橋院";
    }
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="pingback" href="https://tsubaki-grp.com/wp/xmlrpc.php">
    <?php
    $http = is_ssl() ? 'https' : 'http';
    $url = $http . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    ?>
    <link rel="canonical" href="<?= $url; ?>" />

    <?php
    $parent_id = $post->post_parent;
    $parent_slug = get_post($parent_id)->post_name;
    if (is_front_page() || $parent_slug == 'clinics') {
    ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css" />
    <?php } ?>

    <?php get_template_part('inc/inc-tag-head'); ?>

    <?php get_template_part('inc/inc-style'); ?>

    <?php wp_head(); ?>
</head>

<?php
$test_id = 'public';
$test_url = $_SERVER['HTTP_HOST'];
if (strpos($test_url, 'test') !== false) {
    $test_id = 'test_page';
}
?>

<body <?php body_class(); ?> id="<?= $test_id; ?>">

    <?php get_template_part('inc/inc-tag-body'); ?>

    <div class="loading">
        <div class="loader">Loading...</div>
    </div>

    <header class="header wrapper">
        <div class="header_inner">
            <a href="/" class="header_link">
                <img src="<?php echo get_template_directory_uri(); ?>/image/logo_tsubaki_sp.png" alt="TSUBAKI CLINIC" class="header_logo">
            </a>

            <?php if (is_single('whole_body')) : ?>
                <h2 class="header_title">全身脱毛オリジナル全身コース.椿クリニック<br>銀座院・名古屋院・心斎橋院</h2>
            <?php elseif (is_single('vio')) : ?>
                <h2 class="header_title">VIOデリケートゾーン医療脱毛.椿クリニック<br>銀座院・名古屋院・心斎橋院</h2>
            <?php elseif (is_single('toning')) : ?>
                <h2 class="header_title">レーザートーニング.椿クリニック<br>銀座院・名古屋院・心斎橋院</h2>
            <?php elseif (is_single('ipl')) : ?>
                <h2 class="header_title">フォトフェイシャル.椿クリニック<br>銀座院・名古屋院・心斎橋院</h2>
            <?php elseif (is_single('hifu')) : ?>
                <h2 class="header_title">医療ハイフならウルトラ4Dリフト.椿クリニック<br>銀座院・名古屋院・心斎橋院</h2>
            <?php elseif (is_post_type_archive('column') || is_singular('column')) : ?>
                <div class="header_title">
                    <?= $seo_h2; ?>
                </div>
            <?php else : ?>
                <h2 class="header_title">
                    <?= $seo_h2; ?>
                </h2>
            <?php endif; ?>
            <?php
            // wp_nav_menu(array(
            //     'theme_location' => 'hNav',
            //     'container'       => 'nav',
            //     'menu_class'      => 'hNav',
            // ));
            global $line_qr_default;
            global $line_qr;
            ?>
            <nav class="menu-hnav-container">
                <ul id="menu-hnav" class="hNav">
                    <li class="gNav_item-line menu-item menu-item-type-custom menu-item-object-custom menu-item-1078"><a target="_blank" rel="noopener" href="<?= $line_qr_default; ?>">LINE友だち登録で初診料無料</a></li>
                    <li class="gNav_item-reserve menu-item menu-item-type-custom menu-item-object-custom menu-item-1079"><a target="_blank" rel="noopener" href="<?= $line_qr; ?>">ご予約・無料カウンセリング</a></li>
                </ul>
            </nav>
            <button type="button" id="js-navButton" class="navButton" aria-controls="global-nav" aria-expanded="false">
                <span class="navButton_line">
                    メニューを開閉する
                </span>
            </button>
        </div>
        <?php get_template_part('inc/inc-gNav'); ?>
    </header>

    <?php
    global $page_title;
    $page_title = get_the_title();
    ?>

    <?php get_template_part('inc/inc-breadcrumbs'); ?>

    <main class="main top">
