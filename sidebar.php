		<div class="menu">
			<span id="cat1-title" class="cat-title buttonMode">about</span>. 
			<span id="cat2-title" class="cat-title buttonMode">cat2</span>.
			<span id="cat3-title" class="cat-title buttonMode">cat3</span>.
			<span id="cat4-title" class="cat-title buttonMode">cat4</span>.
		</div>
		
		<div id="cat1-show" class="cat-show" style="margin-top:30px">
			<img style="float: left; margin-right:30px" src="<?php bloginfo('template_directory')?>/images/me_profile.jpg" />
			<div style="float: left; width: 200px; line-height: 210%; margin-right: 30px;">
			Paragraph 1. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
			</div>

			<div style="float: left; width: 200px; line-height: 210%; margin-right: 30px;">
			Paragraph 2. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
			</div>
			
			<div style="float: left; width: 200px; line-height: 210%; margin-right: 30px;">
			Paragraph 3. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede, vulputate.
			</div>
		</div>
		
		<ul id="cat2-show" class="cat-show">
			<li class="cat-item"><a href="<?php bloginfo('siteurl') ?>/?cat=71" title="View all posts filed under cat71">Show all</a></li><?php wp_list_categories('show_count=1&hierarchical=0&title_li=&child_of=71'); ?>
		</ul>
		
		<div id="cat3-show" class="cat-show">
			add your own content here.
		</div>
		
		<div id="cat4-show" class="cat-show">
			add your own content here.
		</div>
<!-- /sidebar -->