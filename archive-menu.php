<?php

get_header();

echo '
    <div class="menu wrapper">
        <h2 class="menu_title section_title">施術メニュー</h2>
        <div class="menu_container">
    ';



$menu_tax_list = get_terms('menus_category');
foreach ($menu_tax_list as $tax) {
    if ($tax->parent === 0) {
        $tax_id = $tax->term_id;
        $tax_name = $tax->name;
        $tax_slug = $tax->slug;
        echo '
            <section class="menu_cat">
                <h3 class="menu_cat_title">' . $tax_name . '</h3>
                <ul class="menu_cat_list">
        ';

        $args = array(
            'post_type' => 'menu',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'menus_category',
                    'field'    => 'slug',
                    'terms'    => $tax_slug
                )
            )
        );
        $tax_posts = get_posts($args);
        $i = 0;
        foreach ($tax_posts as $post) {
            setup_postdata($post);



            if ($i === 0 && $tax_slug != "others") {
                echo '
                <li class="menu_cat_selection">
                    <a href="/menu/' . $tax_slug . '">' . $tax_name .
                    'の選び方</a>
                </li>
                ';
                $i++;
            }

            //ページリンク
            $title = get_the_title();
            $title = preg_replace('/\（.+?\）/', '', $title);
            $redirect = get_field('redirect');
            if ($redirect) {
                $link = $redirect;
                $target = ' target="_blank"';
            }
            else {
                $link = '/menu/' . $tax_slug . '/' . $post->post_name;
                $target = '';
            }
            echo '
                <li class="menu_cat_item">
                    <a class="menu_cat_link" href="' . $link . '"' . $target . '>'
                . $title . '
                        <ul class="menu_cat_tag_list">';
            //タグ取得
            $tags = get_the_terms($post->ID, 'menu_tag');
            if ($tags) {
                foreach ($tags as $tag) {
                    $tag_slug = 'menu_tag_' . $tag->term_id;
                    $tag_color = get_field('tag_color', $tag_slug);
                    $tag_category = get_field('tag_category', $tag_slug);
                    //配列かどうか、配列にidが含まれるかどうか
                    if (is_array($tag_category)) {
                        $key = in_array($tax_id, $tag_category);
                    } else {
                        $key = $tax_id === $tag_category[0];
                    }

                    if ($key) {
                        echo '
                        <li class="menu_cat_tag_item" style="background-color:' . $tag_color . '">' . $tag->name . '</li>
                        ';
                    }
                }
            }
            echo '</ul></a>';

            $menu_clinic_limited = get_field('menu_clinic_limited');
            $j = 0;
            if ($menu_clinic_limited) {
                echo '<span class="limited">※';
                foreach ($menu_clinic_limited as $value) {
                    $j++;
                    if ($j !== 1) {
                        echo '・';
                    }
                    echo $value['label'];
                }
                echo ' 限定</span>';
            }

            echo '</li>';
        }
        echo '
            </ul>
        </section>
    ';
    }
}

echo '</div></div>';

?>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>
    //js-masonryの設定
    jQuery.event.add(window, "load", function() {
        jQuery('.menu_container').masonry({ //親要素指定
            columnWidth: '.menu_cat',
            itemSelector: '.menu_cat',
            percentPosition: true,
            isAnimated: true,
            gutter: 20
        });
    });
</script>

<?php get_footer(); ?>
