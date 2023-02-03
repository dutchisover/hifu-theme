<?php

if (is_page('menu')) {
    echo '
    <div class="menu wrapper">
        <h2 class="menu_title section_title">施術メニュー</h2>
        <div class="menu_container">
    ';
}
elseif (is_front_page()) {

}
else {
    echo '<div class="menu_footer menu_container wrapper">';
}

//カテゴリー取得
$menu_tax_list = get_terms('menus_category');

//ループ
foreach ($menu_tax_list as $tax) {
    if ($tax->parent === 0) {
        $tax_id = $tax->term_id;
        $tax_name = $tax->name;
        $tax_slug = $tax->slug;
        echo '
            <section class="menu_cat">
            <h3 class="menu_cat_title">' . $tax_name . '</h3>
            <ul class="menu_cat_list">';

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
                    <a href="/menu/' . $tax_slug . '">' . $tax_name . 'の選び方</a>
                </li>
            ';
                $i++;
            }

            //ページリンク
            $title = get_the_title();
            $title = preg_replace('/\（.+?\）/', '', $title);
            echo '
                <li class="menu_cat_item">
                    <a class="menu_cat_link" href="/menu/' . $tax_slug . '/' . $post->post_name . '">'
                . $title . '
                    </a>
                </li>
            ';
        }
        echo '</ul>
        </section>';
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
