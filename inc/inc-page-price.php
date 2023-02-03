<?php global $line_qr; ?>
<section class="price wrapper">
    <h2 class="price_title section_title"><?php the_title(); ?></h2>
    <div class="price_mv">
        <div class="price_mv_pic">
            <img src="<?php echo get_template_directory_uri(); ?>/image/price_mv.png" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 料金一覧">
        </div>
    </div>
    <div class="price_payment">
        <h2 class="price_title-sub">お支払方法</h2>
        <div class="price_payment_container">
            <div class="price_payment_box">現金</div>
            <div class="price_payment_box">カード</div>
            <div class="price_payment_box">医療ローン</div>
        </div>
        <div class="price_payment_pic">
            <img src="<?php echo get_template_directory_uri(); ?>/image/logo_card.png" alt="利用可能なカード会社のロゴ" class="price_payment_image">
            <ul class="price_payment_list">
                <li class="price_payment_item">※このページの表記はすべて税込となっています</li>
                <li class="price_payment_item">※クレジットカードのご利用は￥5,000以上からです</li>
                <li class="price_payment_item">※特別価格の場合は現金のみのお支払いとなります</li>
            </ul>
        </div>
        <div class="price_payment_loan">
            <a href="/medical_loan/" class="price_payment_button">分割払い(医療ローン)について</a>
            <ul class="price_payment_list">
                <li class="price_payment_item">※施術料￥30,000以上からご利用いただけます</li>
            </ul>
        </div>
    </div>
    <div class="price_catalog">
        <h2 class="price_title-sub">料金一覧</h2>

        <div id="js-price_list"></div>

        <?php
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>

        <h4>基本料金</h4>

        <!-- <div class="price_beginner">
            <dl>
                <dt>初診料</dt>
                <dd>￥3,250<span>（税込 ￥3,575）</span></dd>
            </dl>
            <dl>
                <dt>再診料</dt>
                <dd>￥1,100<span>（税込 ￥1,210）</span></dd>
            </dl>
            <dl>
                <dt>麻酔料</dt>
                <dd>￥2,200<span>（税込 ￥2,420）</span></dd>
            </dl>
            <dl>
                <dt>処方料</dt>
                <dd>￥600<span>（税込 ￥660）</span></dd>
            </dl>
        </div> -->
        <div class="price_beginner">
            <dl>
                <dt>初診料</dt>
                <dd>￥3,575<span>（税込）</span></dd>
            </dl>
            <dl>
                <dt>再診料</dt>
                <dd>￥1,210<span>（税込）</span></dd>
            </dl>
            <dl>
                <dt>麻酔料</dt>
                <dd>￥2,420<span>（税込）</span></dd>
            </dl>
            <dl>
                <dt>処方料</dt>
                <dd>￥660<span>（税込）</span></dd>
            </dl>
        </div>

        <ul class="price_mv_list">
            <li class="price_mv_item">※予告なく価格は変更となる場合がございます</li>
            <li class="price_mv_item">※予告なく特別価格は終了する場合がございます</li>
            <li class="price_mv_item">※カウンセリング料は無料です</li>
            <li class="price_mv_item">※コース消化時の再診料は不要です</li>
            <li class="price_mv_item">※<i class="fab fa-line">LINE</i>お友だち登録で初診料が無料になります。詳しくは<a href="<?= $line_qr; ?>" class="price_mv_link" target="_blank">こちら</a>から</li>
            <li class="price_mv_item">※トライアル価格は初めての患者様が対象です</li>
        </ul>
    </div>
</section>
