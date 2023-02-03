<?php get_header(); ?>


<!-- カルーセル -->
<div class="top_slick wrapper">
	<ul class="slick_list">
		<?php
		$top_carousel = get_field('top_carousel', 'option');
		foreach ($top_carousel as $slide) {
			// var_dump($slide);
			echo
			'<li class="slick_item">
					<a class="slick_link" href="' . $slide['top_carousel_link']['url'] . '" target="' . $slide['top_carousel_link']['target'] . '">
						<picture>
							<source media="(max-width:768px)" srcset="' . $slide['top_carousel_image_sp']['url'] . '">
							<img class="slick_image" src="' . $slide['top_carousel_image']['url'] . '" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン『' . $slide['top_carousel_title'] . '』">
						</picture>
					</a>
				</li>';
		}
		// <img class="slick_image sp_none" src="' . $slide['top_carousel_image']['url'] . '">
		//                 <img class="slick_image pc_none" src="' . $slide['top_carousel_image_sp']['url'] . '">
		?>
	</ul>
</div>


<!-- ニュース（縦スクロール） -->
<section class="top_news wrapper">
	<h2 class="top_news_title section_title"><a href="/news">News</a></h2>
	<div class="top_news_container">
		<?php
		global $post;
		$args = array(
			'posts_per_page' => 4,
			'post_type' => 'news'
		);
		$myposts = get_posts($args);
		foreach ($myposts as $post) {
			setup_postdata($post);
		?>
			<a href="<?php the_permalink(); ?>" class="top_news_link">
				<dl class='top_news_list'>
					<dt class='top_news_date'><?php the_date('Y.m.d'); ?></dt>
					<dd class='top_news_text'><?php the_title(); ?></dd>
				</dl>
			</a>
		<?php
		}
		wp_reset_postdata();
		?>
	</div>
</section>



<!-- レコメンド -->
<?php
$recommend_depi = get_field('top_plan_depi', 'option');
$recommend_skin = get_field('top_plan_skin', 'option');
$recommend_diet = get_field('top_plan_diet', 'option');
function reco_li($recommend)
{
	foreach ($recommend as $key => $value) {
		if ($value) {
			// var_dump($value);
			$link = $value['top_plan_link']['url'];
			$target = $value['top_plan_link']['target'] ? 'target="' . $value['top_plan_link']['target'] . '"' : "";

			if (array_key_exists('top_plan_image', $value)) {
?>
				<div class="top_recommend_box">
					<a class="top_recommend_link" href="<?= $link; ?>" target="<?= $target; ?>">
						<img class="top_recommend_image" src="<?= $value['top_plan_image']['url']; ?>" alt="医療脱毛と美肌治療なら椿クリニック
銀座院・名古屋院・心斎橋院 おすすめプラン 『<?= $value['top_plan_title']; ?>』">
						<div class="top_recommend_buttonarea">
							<span class="rich_button">詳しく見る</span>
						</div>
					</a>
				</div>
<?php
			}
		}
	}
}
?>
<div class="top_recommend">
	<h2 class="rich_title">
		<strong>Recommend</strong>
		<span>おすすめプラン</span>
	</h2>

	<div class="top_recommend_content">
		<?php
		reco_li($recommend_depi);
		reco_li($recommend_skin);
		reco_li($recommend_diet);
		?>
	</div>
</div>


<!-- お悩みからさがす -->
<section class="top_care">
	<div class="wrapper-min">
		<h2 class="rich_title">
			<strong>Skin & Body Care</strong>
			<span>お悩みからさがす</span>
		</h2>

		<div class="top_care_main">
			<div class="wrapper-min">
				<div class="top_care_container">
					<div class="top_care_box">
						<h3 class="rich_subtitle">
							<span>Medical laser hair removal</span>
							医療レーザー脱毛
						</h3>
						<p class="top_care_text">自分の悩みに合わせて<br>豊富なプランから選べます。
						</p>
						<a href="/menu/depi/" class="rich_button">詳しく見る</a>
					</div>

					<div class="top_care_photo">
						<img src="<?= get_template_directory_uri(); ?>/image/rich/top_care_01.jpg" alt="医療レーザー脱毛なら椿クリニック 銀座・名古屋・心斎橋" class="top_care_image">
					</div>
				</div>

				<div class="top_care_container">
					<div class="top_care_box">
						<h3 class="rich_subtitle">
							<span>Skin treatments</span>
							美肌・美白治療
						</h3>
						<p class="top_care_text">しみ・そばかす・肝斑を薄くしたい。<br>くすみのない明るい肌に。
						</p>
						<a href="/menu/skin/" class="rich_button">詳しく見る</a>
					</div>

					<div class="top_care_photo">
						<img src="<?= get_template_directory_uri(); ?>/image/rich/top_care_02.jpg" alt="美肌・美白治療なら椿クリニック 銀座・名古屋・心斎橋" class="top_care_image">
					</div>
				</div>
			</div>
		</div>

		<ul class="top_care_list">
			<li class="top_care_item">
				<div class="top_care_item_inner">
					<h3 class="rich_subtitle">毛穴・ニキビ治療</h3>
					<p class="top_care_text">年齢による皮膚のたるみなどで<br>開いた毛穴が気になる方へ。</p>
				</div>
				<a href="/menu/pores/" class="rich_button">詳しく見る</a>
			</li>

			<li class="top_care_item">
				<div class="top_care_item_inner">
					<h3 class="rich_subtitle">たるみ・<br>エイジングケア治療</h3>
					<p class="top_care_text">眉間・額・目じりの細かいシワや<br>表情ジワが気になる方へ。</p>
				</div>
				<a href="/menu/age/" class="rich_button">詳しく見る</a>
			</li>

			<li class="top_care_item">
				<div class="top_care_item_inner">
					<h3 class="rich_subtitle">メディカルダイエット</h3>
					<p class="top_care_text">脂肪や筋肉の張りなど<br>気になる部分を<br>「医療技術」で整えます。</p>
				</div>
				<a href="/menu/diet/" class="rich_button">詳しく見る</a>
			</li>

			<li class="top_care_item">
				<div class="top_care_item_inner">
					<h3 class="rich_subtitle">そのほかの施術</h3>
					<p class="top_care_text">わきボトックス、<br>ピアスの穴あけなど<br>クリニックの施術だから安心です。</p>
				</div>
				<a href="/menu/others/" class="rich_button">詳しく見る</a>
			</li>
		</ul>
	</div>
</section>


<!-- 施術からさがす -->
<section class="top_menu wrapper-min">
	<h2 class="rich_title">
		<strong>Treatment Menu</strong>
		<span>施術からさがす</span>
	</h2>

	<div class="top_menu_container">
		<?php get_template_part('inc/inc-page-menu'); ?>
	</div>
</section>


<!-- 椿クオリティとは -->
<section class="top_quality">
	<!-- <h2 class="top_quality_title section_title">椿クオリティとは</h2> -->
	<h2 class="rich_title">
		<strong>Quality</strong>
		<span>椿クオリティとは</span>
	</h2>

	<div class="top_quality_inner">
		<p class="top_quality_message"><span>全ては患者様の笑顔のために。</span><br><span>患者様第一主義。</span></p>
		<p class="top_quality_message-sub">椿クリニックでは患者様を笑顔で迎え、<br>笑顔で帰っていただくことをモットーに、<strong class="font-strong">おもてなしの心で美容医療に取り組んでおります。</strong></p>
	</div>

	<a class="top_quality_button" href="/style/">椿クリニックが選ばれる理由<span class="font-small">詳しくはこちら</span></a>
</section>


<!-- ご予約はこちらから -->
<?php
$clinics = get_field('clinic', 'option');
global $line_qr;
?>
<section class="top_reserve">
	<div class="wrapper-min">
		<h2 class="top_reserve_web">
			<a href="<?= $line_qr; ?>" class="top_reserve_button" target="_blank">ご予約はこちらから<span class="top_reserve_button-sub">カウンセリングは無料です</span></a>
		</h2>

		<div class="top_reserve_tel">
			<h3 class="top_reserve_tel_title">お電話のかた</h3>
			<dl class="top_reserve_tel_list">
				<?php foreach ($clinics as $clinic) { ?>
					<div class="top_reserve_tel_item">
						<dt class="top_reserve_tel_name"><?php echo $clinic["clinic_area"]; ?></dt>
						<dd class="top_reserve_tel_number"><a href="tel:<?php echo $clinic["clinic_freedial"]; ?>" class="top_reserve_tel_link"><?php echo $clinic["clinic_freedial"]; ?></a></dd>
					</div>
				<?php } ?>
				<div class="top_reserve_tel_time">受付時間　11:00～20:00</div>
			</dl>
		</div>
	</div>
</section>


<div class="top_topix">
	<!-- トピックス -->
	<?php
	$top_topix = get_field('top_topix', 'option');
	if ($top_topix) {
		$i = 0;
		foreach ($top_topix as $topix) {
			$i++;
			$top_link = $topix['top_link'];
			$top_popup = $topix['top_popup'];
			if ($top_link) {
				echo '
			<div class="sub_topix">
				<a href="' . $top_link['url'] . '"><span>' . $top_link['title'] . '</span></a>
			</div>
			';
			} elseif ($top_popup) {
				//var_dump($top_popup);
				if ($top_popup['top_popup_check']) {
					echo '
					 <label class="sub_topix" for="">
						<span class="sub_topix_text">' . $top_popup['top_popup_text'] . '</span>
					</label>
					<div class="message_box opener">' . $top_popup['top_popup_content'] . '</div>
				';
				} else {
					echo '
					<label class="sub_topix" for="message_box' . $i . '">
						<span class="sub_topix_text">' . $top_popup['top_popup_text'] . '</span>
						<input type="checkbox" name="message_box" id="message_box' . $i . '">
						<div class="message_box">' . $top_popup['top_popup_content'] . '</div>
					</label>
				';
				}
			}
		}
	}
	?>
</div>


<?php
/*
<!-- <div class="special_bannar wrapper-min">
	<a href="/lp/depi/transfer/" class="special_bannar_link" target="_blank">
		<img src="/wp/wp-content/uploads/2020/08/norikae_main_pc.jpg" alt="">
	</a>
</div> -->
*/
?>



<!-- お知らせ -->
<section class="top_notice wrapper-min">
	<h2 class="rich_title">
		<strong>News</strong>
		<span>お知らせ</span>
	</h2>

	<div class="top_notice_container">
		<?php
		global $post;
		$args = array(
			'posts_per_page' => 3,
			'post_type' => 'news'
		);
		$myposts = get_posts($args);
		foreach ($myposts as $post) {
			setup_postdata($post);
		?>
			<a href="<?php the_permalink(); ?>" class="top_notice_link">
				<dl class='top_notice_list'>
					<dt class='top_notice_date'><?php the_date('Y.n.j'); ?></dt>
					<dd class='top_notice_text'><?php the_title(); ?></dd>
				</dl>
			</a>
		<?php
		}
		wp_reset_postdata();
		?>
	</div>

	<a href="/news/" class="rich_button-secondry">お知らせ一覧</a>
</section>

<?php //get_template_part('inc/inc-top-recommend');
?>

<?php get_footer(); ?>
