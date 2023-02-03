<section class="minority wrapper">
    <h2 class="minority_title section_title"><?php the_title(); ?></h2>

    <?php
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>

</section>
