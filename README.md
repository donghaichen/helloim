helloim
=======

heme: hello, i’m (with ajax)
Theme: hello, i’m (with ajax)
Version: 1.1 (2011.4.1)
WordPress: v2.8 +



Browser: IE7/8, Firefox3/3.5, Safari3/4, Chrome3/4
Feature: Variable grid layout, easing effect on window resizing, post thumbnail enabled, 2 post display mode, jQuery menu bar, wordpress pagination…

Version 1.1 release note
All known bugs have been removed in this version. It’s a stable release and is recommended to all users of version 1.0.

Bug fixed: Category with only one post cannot be displayed.
Bug fixed: Grid items occasionally “jump” instead of “tween” to their destinations.
Bug fixed: Posts that belong to category 70 (cat=70, if exists) were hidden from the index page. This behavior have been removed.

* for those who prefer only to update the necessary files, here’s the major changes:
function.php: function exclude_category … add_filter(‘pre_get_posts’, ‘exclude_category’); has been removed.
js/jquery.vgrid.0.1.4-mod.js: function animateTo(…) has been revised.

———

description
This theme is based on “hello, i’m” created by stephpunk. The looks of these two are almost identical, but grid items will expand on the index page to display full content in this variation. (just click on any item on my index page to see the effect.)

If it’s not your desired effect, simply go to stephpunk’s wordpress to download the original version. If you like this effect, please read the followings before downloading the theme.

considerations
1. All grid item’s are kept the same height. It’s needed to prevent the grid system from breaking when a post is expanded on the index page.

2. “Wide” post view (example here) of Steph’s theme is removed due to some technical issue…If you love the wide view, you may have to reconsider.

3. Bugs that exist in the original version may happen in this theme as well.

copyright
This theme is released under GPLv2 General Public License. You can use them for free and without any restrictions. You may modify the theme as you wish.

download
Click here to download, unzip it, and upload to /wp-content/themes/

tweaks
Change profile pic
1. Find me_profile.psd in folder “images”.
2. Drag your own image and apply the below clipping mask.
3. Save as me_profile.jpg

Change profile text
Open sidebar.php and edit the html or text as you wish.

Change menu bar categories(cat)
1. Open sidebar.php
2. Replace “/?cat=71″ with the cat id you want to display. Click here if you don’t know the cat id.
3. More details please check here.

feature image
Each post you get to choose one image as your thumbnail image to be displayed in the index page.

1. Choose one uploaded image in “Gallery”
2. Click “show” on the right side
3. Click “Use as featured image” at the bottom.
4. More details please check here.

Optionally, you can use the custom field to set the thumbnail image.
(Use this method if you need to use external images for thumbnails. *Notice: this method is supported by this theme and may not work in other themes. In that case, you will need to re-specific the thumbnail according to the theme’s instruction.)

1. Click “Enter new” in “Custom Fields”
2. type “featured_image” in the Name box.
3. type your image’s url (e.g. http://abc.com/image.jpg) in Value box
4. Click “Add custom Field”.
5. More details please check here.
* “featured_image” should appear in “Name” field after the first time you completed these steps. Next time just skip step 1 & 2, and select “featured_image” directly.

That’s pretty much it… Enjoy! :D 
Of course leave a comment if you have any problem ~
p.s. you may also take a look here to see if there’s an answer already. ;)

———

Archive
version 1.0

