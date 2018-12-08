=== Very Simple Meta Description ===
Contributors: Guido07111975
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=donation%40guidovanderleest%2enl
Version: 4.4
License: GNU General Public License v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Requires at least: 3.7
Tested up to: 4.9
Stable tag: trunk
Tags: simple, meta description, seo, google, bing, meta


This is a very simple plugin to add meta description in the header of your WordPress website.


== DESCRIPTION ==
= About =
This is a very simple plugin to add meta description in the header of your WordPress website.

Search engines such as Google and Bing use the meta description when listing search results.

You can also use the post and page "Excerpt" or the WooCommerce "Product short description" as meta description.

= How to use =
After installation go to Settings > Meta Description and enter a meta description of max. 320 characters.

= Extra settings =
* Use the meta description for homepage only
* Use the post and page "Excerpt" as meta description
* Use the WooCommerce "Product short description" as meta description

= Post and page excerpt =
An excerpt is a summary of your post or page content.

The excerpt is already available for posts and with this plugin it becomes available for pages as well.

While adding a post or page you can set an excerpt using the "Excerpt" box.

The "Excerpt" can be used as meta description for that post or page.

= WooCommerce =
This plugin also supports post type "products" which is used by WooCommerce.

While adding a WooCommerce product you can set an excerpt using the "Product short description" box.

The "Product short description" can be used as meta description for that product.

= Question? =
Please take a look at the FAQ section.

= Translation =
Not included but plugin supports WordPress language packs.

More [translations](https://translate.wordpress.org/projects/wp-plugins/very-simple-meta-description) are very welcome!

= Credits =
Without the WordPress codex and help from the WordPress community I was not able to develop this plugin, so: thank you!

Enjoy!


== INSTALLATION ==
Please check Description section for installation info.


== Frequently Asked Questions ==
= How do I set plugin language? =
Plugin will use the site language, set in Settings > General.

If plugin isn't translated into this language, language fallback will be English.

= Why did you set the max. amount on 320 characters? =
Otherwise your meta description might not be fully displayed in search results.

= Why use meta description for homepage only? =
Using the same meta description for all posts and pages is not SEO friendly.

= Why no excerpt box while adding a post or page? =
If these boxes are not present, they might be unchecked in Screen Options.

= Where are the Open Graph and Twitter Cards settings? =
I have removed both features in version 4.1 because they don't have much to do with a meta description.

You can remove the Open Graph and Twitter Cards settings from the database by uninstalling plugin.

If you want to keep using this plugin afterwards, please reinstall plugin again. In this case don't forget to backup your meta description before uninstal.

= Can I use this plugin with other SEO plugins? =
You should not use a plugin or theme that contains a meta description feature. This might cause a conflict.

Or at least do not activate this feature in that plugin or theme.

= How can I make a donation? =
You like my plugin and you're willing to make a donation? Nice! There's a PayPal donate link on the WordPress plugin page and my website.

= Other question or comment? =
Please open a topic in plugin forum.


== Changelog ==
= Version 4.4 =
* tagline is not used as meta description anymore
* this was used when meta description field was empty
* removed this because a tagline is too short to be used as meta description

= Version 4.3 =
* major update
* increased meta description length from 160 to 320 characters (thanks kawaiikawaii)
* why? because Google increased this length at the end of 2017
* redesigned the settingspage

= Version 4.2 =
* several small adjustments in file vsmd
* updated readme file

= Version 4.1 =
* as mentioned before: removed support for Open Graph and Twitter Cards
* new: activate post and page excerpt or product excerpt separately
* updated all files

= Version 4.0 =
* In next version I will remove support for Open Graph and Twitter Cards
* Why? Because both features don't have much to do with a meta description
* And the amount of users did not increase after adding both features
* best practice: removed closing PHP tag from most files
* best practice: added newline at end of most files

For all versions please check file changelog.


== Screenshots == 
1. Very Simple Meta Description (dashboard).
2. Very Simple Meta Description (page excerpt).
3. Very Simple Meta Description (WooCommerce product excerpt).