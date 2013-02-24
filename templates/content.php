<?php if (!have_posts()) : ?>
	<div class="alert">
		<?php _e('Sorry, no results were found.', 'roots'); ?>
	</div>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'roots' ); ?>
		</div>
		<?php endif; ?>
	    <header class="entry-header">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'roots' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php get_template_part('templates/entry-meta'); ?>
	    </header><!-- .entry-header -->
	    <div class="entry-summary">
			<?php the_post_thumbnail(); ?>
			<?php the_excerpt(); ?>
	    </div>
	    <footer class="entry-meta clearfix">
			<?php the_tags('<i class="icon-tags" title="' . __('Tags', 'roots') . '"></i> ', ', ', ''); ?>
	    </footer>
	</article>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
	<nav class="post-nav">
	    <ul class="pager">
			<?php if (get_next_posts_link()) : ?>
		        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
			<?php endif; ?>
			<?php if (get_previous_posts_link()) : ?>
		        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
			<?php endif; ?>
	    </ul>
	</nav>
<?php endif; ?>
