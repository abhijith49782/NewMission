<?php get_header(); ?>

<div class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-post" id="post-<?php the_ID(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <header class="post-header">
                    <h1 class="post-title"><?php the_title(); ?></h1>

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
                    <?php the_content(); ?>
                </div>

                <?php 
                $post_tags = get_the_tags();
                if ($post_tags) : 
                ?>
                    <div class="post-tags">
                        <strong>Tags:</strong>
                        <?php foreach ($post_tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                               class="tag-link"><?php echo esc_html($tag->name); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <nav class="post-navigation">
                    <div class="nav-previous">
                        <?php previous_post_link('%link', '&laquo; %title'); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link('%link', '%title &raquo;'); ?>
                    </div>
                </nav>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>

    <div class="back-to-blog">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="read-more">
            &laquo; Back to Blog
        </a>
    </div>
</div>

<?php get_footer(); ?>