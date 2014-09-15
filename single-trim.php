<?php
	$POST_ID = $_POST['post_id'];
	$QUERY_VAR = 'p='.$POST_ID;
	require('../../../wp-blog-header.php');
	query_posts($QUERY_VAR);
	the_post();
?>

<!--<div class="grid-item x2" id="post-<?php the_ID(); ?>">-->

    <div id="single-top">

    	<!-- Title -->

    	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h1>

    	

		<div class="single-post-meta">
		<span class="single-post-detail">
		<?php the_time( get_option('date_format') ); ?>. Filed under <?php the_category(', ') ?>. <?php edit_post_link(__("Edit This"), '(', ')'); ?>
		</span>
		<span class="single-post-btns">
			<span class="btn-comment"><?php comments_popup_link('Leave comment'); ?></span> | <span class="buttonMode btn-close-single">Close</span>
		</span>

		</div>

	</div><!-- end single-top -->
	<div class="single-middle"></div>
		<?php the_content('Read the rest of this entry &raquo;'); ?>
	<div class="grid-bottom-x2"></div>

<!--</div>--><!-- end of grid-item -->



<!-- Portfolio description -->

<?php //portfolioDes() 
?>



<!-- Comment Section -->		

<?php //comments_template(); 
?>