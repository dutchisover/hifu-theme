<?php get_header(); ?>

<div class="column menu">

    <h2 class="column_title column_menu_title">美容医療コラム　一覧</h2>

    <?php
    //カテゴリー一覧取得
    $terms = get_terms('column_category');
    ?>

    <!-- <nav class="column_mNav">
        <ul class="column_mNav_list">
            <?php
            $i = 0;
            foreach ($terms as $value) {
                $i++;
                if ($i === 1) {
                    $show_class = ' show';
                } else {
                    $show_class = '';
                }
                echo '
                    <li class="column_mNav_item">
                        <a href="#' . $value->slug . '" class="column_mNav_link' . $show_class . '">
                            ' . $value->name . '
                        </a>
                    </li>
                ';
            }
            ?>
        </ul>
    </nav> -->

    <div class="" style="margin-top: 20px;"></div>

    <div class="column_mBody">
        <?php
        $i = 0;
        foreach ($terms as $value) {
            $i++;
            $tax_posts = get_posts(
                array(
                    'post_type' => 'column',
                    'posts_per_page' => 6,
                    'paged' => get_query_var('paged'),
                    // 'tax_query' => array(
                    //     array(
                    //         'taxonomy' => 'column_category',
                    //         'terms' => array($value->slug),
                    //         'field' => 'slug',
                    //     )
                    // )
                )
            );

            if ($tax_posts) {
                if ($i === 1) {
                    echo '<div class="column_wrapper show" id="' . $value->slug . '">';
                } else {
                    echo '<div class="column_wrapper" id="' . $value->slug . '">';
                }
                // echo '
                //     <h3 class="column_mBody_title">
                //         ' . esc_html($value->name) . '
                //     </h3>
                // ';

                echo '<ul class="column_list">';
                foreach ($tax_posts as $tax_post) {
                    setup_postdata($tax_post);
                    $tax_date = esc_html($tax_post->post_date_gmt);
                    $tax_date = mysql2date('Y.m.d', $tax_date);
                    $tax_title = get_the_title($tax_post->ID);

                    //カテゴリー（タクソノミー）の取得
                    $cat = get_the_taxonomies($tax_post->ID);
                    $cat_tag = str_replace('コラムカテゴリー:', '', $cat["column_category"]);
                    $cat_str = str_replace('。', '', $cat_tag);
                    $cat_name = strip_tags($cat_str, '');
                    if ($cat_name) {
                        $cat_html = '<span class="column_category">' . esc_html($cat_name) . '</span>';
                    }
                    else {
                        $cat_html = '';
                    }

                    $mv = get_the_post_thumbnail($tax_post->ID, 'small');
                    if (!$mv) {
                        $mv = '<img class="template" src="' . get_template_directory_uri() . '/image/column_template.jpg" alt="">';
                    }
                    echo '
                        <li>
                            <a href="' . get_permalink($tax_post->ID) . '">
                                <div class="left">
                                    <time class="column_date">
                                    <em>最終更新日：</em>
                                    ' . $tax_date . '
                                    </time>
                                    '.$cat_html.'
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

                echo '</ul></div>';

                //wp_reset_postdata();
            }
        }

        if (function_exists('wp_pagenavi')) {
            wp_pagenavi();
        }

        ?>

    </div>
</div>



<?php get_footer(); ?>
