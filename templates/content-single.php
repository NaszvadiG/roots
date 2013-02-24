<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
	    <header id="post-<?php the_ID(); ?>" class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php get_template_part('templates/entry-meta'); ?>
	    </header>
	    <div class="entry-content">
			<?php the_content(); ?>
	    </div>
	    <footer class="entry-meta clearfix">
			<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
			<?php the_tags('<i class="icon-tags" title="' . __('Tags', 'roots') . '"></i> ', ', ', ''); ?>
	    </footer>
		<?php comments_template('/templates/comments.php'); ?>
	</article>
<?php endwhile; ?>
