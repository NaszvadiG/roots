<div class="entry-meta">
	<i class="icon-folder-open" title="<?php echo __('Posted in', 'roots'); ?>"></i>
	<?php echo get_the_category_list( __( ', ', 'roots' ) ); ?>

	<i class="icon-time" title="<?php echo __('Posted on', 'roots'); ?>"></i>
	<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><time class="entry-date" datetime="<?php echo esc_attr( get_the_time('c') ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a>
	<i class="icon-user" title="<?php echo __('Posted by', 'roots'); ?>"></i>
	<span class="author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'roots' ), get_the_author() ) ); ?>" rel="author" class="url fn n"><?php echo get_the_author(); ?></a></span>
	<?php if ( comments_open() ) : ?>
	<i class="icon-comment" title="<?php echo __( 'Leave a reply', 'roots' ); ?>"></i>
	<span class="comments-link">
		<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'roots' ) . '</span>', __( '1 Reply', 'roots' ), __( '% Replies', 'roots' ) ); ?>
	</span><!-- .comments-link -->
	<?php endif; // comments_open() ?>
	<?php edit_post_link( __( 'Edit', 'roots' ), '<span class="edit-link"><i class="icon-pencil"></i> ', '</span>' ); ?>
</div>
