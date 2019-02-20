<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to bloggers_comment() which is
 * located in the functions.php file.
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php
	if ( have_comments() ) :
		?>
		<div class="comments-block">
			<h2 class="comments-title">
				<?php
				$com_count = ( get_comments_number() == 1 ) ? esc_html__( 'One', 'bloggers-lite' ) : get_comments_number();
				echo esc_html($com_count).' ';
				$text = _n( 'thought on', 'thoughts on', get_comments_number(), 'bloggers-lite' );
                                printf('%s',$text);
				echo ' <span>' . get_the_title() . '</span>';
				?>
			</h2>
			<ol class="commentlist">
				<?php
				wp_list_comments( array( 'avatar_size' => 68 ) );
				?>
			</ol><!-- .commentlist -->
		</div>
		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			// are there comments to navigate through.
			?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'bloggers-lite' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( '&larr; ' . esc_html__( 'Older Comments', 'bloggers-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'bloggers-lite' ) . ' &rarr;' ); ?></div>
			</nav>
			<?php
		endif; // check for comment navigation.
		?>

		<?php
		/**
		 * If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) :
			?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'bloggers-lite' ); ?></p>
			<?php
		endif;

	endif; // end have_comments().

	comment_form();
	?>

</div><!-- #comments .comments-area -->
