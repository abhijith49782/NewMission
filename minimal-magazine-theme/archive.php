<?php get_header(); ?>

<div class="container">
    <!-- Archive Header -->
    <div class="archive-header" style="text-align: center; margin-bottom: 40px; padding: 40px 0; border-bottom: 1px solid #f0f0f0;">
        <h1 class="archive-title">
            <?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                the_author();
            } elseif (is_date()) {
                if (is_year()) {
                    echo get_the_date('Y');
                } elseif (is_month()) {
                    echo get_the_date('F Y');
                } else {
                    echo get_the_date();
                }
            } else {
                _e('Archives', 'minimal-magazine');
            }
            ?>
        </h1>
        
        <?php
        $description = '';
        if (is_category()) {
            $description = category_description();
        } elseif (is_tag()) {
            $description = tag_description();
        }
        
        if ($description) :
        ?>
            <div class="archive-description" style="margin-top: 15px; color: #666; font-size: 1.1rem;">
                <?php echo $description; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Tag Filter Section -->
    <div class="tag-filter">
        <h3>Filter by Category</h3>
        <div class="tag-buttons">
            <a href="<?php echo home_url(); ?>" class="tag-button">All Posts</a>
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
                <p><a href="<?php echo home_url(); ?>" style="color: #666; text-decoration: none;">← Back to Blog</a></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>