<?php get_header(); ?>

<div class="container">
    <!-- Tag Filter Section -->
    <div class="tag-filter">
        <h3>Filter by Category</h3>
        <div class="tag-buttons">
            <a href="<?php echo home_url(); ?>" class="tag-button <?php echo is_home() && !is_paged() ? 'active' : ''; ?>">All Posts</a>
            <?php
            $tags = get_tags(array(
                'orderby' => 'count',
                'order' => 'DESC',
                'number' => 10
            ));
            
            if ($tags) {
                foreach ($tags as $tag) {
                    $is_active = is_tag($tag->slug) ? 'active' : '';
                    echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-button ' . $is_active . '">' . $tag->name . '</a>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Posts Feed -->
    <div class="posts-feed">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="post">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <div class="post-meta">
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                        <?php if (has_category()) : ?>
                            <span class="separator">•</span>
                            <span class="categories">
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <?php
                            $tags = get_the_tags();
                            if ($tags) {
                                foreach ($tags as $tag) {
                                    echo '<a href="' . get_tag_link($tag->term_id) . '" class="post-tag">' . $tag->name . '</a>';
                                }
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
            
            <!-- Navigation -->
            <div class="navigation">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                ));
                ?>
            </div>
            
        <?php else : ?>
            <div class="no-posts">
                <h2>No posts found</h2>
                <p>Sorry, no posts match your criteria.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>