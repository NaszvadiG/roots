<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
	    <header id="post-<?php the_ID(); ?>" class="entry-header page-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
	    </header>
	    <div class="entry-content">
			<?php the_content(); ?>
	    </div>
	    <footer class="clearfix">
			<?php bootstrap_link_pages(); ?>
			<?php get_template_part('templates/entry-meta'); ?>
	    </footer>
		<?php comments_template('/templates/comments.php'); ?>
	</article>
<?php endwhile; ?>
