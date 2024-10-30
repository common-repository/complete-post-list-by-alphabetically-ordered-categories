=== Plugin Name ===

Plugin Name: Category Post List
Plugin URI: http://www.jameswilkesdesign.co.uk/wordpress-plugin-to-display-all-posts-in-all-categories/
Description: Gives a complete list of categories and all the posts in them.
Version: 1.4
Author: James Wilkes
Author URI: http://www.jameswilkesdesign.co.uk/
License: GPL3
Contributors: James Wilkes
Tags: category, categories, posts
Requires at least: 2.9
Tested up to: 3.0.3
Stable tag: 1.4
Donate link: http://www.jameswilkesdesign.co.uk/donate/
== Description ==

A simple plugin to give a list of categories ordered alphabetically and the posts in them.

Put this tag into your posts or pages where you want the list:
[jwcatpostlist]

You can change the order the posts appear in. For example, sorted by title:
[jwcatpostlist orderby=title order=asc]

Or sorted by title (descending):
[jwcatpostlist orderby=title order=desc]

You can include or exclude categories using one of the following (note: if you use both then you'll get the ones from the include list minus any on the exclude list)
[jwcatpostlist includecats=1,2,4,5,6]
[jwcatpostlist excludecats=3,7]
Don't put any spaces between the numbers.

== Installation ==

1. Unzip the zip file and upload the "jw-catpostlist" folder into your Wordpress server's "plugins" directory.
2. Activate it from the plugins area of your admin pages.

== Screenshots ==

1. Part of a list of categories and posts under those categories. From the plugin running on my own website.

== Frequently Asked Questions ==

How do I use the plugin?

Put this tag into your posts or pages where you want the list:
[jwcatpostlist]

It accepts parameters for ordering: "orderby" (possible values "date", "modified", "title" - order posts by date created, date last modified or title) and "order" (possible values "asc" and "desc" for ascending and descending). By default it orders by date order ascending.
Examples:
[jwcatpostlist orderby=title order=asc]
[jwcatpostlist orderby=title order=desc]

It accepts parameters "includecats" and "excludecats" for including and excluding categories.
Examples:
[jwcatpostlist includecats=1,2,4,5,6]
[jwcatpostlist excludecats=3,7]
No quotes should be used around these parameters.

Example:
[jwcatpostlist orderby=title order=asc]

== Changelog ==

= 1.0 =
* Stable release

= 1.1 =
* Minor bugfix - LI tag wasn't being used correctly

= 1.2 =
* Added parameters to change sorting
* Minor bugfix - was breaking the loop slightly (in a not very noticable fashion)

= 1.3 =
* Added include, exclude options and donate link in readme.txt

= 1.4 =
* Minor bugfix: was displaying a warning in the page when error reporting was turned on.

== Upgrade Notice ==

To upgrade, deactivate and then delete old directory. Replace with new unzipped directory.

== Uninstallation ==

Just deactivate the plugin and remove the files and folder. No data is stored anywhere else and no changes are made to any other files.


