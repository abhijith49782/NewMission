<?php get_header(); ?>

<div class="container">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post">
            <h1 class="post-title"><?php the_title(); ?></h1>
            
            <div class="post-meta">
                <span class="post-date"><?php echo get_the_date(); ?></span>
                <?php
                $tags = get_the_tags();
                if ($tags) {
                    echo '<span class="post-tags">';
                    foreach ($tags as $tag) {
                        echo '<a href="' . get_tag_link($tag->term_id) . '">#' . $tag->name . '</a>';
                    }
                    echo '</span>';
                }
                ?>
            </div>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>

        <!-- Navigation -->
        <div class="navigation">
            <div class="nav-links">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                
                if ($prev_post) {
                    echo '<a href="' . get_permalink($prev_post) . '" class="nav-previous">← ' . get_the_title($prev_post) . '</a>';
                }
                
                if ($next_post) {
                    echo '<a href="' . get_permalink($next_post) . '" class="nav-next">' . get_the_title($next_post) . ' →</a>';
                }
                ?>
            </div>
        </div>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>