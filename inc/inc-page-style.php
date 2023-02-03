<?php
echo '<div class="style wrapper">';
while (have_posts()) : the_post();
    the_content();
endwhile;
echo '</div>';
