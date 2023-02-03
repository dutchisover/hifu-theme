<?php global $line_qr; ?>

<div class="fBannar">
    <ul class="fBannar_list wrapper">
        <li class="fBannar_item">
            <a href="/lp/" class="fBannar_link">
                <img src="<?php echo get_template_directory_uri(); ?>/image/btn_recommend.png" alt="椿クリニック おすすめプラン" class="fBannar_image">
            </a>
        </li>
        <li class="fBannar_item">
            <a href="/menu/" class="fBannar_link">
                <img src="<?php echo get_template_directory_uri(); ?>/image/btn_menu.png" alt="全ての施術メニュー" class="fBannar_image">
            </a>
        </li>
        <li class="fBannar_item">
            <a href="<?= $line_qr; ?>" class="fBannar_link" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/image/btn_contact.png" alt="ご予約・無料カウンセリング" class="fBannar_image">
            </a>
        </li>
    </ul>
</div>
