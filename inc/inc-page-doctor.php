<?php

echo '<section class="doctor column">';

echo '<h2 class="doctor_title column_title">' . get_the_title() . '</h2>';

$doctor_category = 'doctor_category';
$taxonomys = get_terms($doctor_category);
if (!is_wp_error($taxonomys) && count($taxonomys)) {
    if (count($taxonomys) > 1) {
        echo '
        <nav class="doctor_nav">
            <ul class="doctor_nav_list">
    ';
        $i = 0;

        foreach ($taxonomys as $tax) {
            $i++;
            $term_id = esc_html($tax->term_id);
            $term_set = $doctor_category . "_" . $term_id;

            $doctor_name = $tax->name;

            $doctor_clinic = get_field('doctor_clinic', $term_set);

            $doctor_image = get_field('doctor_image', $term_set);
            $doctor_image_url = $doctor_image['small']['url'];

            echo '
            <li class="doctor_nav_item">
                <a class="doctor_nav_link" href="#anc-' . $i . '">
                    <img class="doctor_nav_image" src="' . $doctor_image_url . '" alt="">
                    <span class="doctor_nav_data">' . $doctor_clinic . '</span>
                    <p class="doctor_nav_name">' . $doctor_name . '</p>
                </a>
            </li>
        ';
        }
        echo '
            </ul>
        </nav>
    ';
    }

    echo '<article class="doctor_main">';
    $i = 0;
    foreach ($taxonomys as $tax) {
        $i++;

        $term_id = esc_html($tax->term_id);
        $term_set = $doctor_category . "_" . $term_id;

        $doctor_image = get_field('doctor_image', $term_set);
        $doctor_image_url = $doctor_image['large']['url'];

        $doctor_copy = get_field('doctor_copy', $term_set);

        $doctor_name = $tax->name;

        $doctor_post = get_field('doctor_post', $term_set);

        $doctor_clinic = get_field('doctor_clinic', $term_set);

        $doctor_message = get_field('doctor_message', $term_set);
        //echo $doctor_message['long'];

        $doctor_career = get_field('doctor_career', $term_set);


        echo '
            <section class="doctor_info" id="anc-' . $i . '">
                <div class="left">
                    <img src="' . $doctor_image_url . '" alt="">
                </div>
                <div class="right">
                    <h3 class="doctor_info_title">
                        <span class="doctor_info_copy">' . $doctor_copy . '</span>
                        ' . $doctor_name . '
                    </h3>
                    <p class="doctor_info_post">' . $doctor_post . '</p>
                    <p class="doctor_info_clinic">' . $doctor_clinic . '</p>
                    <div class="doctor_info_message">' . $doctor_message['long'] . '</div>
                    <div class="doctor_info_career">
        ';
        foreach ($doctor_career as $value) {
            $doctor_career_year = $value['doctor_career_year'];
            $doctor_career_text = $value['doctor_career_text'];
            echo '
                <dl class="doctor_info_list">
                    <dt class="doctor_info_year">' . $doctor_career_year . '</dt>
                    <dd class="doctor_info_text">' . $doctor_career_text . '</dd>
                </dl>
            ';
        }
        echo '
                    </div>
                </div>
            </section>
        ';
    }
    echo '</article>';
}

echo '</section>';
