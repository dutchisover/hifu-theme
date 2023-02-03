<?php

get_header();

$parent_id = $post->post_parent;
$parent_slug = get_post($parent_id)->post_name;

//椿クリニックとは の場合
if (is_page('style')) {
    get_template_part('inc/inc-page-style');
}
//おすすめプラン の場合

//施術メニュー の場合
elseif (is_page('menu')) {
    get_template_part('inc/inc-page-menu');
}
//料金表 の場合
elseif (is_page('price')) {
    get_template_part('inc/inc-page-price');
}
//料金表 の場合
elseif (is_page('price2')) {
    get_template_part('inc/inc-page-price');
}
//クリニック紹介 の場合
elseif (is_page('clinics')) {
    get_template_part('inc/inc-page-clinics');
}
//クリニック紹介の各院ページ の場合
elseif ($parent_slug == 'clinics') {
    get_template_part('inc/inc-page-clinic-child');
}
//未成年の方へ の場合
elseif (is_page('minority') || is_page('medical_loan')) {
    get_template_part('inc/inc-page-minority');
}

//監修医ご紹介 の場合
elseif (is_page('doctor')) {
    get_template_part('inc/inc-page-doctor');
}

//それ以外の固定ページの出力
else {
    while (have_posts()) : the_post();
        the_content();
    endwhile;
}

get_footer();
