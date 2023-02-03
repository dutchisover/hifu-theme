<div class="plan wrapper">
    <h2 class="plan_title section_title-sub">医療レーザー脱毛</h2>
    <ul class="plan_list">
        <?php
        $top_plan_depi = get_field('top_plan_depi', 'option');
        if ($top_plan_depi) {
            foreach ($top_plan_depi as $plan_depi) {
                echo
                    '<li class="plan_item">
                        <a class="plan_link" href="' . $plan_depi['top_plan_link']['url'] . '" target="' . $plan_depi['top_plan_link']['target'] . '">
                            <img class="plan_image" src="' . $plan_depi['top_plan_image']['url'] . '" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン ' . $plan_depi['top_plan_title'] . '">
                        </a>
                    </li>';
            }
        } ?>
    </ul>

    <h2 class="plan_title section_title-sub">美肌治療</h2>
    <ul class="plan_list">
        <?php
        $top_plan_skin = get_field('top_plan_skin', 'option');
        if ($top_plan_skin) {
            foreach ($top_plan_skin as $plan_skin) {
                echo
                    '<li class="plan_item">
                        <a class="plan_link" href="' . $plan_skin['top_plan_link']['url'] . '" target="' . $plan_skin['top_plan_link']['target'] . '">
                            <img class="plan_image" src="' . $plan_skin['top_plan_images']['url'] . '" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン ' . $plan_skin['top_plan_title'] . '">
                        </a>
                    </li>';
            }
        } ?>
    </ul>

    <h2 class="plan_title section_title-sub">痩身（メディカルダイエット）</h2>
    <ul class="plan_list">
        <?php
        $top_plan_diet = get_field('top_plan_diet', 'option');
        if ($top_plan_diet) {
            foreach ($top_plan_diet as $plan_diet) {
                echo
                    '<li class="plan_item">
                        <a class="plan_link" href="' . $plan_diet['top_plan_link']['url'] . '" target="' . $plan_diet['top_plan_link']['target'] . '">
                            <img class="plan_image" src="' . $plan_diet['top_plan_images']['url'] . '" alt="医療脱毛と美肌治療なら椿クリニック 銀座院・名古屋院・心斎橋院 おすすめプラン ' . $plan_diet['top_plan_title'] . '">
                        </a>
                    </li>';
            }
        }
        ?>
    </ul>
</div>
