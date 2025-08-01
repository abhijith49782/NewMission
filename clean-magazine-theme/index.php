<?php get_header(); ?>

<div class="container">
    <!-- Tag Filter Section -->
    <section class="tag-filter">
        <h2 class="filter-title">Filter by Tag:</h2>
        <ul class="tag-list">
            <li class="tag-item">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="tag-link clear-filter <?php echo (!is_tag()) ? 'active' : ''; ?>">
                    All Posts
                </a>
            </li>
            <?php
            $tags = clean_magazine_get_all_tags();
            if ($tags) :
                $current_tag = get_queried_object();
                foreach ($tags as $tag) :
                    $active_class = (is_tag() && $current_tag->slug === $tag->slug) ? 'active' : '';
            ?>
            <li class="tag-item">
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                   class="tag-link <?php echo $active_class; ?>" 
                   data-tag="<?php echo esc_attr($tag->slug); ?>">
                    <?php echo esc_html($tag->name); ?>
                    <span class="tag-count">(<?php echo $tag->count; ?>)</span>
                </a>
            </li>
            <?php 
                endforeach;
            endif; 
            ?>
        </ul>
    </section>

    <!-- Posts Feed -->
    <section class="posts-feed" id="posts-container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
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
            <?php endwhile; ?>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '&laquo; Previous',
                    'next_text' => 'Next &raquo;',
                ));
                ?>
            </div>

        <?php else : ?>
            <div class="no-posts">
                <h2>No posts found</h2>
                <p>Sorry, no posts were found. Please try a different tag or check back later.</p>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php get_footer(); ?>