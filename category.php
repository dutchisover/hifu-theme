<?php get_header(); ?>

<?php
$taxonomy_name = 'menu_type';
$category = get_queried_object();
$cat_name = $category->name;
$cat_slug = $category->slug;
$cat_id = $category->cat_ID;
$term_names = array();
$term_desc = array();
$term_ids = array();
$tax_posts = array();
$term_images = array();
$terms = get_terms($taxonomy_name);
foreach ($terms as $term) {
    //var_dump($term);
    $term_ids[] = 'category_' . $term->term_id;
    $term_names[] = $term->name;
    $term_slugs[] = $term->slug;
    $term_desc[] =  $term->description;
    $term_images[] = get_field("menu_type_image", 'category_' . $term->term_id);
    $tax_posts[] = get_posts(array(
        'post_type' => get_post_type(), 'taxonomy' => $taxonomy_name,
        'term' => $term->slug,
        'orderby' => 'menu_order'
    ));
}
?>

<div class="menu wrapper">
    <h2 class="menu_title section_title"><?php echo $cat_name; ?>メニュー</h2>
</div>

<?php
//上部ナビの出力
echo "<ul>";
$i = 0;
foreach ($term_names as $term_name) {
    echo '<li><a href="#' . $term_slugs[$i] . '">' . $term_name . '</a></li>';
    $i++;
}
echo "</ul>";

$i = 0;
foreach ($term_names as $term_name) {
    //カテゴリー別の見出し画像出力
    echo '<h2><img src="' . $term_images[$i]['url'] . '" alt="' . $term_name . '"></h2>';

    //記事ループ
    foreach ($tax_posts[$i] as $tax_post) {
        //var_dump($tax_post);
        echo
            '<div>
            <h3>' . $tax_post->post_title . '</h3>
            <a href="' . $tax_post->post_name . '">詳しくはこちら</a>';

        echo $tax_post->ID;
        $tax_field = "menus_category" . "_" . $tax_post->ID;
        echo $tax_field;
        echo get_field('menu_description', $tax_field);
        echo '</div>';
    }
    $i++;
}
?>


<?php
$args = array(
    'post_type' => 'menu',
    'category_name' => $cat_slug,
    'posts_per_page' => -1,
);
$the_query = new WP_Query($args);
if ($the_query->have_posts()) :
    while ($the_query->have_posts()) : $the_query->the_post();
?>
        <!-- <h2 class="h2Style03"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
        </div>-->

<?php endwhile;
endif; ?>

<pre>
<?php
//var_dump($term_ids);
?>
</pre>

<?php get_footer(); ?>
