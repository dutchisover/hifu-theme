<?php
$clinics = get_field('clinic', 'option');
?>

<section class="clinic wrapper">
    <h2 class="clinic_title">椿クリニック各院紹介</h2>
    <!-- 上部目次ナビ -->
    <nav class="clinic_nav">
        <ul class="clinic_nav_list">
            <?php foreach ($clinics as $clinic) { ?>
                <li class="clinic_nav_item">
                    <?php /* <!-- <a href="#anc-<?php echo $clinic["clinic_spell"]; ?>" class="clinic_nav_link"><?php echo $clinic["clinic_area"]; ?></a> --> */ ?>
                    <a href="/clinic/<?php echo $clinic['clinic_spell']; ?>" class="clinic_nav_link"><?php echo $clinic["clinic_area"]; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>

    <!-- 院紹介 -->
    <?php foreach ($clinics as $clinic) { ?>
        <section class="clinic_info" id="anc-<?php echo $clinic["clinic_spell"]; ?>">

            <div class="clinic_inner">

                <h3 class="clinic_name"><?php echo $clinic["clinic_name"]; ?></h3>

                <div class="clinic_pic clinic_box">
                    <img src="<?php echo $clinic["clinic_image"]['url']; ?>" alt="<?= $clinic['clinic_area']; ?>の医療脱毛・美肌治療は<?= $clinic['clinic_name']; ?> - 椿クリニック" class="clinic_image">
                </div>

                <div class="clinic_address clinic_box">
                    <h4 class="clinic_address_title">住所</h4>
                    <p class="clinic_address_text">〒<?php echo $clinic["clinic_zip"]; ?><br><?php echo $clinic["clinic_address"] ?></p>
                    <h4 class="clinic_address_title">最寄り駅</h4>
                    <p class="clinic_address_text"><?php echo $clinic["clinic_station"]; ?></p>
                    <h4 class="clinic_address_title">診療時間</h4>
                    <p class="clinic_address_text"><?php echo $clinic["clinic_time"]; ?><br><?php echo $clinic["clinic_holiday"] ?></p>
                </div>

                <div class="clinic_phone clinic_box">
                    <p class="clinic_freedial clinic_number">
                        <a href="tel:<?php echo $clinic["clinic_freedial"]; ?>" class="clinic_phone_link"><?php echo $clinic["clinic_freedial"]; ?></a>
                    </p>
                    <span class="clinic_phone_caution">つながりにくい場合はこちらへ</span>
                    <p class="clinic_tel clinic_number">
                        <a href="tel:<?php echo $clinic["clinic_tel"]; ?>" class="clinic_phone_link"><?php echo $clinic["clinic_tel"]; ?></a>
                    </p>
                </div>

                <div class="clinic_reserve clinic_box">
                    <a href="<?php echo $clinic["clinic_link"]['url']; ?>" class="clinic_button" target="_blank">ご予約・<br>無料カウンセリング</a>
                </div>

                <?php if ($clinic['clinic_map']) { //マップがあったとき
                ?>
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

            <div class="clinic_footer">
                <div class="clinic_dean clinic_box">
                    <p class="clinic_dean_name">院長 <?php echo $clinic["clinic_dean"] ?></p>
                </div>
                <div class="clinic_history clinic_box">
                    <?php echo $clinic["clinic_history"]; ?>
                </div>
            </div>

        </section>

        <div class="clinic_next">
            <div class="clinic_nav_item">
                <a href="/clinic/<?php echo $clinic['clinic_spell']; ?>" class="clinic_nav_link">詳しくはこちら</a>
            </div>
        </div>

    <?php } ?>
</section>
