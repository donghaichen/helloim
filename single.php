<?php get_header(); 
	
	// [grid column setting] 
	$col_w = 285; // width of grid column
	$gap_w = 45;  // padding + margin-right (15+15+15)
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
		
		<div class="grid-item x2" id="post-<?php the_ID(); ?>">
            <div id="single-top">
            	<!-- Title -->
            	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
            	
            	<div class="single-post-meta">
            	<?php the_time( get_option('date_format') ); ?>. Filed under <?php the_category(', ') ?>. <?php edit_post_link(__("Edit This"), '(', ')'); ?>
            	</div>
            </div><!-- end single-top -->
			<div class="single-middle"></div>
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			<div class="grid-bottom-x2"></div>
		</div><!-- end of grid-item -->
		
		<!-- Portfolio description -->
		<?php portfolioDes() ?>		
		
		<!-- Comment Section -->		
		<?php comments_template(); ?>

<?php endwhile; else : ?>

		<div <?php post_class('grid-item ' . $col_class); ?>>
			<h2>Not Found</h2>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<div class="grid-bottom"></div>
		</div>

<?php endif; ?>

</div><!-- /grid-wrapper -->

<?php /* reset the query */
	wp_reset_query();
?>

</div><!-- /container -->

<?php get_footer(); ?>