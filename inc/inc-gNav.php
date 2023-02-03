<!-- <nav class="gNav">
    <ul class="gNav_list">
        <li class="gNav_item"><a class="gNav_link" href=""></a></li>
    </ul>
</nav> -->
<?php
wp_nav_menu(array(
    'theme_location' => 'gNav',
    'container'       => 'nav',
    'menu_class'      => 'gNav wrapper',
));
?>
