<?php
get_header();

echo '<article class="column">';

while (have_posts()) : the_post();
    //データ取得変数
    $get_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $outline = get_field('outline');
    $title = get_the_title();
    $terms = get_the_terms($post->ID, 'column_category');
    // var_dump($terms[0]->term_id);
    $page_cat_id = $terms[0]->term_id;
    $category = $terms[0];
    $date = get_the_date('Y.m.d');
    $post_id = $post->ID;

    $mv = get_the_post_thumbnail();
    if (!$mv) {
        $mv = '<img class="template" src="' . get_template_directory_uri() . '/image/column_template.jpg" alt="">';
    }

    $terms = get_the_terms($post->ID, 'doctor_category');
    $doctor = $terms[0];
    $doctor_id = $doctor->term_id;
    $term_set = 'doctor_category_' . $doctor_id;
    $doctor_name = $doctor->name;
    $doctor_post = get_field('doctor_post', $term_set);
    $doctor_clinic = get_field('doctor_clinic', $term_set);
    $doctor_image = get_field('doctor_image', $term_set);
    $doctor_image_url = $doctor_image['small']['url'];
    $doctor_message = get_field('doctor_message', $term_set);
    $cat_page = $category->name;

    if ($cat_page) {
        $cat_html = '<span class="column_category">' . $cat_page . '</span>';
    }
    else {
        $cat_html = '';
    }

    //タイトル
    echo '
        ' . $cat_html . '
        <h1 class="column_title">
            <span class="column_title_text">
            ' . $title . '
            </span>
            <span class="column_date">
            <em>最終更新日：</em>
            ' . $date . '
            </span>
        </h1>
    ';

    //キャッチ画像
    echo '
        <div class="column_mv">
            ' . $mv . '
        </div>
    ';

    //導入文
    if ($outline['copy'] || $outline['text']) {
        echo '
            <section class="column_outline">
                <div class="copy">
                ' . $outline['copy'] . '
                </div>
                <div class="text">
                ' . $outline['text'] . '
                </div>
            </section>
        ';
    }

    //SNS
    echo '
        <div class="column_sns">
            <ul class="column_sns_list">
                <li class="column_sns_item">
                    <a href="https://twitter.com/share?url=' . $get_url . '&via=tsubaki_clinic&related=tsubaki_clinic&hashtags=椿クリニック&
                    text=' . $title . '"
                    rel="nofollow"
                    target="_blank"
                    class="column_sns_link twitter"
                    ><i class="fab fa-twitter"></i>Twitter</a>
                </li>
                <li class="column_sns_item">
                    <a href="https://social-plugins.line.me/lineit/share?url=' . $get_url . '" target="_blank" class="column_sns_link line"><i class="fab fa-line"></i>LINE</a>
                </li>
                <li class="column_sns_item">
                    <a href="http://www.facebook.com/share.php?u=' . $get_url . '" class="column_sns_link facebook" target="_blank"><i class="fab fa-facebook-square"></i>Facebook</a>
                </li>
            </ul>
        </div>
    ';

    //本文
    echo '<section class="column_letter">';

    the_content();

    echo '</section>';


    //タグ一覧を表示
    $taxonomy = 'column_tag';
    $tags = get_the_terms($post->ID, $taxonomy);
    if ($tags) {
        echo '<ul class="column_tag">';

        foreach ($tags as $tag) {
            $tag_name = esc_html($tag->name);
            $tag_link = get_term_link($tag->slug, $tag->taxonomy);
            echo '
                <li class="column_tag_item">
                    <a href="' . $tag_link . '" class="column_tag_link">
                        ' . $tag_name . '
                    </a>
                </li>
            ';
        }

        echo '</ul>';
    }


    //一覧ページへのボタン表示ロジック
    $taxonomy = 'column_category';
    global $line_qr;

    $cat = get_the_terms($post->ID, $taxonomy);
    $cat_data = $cat[0];
    $cat_id = $cat_data->term_id;
    $cat_name = $cat_data->name;
    $cat_slug = $cat_data->slug;
    $cat_description = $cat_data->description;

    $term_idsp = $taxonomy . "_" . $cat_id;
    $button_link = get_field('button_link', $term_idsp);
    $button_text = get_field('button_text', $term_idsp);
    $button_blank = "";

    $cta = get_field('cta');

    if ($cta['text']) {
        $button_text = $cta['text'];
    }

    if ($cta['link']) {
        if ($cta['link']['url']) {
            $button_link = $cta['link']['url'];
        }

        if ($cta['link']['target']) {
            $button_blank = 'target="' . $cta['link']['target'] . '"';
        }
    }


    //var_dump($button_text);

    echo '
        <div class="column_bannar">
    ';

    if ($button_text) {
        echo '<a class="column_button" href="' . $button_link . '" ' . $button_blank . '>' . $button_text . '</a>';
    }

    echo do_shortcode('[counseling]');
	

    //記事フッター
    echo '<div class="column_footer">';

    //監修医師
    if ($doctor_name) {
        echo '
            <section class="column_doctors">
                <div class="left">
                    <h2 class="doctors_title">この美容医療コラムを監修した医師</h2>
                    <p class="doctors_name">' . $doctor_name . '</p>
                    <p class="doctors_post">' . $doctor_post . '</p>
                    <p class="doctors_clinic">' . $doctor_clinic . '</p>
                </div>
                <div class="right">
                    <img src="' . $doctor_image_url . '" alt="">
                </div>
                <div class="bottom">
                    ' . $doctor_message['short'] . '
                    <a href="/doctor/" class="column_doctor_link">プロフィールをみる</a>
                </div>
            </section>
        ';
    }

    //SNS
    echo '
        <div class="column_sns">
            <ul class="column_sns_list">
                <li class="column_sns_item">
                    <a href="https://twitter.com/share?url=' . $get_url . '&via=tsubaki_clinic&related=tsubaki_clinic&hashtags=椿クリニック&
                    text=' . $title . '"
                    rel="nofollow"
                    target="_blank"
                    class="column_sns_link twitter"
                    ><i class="fab fa-twitter"></i>Twitter</a>
                </li>
                <li class="column_sns_item">
                    <a href="https://social-plugins.line.me/lineit/share?url=' . $get_url . '" target="_blank" class="column_sns_link line"><i class="fab fa-line"></i>LINE</a>
                </li>
                <li class="column_sns_item">
                    <a href="http://www.facebook.com/share.php?u=' . $get_url . '" class="column_sns_link facebook" target="_blank"><i class="fab fa-facebook-square"></i>Facebook</a>
                </li>
            </ul>
        </div>
    ';
    echo '</div>';

endwhile;

//あわせて読みたい記事
if ($page_cat_id) {
    $terms = get_terms('column_category');
    $i = 0;
    $tax_posts = get_posts(
        array(
            'exclude' => $post->ID,
            'post_type' => 'column',
            'posts_per_page' => 5,
            'tax_query' => array(
                array(
                    'taxonomy' => 'column_category',
                    'terms' => $page_cat_id,
                    'field' => 'id',
                )
            )
        )
    );

    if ($tax_posts) {
        echo
        '
            <section class="column_recommend">
                <h2 class="title">あわせて読みたい記事</h2>
                <ul class="column_recommend_list column_list">
        ';

        foreach ($tax_posts as $tax_post) {
            //カテゴリー（タクソノミー）の取得
            $cat = get_the_taxonomies($tax_post->ID);
            $cat_tag = str_replace('コラムカテゴリー:', '', $cat["column_category"]);
            $cat_str = str_replace('。', '', $cat_tag);
            $cat_name = strip_tags($cat_str, '');
            if ($cat_name) {
                $cat_name_html = '<span class="column_category">' . esc_html($cat_name) . '</span>';
            }

            $tax_date = esc_html($tax_post->post_date_gmt);
            $tax_date = mysql2date('Y.m.d', $tax_date);
            $tax_title = get_the_title($tax_post->ID);

            $mv = get_the_post_thumbnail($tax_post->ID, 'small');
            if (!$mv) {
                $mv = '<img class="template" src="' . get_template_directory_uri() . '/image/column_template.jpg" alt="">';
            }

            $tax_id = $tax_post->ID;
            $tax_cat = get_the_terms($tax_id, 'column_category');
            $tax_cat_id = $tax_cat[0]->term_id;
            echo '
                <li>
                    <a href="' . get_permalink($tax_post->ID) . '">
                        <div class="left">
                            <time class="column_date">
                            <em>最終更新日：</em>
                            ' . $tax_date . '
                            </time>
                            ' . $cat_name_html . '
                            <p class="column_list_title">
                            ' . $tax_title . '
                            </p>
                        </div>
                        <div class="right">
                            ' . $mv . '
                        </div>
                    </a>
                </li>
            ';
        }
        wp_reset_postdata();
    }

    echo
    '
            </ul>
        </section>
    ';
}


echo '</article>';

get_footer();
