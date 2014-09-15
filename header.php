<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<meta name="keywords" content="">
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=700" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="Shortcut Icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" type="image/x-icon" />	

<?php 
wp_enqueue_script('jquery');
wp_head();
?>

<script src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js" type="text/javascript" charset="UTF-8"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.vgrid.0.1.4-mod.js" type="text/javascript" charset="UTF-8"></script>
<script src="http://mingthings.com/swfobject/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[

function debug(text) {
  ((window.console && console.log) ||
   (window.opera && opera.postError) ||
   window.alert).call(this, text);
}
jQuery.noConflict();

(function($){
	$(function(){
		/*--------- detect browser ----------*/
		var iphoneUser = false;
		
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
			if (document.cookie.indexOf("iphone_redirect=false") == -1) {
				iphoneUser = true;
			}
		}

		/*--------- setup page ---------*/
		var gridOption = {easeing: "easeOutQuint",
							time: 800,
							delay: 20,
							selRefGrid: "#grid-wrapper div.x1",
							selFitWidth: ["#container", "#footer"],
							gridDefWidth: 285 + 15 + 15 + 15,
							forceAnim: 1};
		var gridNoAni = {easeing: "easeOutQuint",
							time: 800,
							delay: 20,
							selRefGrid: "#grid-wrapper div.x1",
							selFitWidth: ["#container", "#footer"],
							gridDefWidth: 285 + 15 + 15 + 15,
							forceAnim: 0};
		
		if (!iphoneUser) {
			$('#header').css("visibility", "hidden");
			setTimeout(function() {$('#header').hide().css("visibility", "visible").fadeIn(500)}, 500);
			setTimeout(function() {setGrid()}, 400);
			$(window).load(function(e){
				setTimeout(function(){ 
					// prevent flicker in grid area - see also style.css
					$("#grid-wrapper").css("paddingTop", "0px");
				}, 1000);
			});
			registerMouse(".postlink");	
		} else {
			$("#grid-wrapper").vgrid(gridNoAni);
			registerTouch(".postlink");
		}
		registerCat(".cat-title");
		
		/*--------- menu bar ---------*/
		
		var lastShown = "";
		
		function registerCat(target) {
			//target is always .cat-title
			$(target).click(function() {
				var titleId = $(this).attr("id");
				var catId=titleId.substr(0, titleId.length-6);
				showNew('#'+catId+'-show');
			});	
		}
		
		function showNew(className) {
			if (lastShown == className) {
				hideLast();
			} else {
				hideLast();
				showClass(className);
			}
		}
		
		function hideLast() {
			if (lastShown == "") return;
			$(lastShown).hide("slow");
			lastShown = "";
		}
		
		function showClass(className) {
			$(className).show("slow");
			lastShown = className;
		}
		
		/*------ ajax single ------*/
		
		var loadingGif = "<?php bloginfo('template_directory')?>/images/dots32.gif";
		var phpUrl = "<?php bloginfo('template_directory')?>/single-trim.php";
		var loadingHTML = '<div class="loading"></div>';
		var lastItem = ""
		var lastItemHTML = "";
		var isTransforming = false;
		var setGrid = function(){return $("#grid-wrapper").vgrid(gridOption)};
		function reload() {
			$("#grid-wrapper").reload();
		}
		
		function refleshIndex() {
			$("#grid-wrapper").refleshPage();
			setTimeout(function(){	
				$('#grid-wrapper').reload(gridNoAni);
				scrollTo(lastItem);
			}, 1000);
			setTimeout(function(){
				isTransforming = false;
			}, 1500);
		}
		
		function loadSingle(idNum) {
			isTransforming = true;
			//new target
			var target = '#post-'+idNum;
			//store the html data of target
			var tempHTML = $(target).html();
			//hide featured image (i.e. show loading image)
			var featuredPostLink = target+'>.postlink';
			var featuredImage = target+'>.postlink img';
			
			$(target).css('z-index', 1);
			
			$(featuredPostLink).addClass('loadingGif');
			$(featuredImage).animate({opacity: 0}, 150);
			//ajax load new content
			$.ajax({url: phpUrl, data: "post_id="+idNum, type: 'POST', 
				success: function(data) {
					$(target).animate({opacity: 0}, 250, function(){
						//enlarge target to x2 width
						$(target).width(615);
						$(target).removeClass('x1').addClass('x2');
						//load data to target
						$(target).html(data);
						//show target
						$(target).clearQueue();
						$(target).delay(500).animate({opacity: 1}, 250);
						//and resize last single to x1
						if (undoLastSingle(lastItem, lastItemHTML) == false) {
							refleshIndex();
						};
						lastItem = target;
						lastItemHTML = tempHTML;
						//register close btn
						$(target+' .btn-close-single').click(function() {
							undoLastSingle(lastItem, lastItemHTML);
							lastItem="";
							lastHTML="";
						});
					})
				}
			});
		}
		
		function undoLastSingle(target, html) {
			if ((target == '') || (html == '')) {
				return false;
			}
			
			$(target).css('z-index', 0);
			//fade to transparent before resize
			$(target).animate({
				opacity: 0
			}, 250, function(){
				//resize target to x1 width
				$(target).width(285);
				$(target).removeClass('x2').addClass('x1');
				$(target).html(html);
				//set opacity back
				var img = target+'>.postlink>img';
				$(img).css('opacity', 1);
				//when restore complete, display target.
				$(target).clearQueue();
				$(target).animate({opacity: 1}, 250);
				registerMouse(target + ">.postlink");
				refleshIndex();
				//setGrid();
				//setTimeout(function(){isTransforming = false}, 800);
			});
			return true;
		}
		
		/*------ scrollTo ------*/
		
		var scrollObj = "";
		detectBrowser();
		function detectBrowser() {
			if ($.browser.webkit) {
				scrollObj = 'body';
			} else {
				scrollObj = 'html';
			}
		}
		
		function scrollTo(target) {			
			var offset = $(target).offset();
			var scrollY = offset.top - 20;
			$(scrollObj).clearQueue();
			$(scrollObj).animate({scrollTop: scrollY}, 500);
		}
		
		/*------ mouseEffect ------*/
		function registerTouch(target) {
			//target is always .postlink
			$(target).click(function() {
				var postId = $(this).parent().attr("id").substr(5);
				var url = "<?php bloginfo('home') ?>/?p="+postId;
				window.location = url;
			});	
		}
		
		function registerMouse(target) {
			//target is always .postlink
			$(target).click(function() {
				if (isTransforming) return;
				var postId = $(this).parent().attr("id");
				mouseClickEffect(postId);
			});	
			$(target).mouseover(function() {
				if (isTransforming) return;
				var postId = $(this).parent().attr("id");
				mouseOverEffect(postId);
			});
			$(target).mouseleave(function() {
				if (isTransforming) return;
				var postId = $(this).parent().attr("id");
				mouseLeaveEffect(postId);
			});
		}
		
		function mouseClickEffect(postId) {
			var idNum = postId.substr(5);
			var desc = '#'+postId+'>.postlink>.post-desc';
			$(desc).clearQueue();
			$(desc).animate({
				opacity: 0
			}, 25, function(){
				$(desc).css('display', 'none');
				loadSingle(idNum);
			});
		}
		
		function mouseOverEffect(postId) {
			var desc = '#'+postId+'>.postlink>.post-desc';
			$(desc).clearQueue();
			$(desc).css('display', 'block');
			$(desc).animate({
				opacity: 0.8
			}, 180);
		}
		
		function mouseLeaveEffect(postId) {
			var desc = '#'+postId+'>.postlink>.post-desc';
			$(desc).clearQueue();
			$(desc).animate({
				opacity: 0
			}, 180, function(){
				$(desc).css('display', 'none');
			});
		}
		
	}); // end of document ready
})(jQuery); // end of jQuery name space 

//]]>
</script>

</head>

<body <?php body_class();?>>

<noscript><p class="caution aligncenter">Enable Javascript to browse this site, please.</p></noscript>

<div id="container">
	<div id="header">
		<a href="<?php bloginfo('siteurl') ?>"><img src="<?php bloginfo('template_directory') ?>/images/header.png" /></a>
		
		<?php get_sidebar(); ?>
	</div>
