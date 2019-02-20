<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-section' ); ?>>
	<?php
	if ( ! is_single() && ! is_search() ) {
		?>
		<div class="post-header">
			<?php
			$bloggers_lite_categories_list        = get_the_category_list( ', ' );
			$bloggers_lite_enable_categories_blog = get_theme_mod( 'enable_categories_blog', true );
			if ( $bloggers_lite_enable_categories_blog && has_category() ) {
				?>
				<span class="category-list"><?php printf('%s',$bloggers_lite_categories_list); ?></span>
			<?php } ?>
			<h2 class="custom-header"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
			<div class="post-meta">
				<?php
				$bloggers_lite_archive_year  = get_the_time( 'Y' );
				$bloggers_lite_archive_month = get_the_time( 'm' );
				$bloggers_lite_archive_day   = get_the_time( 'd' );
				$blogger_lite_enable_date    = get_theme_mod( 'enable_date_blog', true );
				$blogger_lite_enable_author  = get_theme_mod( 'enable_author_blog', true );
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
		<div class="blog-img">
			<?php
			if ( is_sticky() ) :
				?>
				<div class="featured-post" 
				<?php
				if ( ! bloggers_lite_get_video_embed_media( $post->ID ) && ! has_post_thumbnail() ) {
					echo "style='position:relative;'"; }
?>
>
					<?php esc_html_e( 'Featured post', 'bloggers-lite' ); ?>
				</div>
				<?php
			endif;
			?>
			<?php if ( bloggers_lite_get_video_embed_media( $post->ID ) ) { ?>
				<div class="post-image<?php echo ' ' . get_post_format(); ?>">
					<?php
					if ( get_post_format() == 'link' ) {
						$image_class = '';
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
							$image_class = ' post_has_image';
						}
						echo '<span class="post_format_standard' . sanitize_html_classes( $image_class ) . '"><span>';
						echo bloggers_lite_get_video_embed_media( $post->ID );
						echo '</span></span>';
					} elseif ( get_post_format() == 'quote' ) {
						$image_class = '';
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
							$image_class = ' post_has_image';
						}
						echo '<div class="post_format_standard' . sanitize_html_classes( $image_class ) . '">';
						echo bloggers_lite_get_video_embed_media( $post->ID );
						echo '</div>';
					} else {
						if ( 'audio' == get_post_format() && has_post_thumbnail() ) {
							the_post_thumbnail();
							echo '<div class="bloggers_audio">';
						}
						echo bloggers_lite_get_video_embed_media( $post->ID );
					}
					?>
				</div>
			<?php } elseif ( ! post_password_required() && has_post_thumbnail() ) { ?>
				<div class="post-image">
					<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
			<?php } ?>
		</div>
		<?php
		$bloggers_lite_read_more_text = get_theme_mod( 'blog_content_read_more_text', __( 'Continue Reading', 'bloggers-lite' ) );
		$bloggers_lite_content_from   = get_theme_mod( 'blog_page_content_from', 'from_content' );
		if ( 'from_content' == $bloggers_lite_content_from ) {
			$excerpt_length = absint(get_theme_mod( 'blog_content_length', '50' ));
			if ( $excerpt_length > 0 ) {
				?>
				<div class="post-entry-content">
					<?php bloggers_lite_blog_read_more(); ?>
				</div>
				<?php if ( $bloggers_lite_read_more_text ) { ?>
					<div class="entry-content">
						<a class="more-detail text-uppercase" href="<?php the_permalink(); ?>"><?php echo esc_html( $bloggers_lite_read_more_text ); ?> <i class="fa fa-angle-double-right"></i></a>
					</div>
					<?php
}
			}
		} if ( 'from_excerpt' == $bloggers_lite_content_from ) {
			$excerpt = get_the_excerpt();
			?>
			<div class="post-entry">  <?php printf('%s',$excerpt); ?> </div> <?php if ( $bloggers_lite_read_more_text ) { ?>
				<div class="entry-content">
					<a class="more-detail text-uppercase" href="<?php the_permalink(); ?>"><?php echo esc_html( $bloggers_lite_read_more_text ); ?> <i class="fa fa-angle-double-right"></i></a>
				</div>
				<?php
}
		}
		$bloggers_lite_enable_tags     = get_theme_mod( 'enable_tags_blog', true );
		$bloggers_lite_enable_comments = get_theme_mod( 'enable_comments_blog', true );
		if ( $bloggers_lite_enable_tags || $bloggers_lite_enable_comments ) {
			?>
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
			<?php
		}
	} elseif ( is_search() ) {
		?>
		<h2 class="custom-header">
			<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
		</h2>
		<div class="post-entry">
			<?php the_excerpt(); ?>
		</div>
		<?php
	}
?>
</article><!-- #post -->
