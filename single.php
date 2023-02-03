<?php
$redirect = get_field('redirect');
if ($redirect) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: {$redirect}");
    exit;
}
?>

<?php
get_header();

//施術メニューページ の場合
if (get_post_type() === 'menu') {

    echo '<section class="menu_page wrapper">';
    while (have_posts()) : the_post();

        //ページタイトル
        echo '<h2 class="menu_title section_title">' . $page_title;

        $menu_clinic_limited = get_field('menu_clinic_limited');
        $i = 0;
        if ($menu_clinic_limited) {
            echo '<span class="limited">[ ';
            foreach ($menu_clinic_limited as $value) {
                $i++;
                if ($i !== 1) {
                    echo '・';
                }
                echo $value['label'];
            }
            echo '限定 ]</span>';
        }

        echo '</h2>';


        // 緊急告知枠
        $menu_emergency = get_field('menu_emergency');
        // var_dump('緊急告知枠'.$menu_emergency);
        if ($menu_emergency) {
            echo "<div class='menu_page_emergency'>$menu_emergency</div>";
        }


        // アイキャッチ
        $main_image = get_the_post_thumbnail();
        if ($main_image) {
            $main_image_sp = get_field('menu_image_sp');
        }

        // メインコピー
        $main_copy = get_field('copy');
        $main_copy_text = $main_copy['text'];
        $main_copy_text = str_replace(array("\r\n", "\r", "\n"), '', $main_copy_text);
        $main_copy_size = $main_copy['size'];

        $main_tags = get_field('menu_tag');
        $main_tag_br = str_replace(array("\r\n", "\r", "\n", "、"), "\n", $main_tags);
        $main_tag = explode("\n", $main_tag_br);

        $main_image_url = get_the_post_thumbnail_url();
        if ($main_copy_text) {
            echo '
                <div class="menu_page_wrapper">
                    <div class="menu_page_inner wrapper">
                        <p class="menu_page_copy ' . $main_copy_size . '">' . $main_copy_text . '</p>
                        <picture>
                            <img class="menu_page_mv" src="' . $main_image_url . '" alt="' . $page_title . 'なら椿クリニック 銀座・名古屋・心斎橋">
                        </picture>
                    </div>
                </div>
                <div class="menu_page_tags">
                    <div class="menu_page_tags_inner">
                    <p class="menu_page_tags_title">こんな人におすすめ！</p>
                    <ul class="menu_page_tags_list">
            ';
            foreach ($main_tag as $item) {
                echo '<li>' . $item . '</li>';
            }
            echo '
                    </ul>
                    </div>
                </div>
            ';
        } else {
            echo '
                <div class="menu_page_image">
                    <picture>
                        <source media="(max-width:768px)" srcset="' . $main_image_sp['url'] . '">
                        <img src="' . $main_image_url . '">
                    </picture>
                </div>
                <p class="menu_page_tag pc_none">' . $main_tag . '</p>
                ';
        }

        the_content();
    endwhile;
    echo '</section>';

    get_template_part('inc/inc-fBannar');

    get_template_part('inc/inc-top-recommend');

    get_template_part('inc/inc-page-menu');
}
//お知らせ　の場合
elseif (get_post_type() === 'news') {
    echo '<section class="news wrapper">';
    while (have_posts()) : the_post();
        //日付
        echo '<time class="news_time">';
        the_date('Y.m.d');
        echo '</time>';
        //ページタイトル
        echo '<h2 class="news_title section_title">' . get_the_title() . '</h2>';
        //WordPressコンテンツ
        echo '<div class="news_content">';
        the_content();
        echo '</div>';
        //ページネーション
        echo '<div class="news_pagenation">';
        echo '<div class="news_prev">';
        previous_post_link('%link');
        echo '</div>';
        echo '<div class="news_next">';
        next_post_link('%link');
        echo '</div>';
    endwhile;
    echo '</section>';

    get_template_part('inc/inc-top-recommend');
}
//LP　の場合
elseif (get_post_type() === 'lp') {
    echo '<section class="lp_page menu_page wrapper">';
    while (have_posts()) : the_post();
        //ページタイトル
        //echo '<h2 class="menu_title section_title">' . get_the_title() . '</h2>';
        the_content();
    endwhile;
    echo '</section>';

    get_template_part('inc/inc-top-recommend');
}
//それ以外の固定ページの出力
else {
    while (have_posts()) : the_post();
        the_content();
    endwhile;
}

get_footer();
