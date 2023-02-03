<!-- おすすめプラン -->
<section class="top_plan wrapper">
    <h2 class="top_plan_title section_title">おすすめプラン</h2>
    <ul class="top_plan_list">
        <?php
        $top_plan_depi = get_field('top_plan_depi', 'option');
        if ($top_plan_depi) {
            foreach ($top_plan_depi as $plan_depi) {
                if ($plan_depi['top_plan_footer']) {
                    echo
                        '<li class="top_plan_item">
                            <a class="top_plan_link" href="' . $plan_depi['top_plan_link']['url'] . '" target="' . $plan_depi['top_plan_link']['target'] . '">
                                <img class="top_plan_image" src="' . $plan_depi['top_plan_image']['sizes']["medium_large"] . '" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン ' . $plan_depi['top_plan_title'] . '">
                            </a>
                        </li>';
                }
            }
        }
        $top_plan_skin = get_field('top_plan_skin', 'option');
        if ($top_plan_skin) {
            foreach ($top_plan_skin as $plan_skin) {
                if ($plan_skin['top_plan_footer']) {
                    echo
                        '<li class="top_plan_item">
                                <a class="top_plan_link" href="' . $plan_skin['top_plan_link']['url'] . '" target="' . $plan_skin['top_plan_link']['target'] . '">
                                    <img class="top_plan_image" src="' . $plan_skin['top_plan_images']['sizes']["medium_large"] . '" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン ' . $plan_skin['top_plan_title'] . '">
                                </a>
                            </li>';
                }
            }
        }
        $top_plan_diet = get_field('top_plan_diet', 'option');
        if ($top_plan_diet) {
            foreach ($top_plan_diet as $plan) {
                if ($plan['top_plan_footer']) {
                    echo
                        '<li class="top_plan_item">
                                <a class="top_plan_link" href="' . $plan['top_plan_link']['url'] . '" target="' . $plan['top_plan_link']['target'] . '">
                                    <img class="top_plan_image" src="' . $plan['top_plan_image']['sizes']["medium_large"] . '" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン ' . $plan_diet['top_plan_title'] . '">
                                </a>
                            </li>';
                }
            }
        }
        ?>
    </ul>
</section>
