<?php get_header(); ?>

<div class="wl-container wl-blog-index">
    <h1 class="wl-page-title wl-text-center">LATEST NEWS</h1>
    <div class="wl-blog-grid">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                ?>
                <article class="wl-blog-card">
                    <h2 class="wl-blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="wl-blog-card__excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="wl-link">Read more</a>
                </article>
                <?php
            endwhile;
            
            the_posts_pagination( array(
                'prev_text' => 'Prev',
                'next_text' => 'Next',
            ) );
            
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
