<?php
get_header();
?>

<main class="container">
  <div class="filter">
    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <?php
      $tags = get_tags();
      $current_tag = get_query_var( 'tag' );
      ?>
      <label for="tag-filter"><?php esc_html_e( 'Filter by tag:', 'minimal-magazine' ); ?></label>
      <select id="tag-filter" name="tag" onchange="this.form.submit()">
        <option value=""><?php esc_html_e( 'All', 'minimal-magazine' ); ?></option>
        <?php foreach ( $tags as $tag ) : ?>
          <option value="<?php echo esc_attr( $tag->slug ); ?>" <?php selected( $current_tag, $tag->slug ); ?>>
            <?php echo esc_html( $tag->name ); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <noscript>
        <button type="submit"><?php esc_html_e( 'Apply', 'minimal-magazine' ); ?></button>
      </noscript>
    </form>
  </div>

  <div class="posts">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
            </div>
          <?php endif; ?>

          <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
        </article>
      <?php endwhile; ?>

      <div class="pagination">
        <?php the_posts_pagination(); ?>
      </div>

    <?php else : ?>
      <p><?php esc_html_e( 'No posts found.', 'minimal-magazine' ); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
?>