<?php get_header(); ?>

<?php
//現在のカスタム投稿の情報取得
$term_parent = get_term_by('name', single_cat_title('', false), 'menus_category');
if ($term_parent) {
	$term_id = $term_parent->term_id;
	$term_name = $term_parent->name;
	$term_slug = $term_parent->slug;
}

$slug = get_post_type_object(get_post_type());

//おすすめプランの一覧ページ の場合
if ($slug->name === "lp") {
	get_template_part('inc/inc-page-plan');
}
//お知らせの一覧ページ の場合
elseif ($slug->name === "news") {

	$args = array(
		'post_type' => array('news'),
		'orderby' => 'date',
		'order' => 'DESC'
	);
	$my_posts = get_posts($args);

	echo '
		<div class="news wrapper">
			<h2 class="news_heading">' . $slug->label . '</h2>
			<ul class="news_list">
	';
	foreach ($my_posts as $post) {
		setup_postdata($post);
		$post_url = get_permalink($post->ID);
		$post_time = get_the_time('Y.m.d');
		$post_title = get_the_title($post->ID);

		echo '
			<li class="news_item">
				<a href="' . $post_url . '" class="news_link">
					<span class="news_time">' . $post_time . '</span>
					' . $post_title . '
				</a>
			</li>
		';
	}
	echo '
			</ul>
	';

	wp_pagenavi();

	echo '
		</div>
	';

	echo "<pre>";
	//var_dump($slug);
	echo "</pre>";
}
//脱毛プランのトップページ の場合
elseif ($term_slug === "depi") {
	echo '<div class="menu menu_page wrapper">';
	$page_id = get_page_by_path('depi-top');
	$page = get_post($page_id);

	echo '<h2 class="menu_title section_title">' . $page->post_title . '</h2>';

	echo $page->post_content;

	echo '</div>';

	get_template_part('inc/inc-fBannar');

	get_template_part('inc/inc-top-recommend');
}

// コラムのタグ一覧
elseif ($slug->name === "column") {

	$term_parent = get_term_by('name', single_cat_title('', false), 'column_tag');
	//var_dump($term_parent->slug);

	echo '<div class="column menu">';

	echo '<h2 class="column_title column_menu_title">タグ：' . $term_parent->name . '　一覧</h2>';

	echo '<div class="" style="margin-top: 80px;"></div>';

	echo '<div class="column_mBody">';

	echo '<div class="column_wrapper show">';

	//カテゴリー一覧取得
	$tax_posts = get_posts(
		array(
			'post_type' => 'column',
			'posts_per_page' => 6,
			'paged' => get_query_var('paged'),
			'taxonomy' => 'column_tag',
			'term' => $term_parent->slug,
		)
	);

	if ($tax_posts) {

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

			if (has_post_thumbnail()) {
				$mv = get_the_post_thumbnail($tax_post->ID, 'small');
			} else {
				$mv = '<img src="" alt="">';
			}
			echo '
				<li>
					<a href="' . get_permalink($tax_post->ID) . '">
						<div class="left">
							<time class="column_date">
							<em>最終更新日：</em>
							' . $tax_date . '
							</time>
							<span class="column_category">
								' . esc_html($cat_name) . '
							</span>
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
	}

	if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	}

	echo '</div>';
}

//脱毛以外のプラン一覧ページの場合
else {
?>

	<div class="menu menu_arc wrapper">
		<h2 class="menu_title section_title"><?php echo $term_name; ?>メニュー</h2>


		<?php
		//所属するカスタムタクソノミーの情報取得
		$menu_tax_list = get_terms('menus_category');

		//上部ナビボタン
		echo '<ul class="menu_arc_list">';
		foreach ($menu_tax_list as $tax) {
			$tax_parent_id = $tax->parent;
			$tax_name = $tax->name;
			$tax_slug = $tax->slug;
			if ($tax_parent_id === $term_id) {
				echo
				'<li class="menu_arc_item">
					<a href="#' . $tax_slug . '" class="menu_arc_link">
					' . $tax_name . '
					</a>
				</li>
			';
			}
		}
		echo '</ul>';

		//各カテゴリー別出力
		foreach ($menu_tax_list as $tax) {
			$tax_parent_id = $tax->parent;
			$tax_name = $tax->name;
			$tax_slug = $tax->slug;
			if ($tax_parent_id === $term_id) {
				$tax_cat = 'menus_category_' . $tax->term_id;
				$tax_image = get_field('menus_category_image', $tax_cat);
				$tax_image_sp = get_field('menus_category_image_sp', $tax_cat);
				$tax_description = category_description($tax->term_id);
				//画像出力
				echo '
			<div class="menu_arc_section" id="' . $tax_slug . '">
				<div class="menu_arc_picture">
					<picture>
						<source media="(max-width:768px)" srcset="' . $tax_image_sp['url'] . '">
						<img src="' . $tax_image['url'] . '">
					</picture>
				</div>

				<div class="menu_arc_description">' . $tax_description . '</div>
			';
				//各記事リンク出力
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
				echo '<ul class="menu_arc_post_list">';
				foreach ($tax_posts as $post) {
					setup_postdata($post);
					$title = get_the_title();
					$title = preg_replace('/\（.+?\）/', '', $title);
					$desc = get_field('menu_description');
					$link = $post->post_name;
					$menu_clinic_limited = get_field('menu_clinic_limited');
					$limited = '';
					if ($menu_clinic_limited) {
						$j = 0;
						foreach ($menu_clinic_limited as $value) {
							$j++;
							if ($j !== 1) {
								$limited = $limited . '・';
							}
							$limited = $limited . $value['label'];
						}
						$limited = '<span class="limited">- ' . $limited . '限定 -</span>';
					}
					echo '
					<li class="menu_arc_post_item">
						<h3 class="menu_arc_post_title">' . $title . '</h3>
						' . $limited . '
						<p class="menu_arc_post_desc">' . $desc . '</p>
						<a href="./' . $link . '" class="menu_arc_post_link">詳しくはこちら</a>
					</li>
				';
				}
				echo '
				</ul>
			</div>
			';
			}
		}
		?>
	</div>
<?php
}
?>



<?php get_footer(); ?>
