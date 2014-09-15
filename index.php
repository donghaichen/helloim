<?php get_header(); 
	
	// [grid column setting] 
	$col_w = 285; // width of grid column
	$gap_w = 45;  // padding + margin-right (15+15+5)
	$max_col = 2; // max column size (style div.x1 ~ xN)
	
	// * additional info *
	// check also "style.css" and "header.php" if you change $col_w and $gap_w.
	// - style.css:
	//   div.x1 ~ xN
	//   div.grid-item
	//   div.single-item
	//   ... and maybe #sidebar2 li.widget.
	// - header.php:
	//   gridDefWidth in javascript code.
	//
	// if you want to show small images in main page always, set $max_col = 1.
	
	// [grid image link setting]
	$flg_img_forcelink = true;   // add/overwrite a link which links to a single post (permalink).
	$flg_img_extract = true;    // in single post page, extract thumbnail link to an original image.
	$flg_obj_fit = 'large-fit';  // none | small-fit | large-fit ... how to fit size of object tag.
	
	// * additional info *
	// if you use image popup utility (like Lightbox) on main index, set $flg_img_forcelink = false;
?>

<div id="grid-wrapper" style="min-width:645px">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="grid-item x1" id="post-<?php the_ID(); ?>">
			<!--<a href="<?php the_permalink() ?>" class="postlink"><?php the_post_thumbnail(); ?></a><br><br>-->
			<div class="postlink buttonMode">
				<div class="post-desc"><?php echo get_featured_text() ?></div>
				<div class="featured-image"><?php echo get_featured_image(get_the_ID()) ?></div>
				<h2 class="post-title"><?php the_title(); ?></h2>
			</div>
			<div class="post-meta">
			On <?php the_time( get_option('date_format') ); ?>, with <?php comments_popup_link(); ?>
			<span class="post-cats">Filed under <?php the_category(', ') ?>. <?php edit_post_link(__("Edit This"), '(', ')'); ?></span>
			<!--<span class="post-tags"><?php //the_tags('Used ', ', '); ?></span>-->
			</div>
			<div class="grid-bottom"></div>
		</div>



<?php endwhile; else : ?>

		<div <?php post_class('grid-item ' . $col_class); ?>>
			<h2>Not Found</h2>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<div class="grid-bottom"></div>
		</div>

<?php endif; ?>

	</div><!-- /grid-wrapper -->

	<div class="pagination" id="grid-pagination">
		<?php paginate_links2($is_top_single); ?>
	</div>

<?php /* reset the query */
	wp_reset_query();
?>

</div><!-- /container -->

<?php get_footer(); ?>
