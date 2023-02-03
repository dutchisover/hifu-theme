<!-- <nav class="fNav">
    <ul class="fNav_list">
        <li class="fNav_item"><a class="fNav_link" href=""></a></li>
    </ul>
</nav> -->
<?php
wp_nav_menu(array(
    'theme_location' => 'fNav',
    'container'       => 'nav',
    'menu_class'      => 'fNav',
));
?>
