<?php global $line_qr; ?>

<!-- 各院紹介 -->
<section class="top_clinic">
    <?php get_template_part('inc/inc-breadcrumbs'); ?>

    <?php
    if (is_page()) {
        get_template_part('inc/inc-fBannar');
    }
    ?>

    <!-- <h2 class="top_clinic_title section_title">各院紹介</h2> -->

    <h2 class="rich_title" id="clinic_info">
        <span>各院紹介</span>
    </h2>
    <ul class="top_clinic_list wrapper">
        <?php
        $top_clinic = get_field('clinic', 'option');
        if ($top_clinic) {
            foreach ($top_clinic as $clinic) {
                // altテキスト生成
                $alt_text = "";
                if ($clinic['clinic_name'] === "椿クリニック審美矯正歯科") {
                    $alt_text = "大阪・心斎橋のマウスピース矯正・ホワイトニング専門審美歯科";
                }
                else {
                    $alt_text = "医療脱毛と美肌治療 椿クリニック " . $clinic['clinic_name'];
                }

                echo '
                    <li class="top_clinic_item">
                        <h3 class="top_clinic_area">' . $clinic['clinic_area'] . '</h3>
                        <div class="top_clinic_info">
                            <h4 class="top_clinic_name">' . $clinic['clinic_name'] . '</h4>
                            <a class="top_clinic_freedial" href="tel:' . $clinic['clinic_freedial'] . '">' . $clinic['clinic_freedial'] . '</a>
                            <a class="top_clinic_tel" href="tel:' . $clinic['clinic_tel'] . '">' . $clinic['clinic_tel'] . '</a>
                            <address class="top_clinic_address">' . $clinic['clinic_address'] . '</address>
                            <address class="top_clinic_station">' . $clinic['clinic_station'] . '</address>
                        </div>
                        <div class="top_clinic_thumb">
                            <img src="' . $clinic['clinic_thumb']['url'] . '" alt="' . $alt_text . '" class="top_clinic_image">
                        </div>
                        <div class="top_clinic_next">
                            <a href="/clinics/' . $clinic['clinic_spell'] . '" class="top_clinic_link">詳細はこちら</a>
                        </div>
                    </li>
                    ';
            }
        }
        ?>
    </ul>
</section>

</main>

<footer class="footer">
    <?php get_template_part('inc/inc-fNav'); ?>

    <h2 class="footer_title">施術メニュー</h2>

    <?php
    wp_nav_menu(array(
        'theme_location' => 'fMenu',
        'container'       => 'div',
        'menu_class'      => 'fMenu',
    ));
    ?>

    <small class="footer_copyright">© 椿クリニック 東京銀座・大阪心斎橋・愛知名古屋 . All Rights Reserved.</small>
    <div class="cv_area">
        <?php /*
        <p class="cv_area_text">お急ぎの方はお電話でご予約をお願いいたします。</p>
        <a class="cv_area_button" href="#clinic_info"><i class="fas fa-phone-alt"></i>電話予約</a>
        <a class="cv_area_button" href="<?= $line_qr; ?>" target="_blank"><i class="fas fa-envelope"></i>Web予約</a>
        */ ?>
        <p class="cv_area_text">お急ぎの方はお電話でご予約をお願いいたします。</p>
        <a class="cv_area_button cv_area_button-price" href="/price/">
            <div class="cv_area_icon"></div>
            料金表
        </a>
        <a class="cv_area_button cv_area_button-line" href="<?= $line_qr; ?>" target="_blank">
            <div class="cv_area_icon"></div>
            LINE予約
        </a>
        <a class="cv_area_button cv_area_button-tel" href="#clinic_info">
            <div class="cv_area_icon"></div>
            電話予約
        </a>
    </div>
    <button class="return_button" id="js-top_return"></button>
</footer>

<?php get_template_part('inc/inc-script'); ?>

<?php wp_footer(); ?>
</body>

</html>
