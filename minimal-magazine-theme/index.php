<?php get_header(); ?>

<div class="container">
    <!-- Tag Filter Section -->
    <div class="tag-filter">
        <h3>Filter by Category</h3>
        <div class="tag-buttons">
            <a href="<?php echo home_url(); ?>" class="tag-button <?php echo is_home() ? 'active' : ''; ?>">All Posts</a>
            <?php
            $tags = get_tags();
            if ($tags) {
                foreach ($tags as $tag) {
                    $active_class = '';
                    if (is_tag($tag->slug)) {
                        $active_class = 'active';
                    }
                    echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-button ' . $active_class . '">' . $tag->name . '</a>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Posts Loop -->
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="post">
                <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                
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
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="post-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>

        <!-- Navigation -->
        <div class="navigation">
            <div class="nav-links">
                <?php
                echo get_previous_posts_link('<span class="nav-previous">← Previous</span>');
                echo get_next_posts_link('<span class="nav-next">Next →</span>');
                ?>
            </div>
        </div>

    <?php else : ?>
        <div class="no-posts">
            <h2>No posts found</h2>
            <p>Sorry, no posts matched your criteria.</p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>