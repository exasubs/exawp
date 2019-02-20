<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-section">
		<div class="post-header">
			<?php
			$bloggers_lite_categories_list   = get_the_category_list( ', ' );
			$bloggers_lite_enable_categories = get_theme_mod( 'enable_categories', true );
			if ( $bloggers_lite_enable_categories && has_category() ) {
				?>
				<span class="category-list"><?php printf('%s',$bloggers_lite_categories_list); ?></span>
			<?php } ?>
			<h2 class="custom-header"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
			<div class="post-meta">
				<?php
				$bloggers_lite_archive_year  = get_the_time( 'Y' );
				$bloggers_lite_archive_month = get_the_time( 'm' );
				$bloggers_lite_archive_day   = get_the_time( 'd' );
				$blogger_lite_enable_date    = get_theme_mod( 'enable_date', true );
				$blogger_lite_enable_author  = get_theme_mod( 'enable_author', true );
				if ( $blogger_lite_enable_date ) {
					?>
					<a href="<?php echo esc_url(get_day_link( $bloggers_lite_archive_year, $bloggers_lite_archive_month, $bloggers_lite_archive_day )); ?>">
						<?php echo get_the_date(); ?>
					</a>
					<?php
				}
				if ( $blogger_lite_enable_author && $blogger_lite_enable_date ) {
					echo '/ ';
				}
				if ( $blogger_lite_enable_author ) {
					the_author_posts_link();
				}
				?>
			</div>
		</div>
		<div class="post-image">
			<?php
			if ( is_sticky() ) :
				?>
				<div class="featured-post" 
				<?php
				if ( ! has_post_thumbnail() ) {
					echo "style='position:relative;'"; }
?>
>
					<?php esc_html_e( 'Featured post', 'bloggers-lite' ); ?>
				</div>
				<?php
			endif;
			?>
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'full' );
				}
				?>
			</a>
		</div>
		<div class="post-entry">
			<?php the_content(); 
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bloggers-lite' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'bloggers-lite' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );?>
			
		</div>
		<?php if ( get_post_format() == 'gallery' ) { ?>
			<div class="pagination loop-pagination">
				<?php
				$defaults = array(
					'before'           => '<span class="page-links-title">' . esc_html__( 'Pages:', 'bloggers-lite' ) . '</span>',
					'after'            => '',
					'link_before'      => '<span>',
					'link_after'       => '</span>',
					'next_or_number'   => 'number',
					'separator'        => ' ',
					'nextpagelink'     => esc_html__( 'Next page', 'bloggers-lite' ),
					'previouspagelink' => esc_html__( 'Previous page', 'bloggers-lite' ),
					'pagelink'         => '%',
					'echo'             => 1,
				);

				wp_link_pages( $defaults );
				?>
			</div>
		<?php } ?>
		<?php 
		$bloggers_lite_enable_tags     = get_theme_mod( 'enable_tags', true );
		$bloggers_lite_enable_comments = get_theme_mod( 'enable_comments', true );
		if ( $bloggers_lite_enable_tags || $bloggers_lite_enable_comments ) { ?>
			<div class="post-tags">
				<?php if ( 1 == $bloggers_lite_enable_tags && has_tag() ) { ?>
					<div class="pull-left">
						<i class="fa fa-tag"></i>
						<?php 
                                                $tags = get_the_tag_list( '', ', ' );
                                                printf('%s',$tags);
                                                ?>
					</div>
				<?php } ?>
				<?php if ( 1 == $bloggers_lite_enable_comments && ( comments_open() || get_comments_number() ) ) { ?>
					<div class="pull-right all-comment">
						<?php
						$post_comment = '';
						if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
							?>
							<i class="fa fa-comment-o"></i>
							<?php comments_popup_link( esc_html__( 'Leave a comment', 'bloggers-lite' ), esc_html__( '1 Comment', 'bloggers-lite' ), '% ' . esc_html__( 'Comments', 'bloggers-lite' ) ); ?>
						<?php endif; ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</article><!-- #post -->
