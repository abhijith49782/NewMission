<article class="post-item" id="post-<?php the_ID(); ?>">
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-featured-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="post-header">
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <div class="post-meta">
            <span class="post-date">
                <time datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date(); ?>
                </time>
            </span>
            <?php if (get_the_author()) : ?>
                <span class="post-author">
                    by <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                        <?php the_author(); ?>
                    </a>
                </span>
            <?php endif; ?>
        </div>
    </header>

    <div class="post-content">
        <div class="post-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="read-more">
            Read More
        </a>
    </div>

    <?php 
    $post_tags = get_the_tags();
    if ($post_tags) : 
    ?>
        <div class="post-tags">
            <?php foreach ($post_tags as $tag) : ?>
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                   class="tag-link"><?php echo esc_html($tag->name); ?></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</article>