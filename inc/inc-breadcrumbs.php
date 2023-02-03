<?php
//LPページ
if (is_single() && get_post_type() === 'lp') {
    $cat = get_the_category();
    $cat_name = get_cat_name($cat[0]->term_id);
    $cat_link = get_category_link(get_cat_ID($cat_name));
    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item"><a href="' . home_url() . '/lp/" class="breadcrumbs_link">おすすめプラン</a></li>
                <li class="breadcrumbs_item">
                    ' . get_the_title() . '
                </li>
            </ul>
        </div>
    ';
}
//おすすめプラン
if (is_post_type_archive('lp')) {
    $cat = get_the_category();
    $cat_name = get_cat_name($cat[0]->term_id);
    $cat_link = get_category_link(get_cat_ID($cat_name));
    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item">おすすめプラン</li>
            </ul>
        </div>
    ';
}
//お知らせ詳細ページ
if (is_single() && get_post_type() === 'news') {
    $cat = get_the_category();
    $cat_name = get_cat_name($cat[0]->term_id);
    $cat_link = get_category_link(get_cat_ID($cat_name));
    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item"><a href="' . home_url() . '/news/" class="breadcrumbs_link">お知らせ</a></li>
                <li class="breadcrumbs_item">
                    ' . get_the_title() . '
                </li>
            </ul>
        </div>
    ';
}
//お知らせ一覧ページ
if (is_post_type_archive('news')) {
    $cat = get_the_category();
    $cat_name = get_cat_name($cat[0]->term_id);
    $cat_link = get_category_link(get_cat_ID($cat_name));
    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item">お知らせ</li>
            </ul>
        </div>
    ';
}
//施術メニュー一覧ページ
if (is_post_type_archive('menu')) {
    $cat = get_the_category();
    if ($cat) {
        $cat_name = get_cat_name($cat[0]->term_id);
        $cat_link = get_category_link(get_cat_ID($cat_name));
    }

    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item">施術メニュー</li>
            </ul>
        </div>
    ';
}
//施術メニュー カテゴリー別ページ
if (is_archive('menu') && !is_post_type_archive('menu') && !is_post_type_archive('news') && !is_post_type_archive('column') && !is_post_type_archive('lp')) {
    $cat = get_the_category();
    $cat_name = get_cat_name($cat[0]->term_id);
    $cat_link = get_category_link(get_cat_ID($cat_name));
    $term_parent = get_term_by('name', single_cat_title('', false), 'menus_category');
    $term_name = $term_parent->name;
    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item">
                    <a href="../" class="breadcrumbs_link">
                        施術メニュー
                    </a>
                </li>
                <li class="breadcrumbs_item">' . $term_name . 'メニュー</li>
            </ul>
        </div>
    ';
}
//施術メニュー詳細ページ
if (is_single() && get_post_type() === 'menu') {
    global $page_title;
    $cat = get_the_category();

    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item"><a href="' . home_url() . '/menu/" class="breadcrumbs_link">施術メニュー</a></li>
        ';

    if ($cat) {
        $cat_name = get_cat_name($cat[0]->term_id);
        $cat_link = get_category_link(get_cat_ID($cat_name));

        if ($cat_name && $cat[0]->term_id != 16) {
            echo '
                <li class="breadcrumbs_item"><a href="../" class="breadcrumbs_link">' . $cat_name . '</a></li>
            ';
        }
    }

    echo '
                <li class="breadcrumbs_item">
                    ' . $page_title . '
                </li>
            </ul>
        </div>
    ';
}
//コラム一覧ページ
if (is_archive() && get_post_type() === 'column') {
    $cat = get_the_category();
    if ($cat) {
        $cat_name = get_cat_name($cat[0]->term_id);
        $cat_link = get_category_link(get_cat_ID($cat_name));
    }
    $term_parent = get_term_by('name', single_cat_title('', false), 'menus_category');
    if ($term_parent) {
        $term_name = $term_parent->name;
    }

    echo '
        <div class="breadcrumbs column">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item">美容医療コラム</li>
            </ul>
        </div>
    ';
}
//コラム詳細ページ
if (is_single() && get_post_type() === 'column') {
    echo '
        <div class="breadcrumbs column">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item"><a href="' . home_url() . '/column/" class="breadcrumbs_link">美容医療コラム</a></li>
        ';

    $cat = get_the_category();
    if ($cat) {
        $cat_name = get_cat_name($cat[0]->term_id);
        $cat_link = get_category_link(get_cat_ID($cat_name));

        if ($cat_name && $cat[0]->term_id != 16) {
            echo '
                <li class="breadcrumbs_item"><a href="../" class="breadcrumbs_link">' . $cat_name . '</a></li>
            ';
        }
    }

    echo '
                <li class="breadcrumbs_item">
                    ' . get_the_title() . '
                </li>
            </ul>
        </div>
    ';
}
//コラム監修医ご紹介ページ
if (is_page('doctor')) {
    $cat = get_the_category();
    $cat_name = get_cat_name($cat[0]->term_id);
    $cat_link = get_category_link(get_cat_ID($cat_name));
    echo '
        <div class="breadcrumbs column">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item"><a href="' . home_url() . '/column/" class="breadcrumbs_link">美容医療コラム</a></li>
        ';
    if ($cat_name && $cat[0]->term_id != 16) {
        echo '
                <li class="breadcrumbs_item"><a href="../" class="breadcrumbs_link">' . $cat_name . '</a></li>
            ';
    }
    echo '
                <li class="breadcrumbs_item">
                    ' . get_the_title() . '
                </li>
            </ul>
        </div>
    ';
}
//それ以外の固定ページ
elseif (is_page()) {
    echo '
        <div class="breadcrumbs wrapper">
            <ul class="breadcrumbs_list">
                <li class="breadcrumbs_item">
                    <a href="/" class="breadcrumbs_link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumbs_item">
                    ' . get_the_title() . '
                </li>
            </ul>
        </div>
    ';
}
