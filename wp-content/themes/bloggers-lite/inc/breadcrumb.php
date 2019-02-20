<?php
/**
 * Display Breadcrumb.
 *
 * @package Bloggers Lite
 * @since Bloggers Lite 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Function to display breadcrumb
 */
function bloggers_lite_breadcrumb() {
	global $post,$wp_query;
	$separator = ' &vert; ';

	$home_link         = home_url();
	$pageid            = $wp_query->get_queried_object_id();
	$bread_style       = '';
	$breadcrumbs_color = get_post_meta( $pageid, 'qode_page_breadcrumbs_color', true );
	if ( '' != $breadcrumbs_color ) {
		$bread_style = " style='color:" . esc_html( $breadcrumbs_color ) . "';";
	}
	$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter    = '<span class="delimiter"' . esc_html( $bread_style ) . '> ' . $separator . ' </span>'; // delimiter between crumbs.
	$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show.
	$before       = '<span class="current text-uppercase"' . esc_html( $bread_style ) . '>'; // tag before the current crumb.
	$after        = '</span>'; // tag after the current crumb.

	if ( is_home() && ! is_front_page() ) {
		$title = get_the_title( $pageid );
		echo '<div class="breadcrumbs"><div class="breadcrumbs_inner"><a' . esc_html( $bread_style ) . ' href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'bloggers-lite' ) . '</a>' . $delimiter . ' <a' . esc_html( $bread_style ) . ' href="' . esc_url( $home_link ) . '">' . esc_html( $title ) . '</a></div></div>';
	} elseif ( is_home() ) {

		if ( 1 == $show_on_home ) {
			echo '<div class="breadcrumbs"><div class="breadcrumbs_inner"><a' . esc_html( $bread_style ) . ' href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'bloggers-lite' ) . '</a></div></div>';
		}
	} elseif ( is_front_page() ) {

		if ( 1 == $show_on_home ) {
			echo '<div class="breadcrumbs"><div class="breadcrumbs_inner"><a' . esc_html( $bread_style ) . ' href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'bloggers-lite' ) . '</a></div></div>';
		}
	} else {
		echo '<div class="breadcrumbs"><div class="breadcrumbs_inner"><a' . esc_html( $bread_style ) . ' href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'bloggers-lite' ) . '</a>' . $delimiter;

		if ( is_category() ) {
			$this_cat   = get_category( get_query_var( 'cat' ), false );
			$cat_title  = single_cat_title( '', false );
			$cat_parent = $this_cat->parent;
			if ( $cat_parent != 0 ) {
				echo get_category_parents( $cat_parent, true, ' ' . $delimiter );
			}
			echo $before . esc_html( $cat_title ) . $after;
		} elseif ( is_search() ) {
			$search_query = get_search_query();
			echo $before . esc_html__( 'Search results for', 'bloggers-lite' ) . ' "' . $search_query . '"' . $after;
		} elseif ( is_day() ) {
			echo '<a' . esc_html( $bread_style ) . ' href="' . esc_url(get_year_link( get_the_time( 'Y' ) )) . '">' . get_the_time( 'Y' ) . '</a>' . $delimiter;
			echo '<a' . esc_html( $bread_style ) . ' href="' . esc_url(get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ). '">' . get_the_time( 'F' ) . '</a>' . $delimiter;
			echo $before . get_the_time( 'd' ) . $after;
		} elseif ( is_month() ) {
			echo '<a' . esc_html( $bread_style ) . ' href="' . esc_url(get_year_link( get_the_time( 'Y' ) )) . '">' . get_the_time( 'Y' ) . '</a>' . $delimiter;
			echo $before . get_the_time( 'F' ) . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;
		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug      = $post_type->rewrite;
				$title     = get_the_title();
				if ( $show_current == 1 ) {
					echo $before . $title . $after;
				}
			} else {
				$title = get_the_title();
				$cat   = get_the_category();
				$cat   = $cat[0];
				$cats  = get_category_parents( $cat, true, ' ' . $delimiter );
				if ( $show_current == 0 ) {
					$cats = preg_replace( "#^(.+)\s$delimiter\s$#", '$1', $cats );
				}
				echo $cats;
				if ( $show_current == 1 ) {
					echo $before . $title . $after;
				}
			}
		} elseif ( is_attachment() && ! $post->post_parent ) {
			$title = get_the_title();
			if ( $show_current == 1 ) {
				echo $before . $title . $after;
			}
		} elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			$cat    = get_the_category( $parent->ID );
			$title  = get_the_title();
			if ( $cat ) {
				$cat = $cat[0];
				echo get_category_parents( $cat, true, ' ' . $delimiter );
			}
			echo '<a' . esc_html( $bread_style ) . ' href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a>';
			if ( $show_current == 1 ) {
				echo $delimiter . $before . $title . $after;
			}
		} elseif ( is_page() && ! $post->post_parent ) {
			$title = get_the_title();
			if ( $show_current == 1 ) {
				echo $before . $title . $after;
			}
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			$title       = get_the_title();
			while ( $parent_id ) {
				$page          = get_post( $parent_id );
				$breadcrumbs[] = '<a' . esc_html( $bread_style ) . ' href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
				echo $breadcrumbs[ $i ];
				if ( $i != count( $breadcrumbs ) - 1 ) {
					echo ' ' . $delimiter;
				}
			}
			if ( $show_current == 1 ) {
				echo $delimiter . $before . $title . $after;
			}
		} elseif ( is_tag() ) {
			$single_title = single_tag_title( '', false );
			echo $before . esc_html__( 'Posts tagged', 'bloggers-lite' ) . ' ' . $single_title . ' ' . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo $before . esc_html__( 'Articles posted by', 'bloggers-lite' ) . ' ' . $userdata->display_name . $after;
		} elseif ( is_404() ) {
			echo $before . esc_html__( '404 Not Found', 'bloggers-lite' ) . $after;
		} elseif ( is_archive() ) {
			$archive_title = post_type_archive_title( $prefix = '', false );
			echo $before . $archive_title . $after;
		}

		echo '</div></div>';
	}
}
