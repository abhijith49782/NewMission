<?php get_header(); ?>

<div class="container">
    <div class="error-404">
        <h1>404 - Page Not Found</h1>
        <p>The page you're looking for doesn't exist.</p>
        <div class="error-navigation">
            <a href="<?php echo home_url(); ?>" class="nav-previous">← Back to Home</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>