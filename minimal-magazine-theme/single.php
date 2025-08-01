<?php get_header(); ?>

<div class="container">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post single-post">
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            
            <h1 class="post-title"><?php the_title(); ?></h1>
            
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
            
            <div class="post-content">
                <?php the_content(); ?>
            </div>
            
            <?php if (has_tag()) : ?>
                <div class="post-tags">
                    <strong>Tags:</strong>
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
        
        <!-- Post Navigation -->
        <div class="navigation">
            <div class="nav-links">
                <div class="nav-previous">
                    <?php previous_post_link('%link', '← %title'); ?>
                </div>
                <div class="nav-next">
                    <?php next_post_link('%link', '%title →'); ?>
                </div>
            </div>
        </div>
        
        <!-- Back to Blog -->
        <div style="text-align: center; margin: 40px 0;">
            <a href="<?php echo home_url(); ?>" style="color: #666; text-decoration: none; font-weight: 500;">
                ← Back to Blog
            </a>
        </div>
        
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>