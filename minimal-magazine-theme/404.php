<?php get_header(); ?>

<div class="container">
    <div style="text-align: center; padding: 80px 0;">
        <h1 style="font-size: 4rem; font-weight: 700; color: #333; margin-bottom: 20px;">404</h1>
        <h2 style="font-size: 1.8rem; font-weight: 600; color: #666; margin-bottom: 30px;">Page Not Found</h2>
        <p style="font-size: 1.1rem; color: #888; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
            The page you're looking for doesn't exist. It might have been moved, deleted, or you entered the wrong URL.
        </p>
        
        <div style="margin-bottom: 40px;">
            <a href="<?php echo home_url(); ?>" style="
                display: inline-block;
                background: #333;
                color: #fff;
                padding: 12px 24px;
                text-decoration: none;
                border-radius: 6px;
                font-weight: 500;
                transition: background 0.2s ease;
            " onmouseover="this.style.background='#555'" onmouseout="this.style.background='#333'">
                ← Back to Home
            </a>
        </div>
        
        <div style="max-width: 400px; margin: 0 auto;">
            <h3 style="font-size: 1.2rem; font-weight: 600; color: #333; margin-bottom: 20px;">Recent Posts</h3>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 5,
                'post_status' => 'publish'
            ));
            
            if ($recent_posts) :
            ?>
                <ul style="list-style: none; padding: 0; text-align: left;">
                    <?php foreach ($recent_posts as $post) : ?>
                        <li style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0;">
                            <a href="<?php echo get_permalink($post['ID']); ?>" style="
                                color: #333;
                                text-decoration: none;
                                font-weight: 500;
                                transition: color 0.2s ease;
                            " onmouseover="this.style.color='#666'" onmouseout="this.style.color='#333'">
                                <?php echo $post['post_title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p style="color: #888;">No recent posts available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>