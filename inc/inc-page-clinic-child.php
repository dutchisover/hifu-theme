<?php
$clinics = get_field('clinic', 'option');

$slug = $post->post_name;
$title = get_the_title();
if (strpos($title, '銀座') !== false) {
    $title = $title . "（東京）";
}
?>


	
    <!-- 院紹介 -->
    <?php foreach ($clinics as $clinic) { ?>
        <?php if ($slug === $clinic["clinic_spell"]) { ?>

			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">

			<h1 class="clinic_title"><?php echo $clinic["clinic_name"] ?></h1>
			<section class="clinic wrapper">

			<div class="clinic_catch_block">
			<h1><?php echo $clinic["clinic_catch"] ?></h1>
			<p><?php echo $clinic["clinic_pr"] ?></p>
		</div>
	
            <section class="clinic_info" id="anc-<?php echo $clinic["clinic_spell"]; ?>">

					<?php
                    	$banner = $clinic['recommend'];
                    	if ($banner['main']['link']) {
                    ?>
					
                    <div class="clinic_banner"><h2 class="clinic_subtitle"><?php echo $clinic["clinic_name"] ?>の<br class="br-sp">おすすめ施術</h2>

                        <?php
                        $banner_main_name = $clinic['recommend']['main']['name'];
                        $banner_main_link = $clinic['recommend']['main']['link'];
                        $banner_main_image = $clinic['recommend']['main']['images']['url'];
                        $banner_sub1_name = $clinic['recommend']['sub1']['name'];
                        $banner_sub1_link = $clinic['recommend']['sub1']['link'];
                        $banner_sub1_image = $clinic['recommend']['sub1']['images']['url'];
                        $banner_sub2_name = $clinic['recommend']['sub2']['name'];
                        $banner_sub2_link = $clinic['recommend']['sub2']['link'];
                        $banner_sub2_image = $clinic['recommend']['sub2']['images']['url'];
                        ?>

                        <div class="clinic_banner_main">
                            <a href="<?= $banner_main_link; ?>" class="clinic_banner_link" target="_blank" rel="noopener noreferrer">
                                <img src="<?= $banner_main_image; ?>" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン <?= $banner_main_name; ?>" class="clinic_banner_image">
                            </a>
                        </div>

                        <div class="clinic_banner_sub">
                            <a href="<?= $banner_sub1_link; ?>" class="clinic_banner_link" target="_blank" rel="noopener noreferrer">
                                <img src="<?= $banner_sub1_image; ?>" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン <?= $banner_sub1_name; ?>" class="clinic_banner_image">
                            </a>

                            <a href="<?= $banner_sub2_link; ?>" class="clinic_banner_link" target="_blank" rel="noopener noreferrer">
                                <img src="<?= $banner_sub2_image; ?>" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン <?= $banner_sub2_name; ?>" class="clinic_banner_image">
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                <div class="clinic_inner">
					<h4 class="clinic_subtitle">お知らせ</h4>
							<div class="clinic_newsblock"><?php echo $clinic["clinic_news"]; ?></div>
					
                    <h4 class="clinic_subtitle">医院情報</h4>

                        <?php if ($clinic['clinic_youtube_pr']) { //動画があった時
                    ?>
						<div class="clinic_pr_video">
							<?php echo $clinic["clinic_youtube_pr"]; ?>
						</div>
                    <?php } ?>
					
					<div class="clinic_box_wrapper">
					
                    <div class="clinic_pic clinic_box">
                        <img src="<?php echo $clinic["clinic_image"]['url']; ?>" alt="<?= $clinic['clinic_area']; ?>の医療脱毛・美肌治療は<?= $clinic['clinic_name']; ?> - 椿クリニック" class="clinic_image">
						
						       <div class="clinic_room">
                        <?php
                        $clinic_rooms = $clinic["clinic_room"];
                        foreach ($clinic_rooms as $clinic_room) {
                        ?>
                            <dl class="clinic_room_list">
                                <dt class="clinic_room_name"><?php echo $clinic_room['clinic_room_name']; ?></dt>
                                <dd class="clinic_room_image"><img src="<?php echo $clinic_room["clinic_room_image"]["url"]; ?>" alt="<?= $clinic_room['clinic_room_name'] . ' - ' . $clinic['clinic_area']; ?>の医療脱毛・美肌治療は<?= $clinic['clinic_name']; ?> - 椿クリニック"></dd>
                            </dl>
                        <?php } ?>
                    	  </div>
						
                    </div>

                    <div class="clinic_address clinic_box">
                        <h4 class="clinic_address_title">住所</h4>
                        <p class="clinic_address_text">〒<?php echo $clinic["clinic_zip"]; ?><br><?php echo $clinic["clinic_address"] ?></p>
                        <h4 class="clinic_address_title">最寄り駅</h4>
                        <p class="clinic_address_text"><?php echo $clinic["clinic_station"]; ?></p>
                        <h4 class="clinic_address_title">診療時間</h4>
                        <p class="clinic_address_text"><?php echo $clinic["clinic_time"]; ?><br><?php echo $clinic["clinic_holiday"] ?></p><h4 class="clinic_address_title">電話番号</h4>
									<div class="clinic_phone clinic_box">
										<p class="clinic_freedial clinic_number">
											<a href="tel:<?php echo $clinic["clinic_freedial"]; ?>" class="clinic_phone_link"><?php echo $clinic["clinic_freedial"]; ?></a>
										</p>
										<span class="clinic_phone_caution">つながりにくい場合はこちらへ</span>
										<p class="clinic_tel clinic_number">
											<a href="tel:<?php echo $clinic["clinic_tel"]; ?>" class="clinic_phone_link"><?php echo $clinic["clinic_tel"]; ?></a>
										</p>
									</div>
                    </div>

					</div>

                    <div class="clinic_reserve">
                        <a href="<?php echo $clinic["clinic_link"]['url']; ?>" class="clinic_button" target="_blank">ご予約・無料カウンセリング</a>
                    </div>

					        <h4 class="clinic_subtitle">院長紹介</h4>
							<div class="clinic_footer">
								<div class="clinic_dean clinic_box">
									

                                <?php if ($clinic['clinic_dean_photo']) { //院長写真があった時
                    ?>
						<img src="<?php echo $clinic["clinic_dean_photo"]['url']; ?>" alt="<?php echo $clinic["clinic_dean"] ?>">
                    <?php } ?>
									
									
									<p class="clinic_dean_name">院長 <?php echo $clinic["clinic_dean"] ?></p>
								</div>
								<div class="clinic_history clinic_box">
									<?php echo $clinic["clinic_history"]; ?>
								</div>
							</div>
					
                    <?php if ($clinic['clinic_map']) { //マップがあったとき
                    ?>
						<h4 class="clinic_subtitle">アクセス</h4>
                        <div class="clinic_map">
                            地図
                            <?php
                            // 緯度
                            $gmap_lat = $clinic['clinic_map']['clinic_map_lat'];
                            // 経度
                            $gmap_lng  = $clinic['clinic_map']['clinic_map_lng'];
                            $gmap_name = $clinic['clinic_map']['clinic_map_name'];
                            if (!$gmap_name) {
                                $gmap_name = $clinic["clinic_name"];
                            }
                            echo $gmap_name;
                            ?>
                            <iframe src="https://maps.google.co.jp/maps?ll=<?php echo $gmap_lat; ?>,<?php echo $gmap_lng; ?>&q=<?php echo $gmap_name; ?>&output=embed&t=m&z=14" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    <?php } ?>
					
						<h4 class="clinic_subtitle">最寄駅からの道案内</h4>
						<p class="clinic_route_guide"><?php echo $clinic["clinic_route_guide"] ?></p>

                        <?php if ($clinic['clinic_youtube']) { //動画があった時
                    ?>
						<div class="clinic_route_video">
							<?php echo $clinic["clinic_youtube"]; ?>
						</div>
                    <?php } ?>

                    <?php if ($clinic['clinic_route']) { //道順説明（画像＋テキスト）があったとき
                    ?>

					                  <ol class="clinic_route">
                        <?php
													  $clinic_routes = $clinic["clinic_route"];
													  foreach ($clinic_routes as $clinic_route) {
                        ?>
											<li>
												<img src="<?php echo $clinic_route["clinic_route_img"]["url"]; ?>" alt="<?php echo $clinic_route['clinic_route_text']; ?>">
												<p><?php echo $clinic_route['clinic_route_text']; ?></p>
											</li>
                        <?php } ?>
					    </ol>					
                    <?php } ?>
					
                </div>


                <div class="clinic_menu">
                    <h4 class="clinic_subtitle">施術からさがす</h4>

                    <?php get_template_part('inc/inc-page-menu'); ?>
                </div>
				
				<div class="clinic_reserve">
					<a href="<?php echo $clinic["clinic_link"]['url']; ?>" class="clinic_button" target="_blank">ご予約・無料カウンセリング</a>
				</div>
				
            </section>
        <?php } ?>
    <?php } ?>
	
</section>
