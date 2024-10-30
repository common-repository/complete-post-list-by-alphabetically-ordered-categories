<?php
/*
Plugin Name: Category Post List
Plugin URI: http://www.jameswilkesdesign.co.uk/wordpress-plugin-to-display-all-posts-in-all-categories/
Description: Gives a complete list of categories and all the posts in them.
Version: 1.4
Author: James Wilkes
Author URI: http://www.jameswilkesdesign.co.uk/
License: GPL3

Copyright (c) 2010 James Wilkes http://www.jameswilkesdesign.co.uk/

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

function jameswilkes_catpostlist_content_handler ($content) {
	$tag = "[jwcatpostlist";
	$closetag = "]";

	$i = -1 + stripos("x" . $content, $tag);
	if ($i >= 0) {
		$j = -1 + stripos("x" . $content, $closetag, $i + strlen($tag));

		if ($j >= 0) {
			$before = substr($content, 0, $i);
			$after = substr($content, $j + strlen($closetag), strlen($content) - $j - strlen($closetag));

			$tagcontent = substr($content, $i + 1, $j - $i - strlen($closetag));

			$categorylist = array();
			$postlist = array();

			$orderby = "date";
			$order = "asc";

			$orderby_accepted_values = array('date', 'modified', 'title');
			$order_accepted_values = array('asc', 'desc');
			$params = explode(" ", strtolower($tagcontent));

			$gotincludecats = false;
			$includecats = array();
			$excludecats = array();
			foreach ($params as $param) {
				$name = "";
				$value = "";
				if (strpos($param, "=") > 0) {
					$name = substr($param, 0, strpos($param, "="));
					$value = substr($param, strpos($param, "=") + 1);
				}
				if ($name == "orderby") {
					if (in_array($value, $orderby_accepted_values)) {
						$orderby = $value;
					}
				} else if ($name == "order") {
					if (in_array($value, $order_accepted_values)) {
						$order = $value;
					}
				} else if ($name == "includecats") {
					$includecats = explode(",", $value);
					$gotincludecats = true;
				} else if ($name == "excludecats") {
					$excludecats = explode(",", $value);
				}
			}

			$posts = get_posts("orderby=" . $orderby . "&order=" . $order . "&numberposts=9999");
			foreach ($posts as $post) {
				$postname = get_the_title($post->ID);
				$postlink = get_permalink($post->ID);
				$categories = get_the_category($post->ID);
				$postlist[$postlink] = array($postname, $categories);
				foreach($categories as $cat) {
					$catID = $cat->cat_ID;
					$catname = $cat->cat_name;
					if (!array_key_exists($catname, $categorylist)) {
						$categorylist[$catname] = $catID;
					}
				}
			}

			// get list of category IDs ordered by name
			$sortedcats = array();
			foreach ($categorylist as $catname=>$catID) {
				array_push($sortedcats, $catname);
			}
			sort($sortedcats);

			$postlisttext = "";
			foreach ($sortedcats as $catname) {
				$catID = $categorylist[$catname];

				$usecat = true;
				if ($gotincludecats) {
					$usecat = in_array("" . $catID, $includecats);
				}
				if (in_array("" . $catID, $excludecats)) {
					$usecat = false;
				}

				if ($usecat) {
					$postlisttext .= "<h3 class=\"jwcatpostlist\"><a href=\"" . get_category_link($catID) . "\">$catname</a></h3>\n";
					$postlisttext .= "<ul class=\"jwcatpostlist\">\n";
					foreach ($postlist as $postlink=>$postdata) {
						$found = false;
						foreach($postdata[1] as $postcat) {
							if ($postcat->cat_ID == $catID) {
								$found = true;
							}
						}
						if ($found) {
							$postlisttext .= "<li><a href=\"" . $postlink . "\">" . $postdata[0] . "</a></li>\n";
						}
					}
					$postlisttext .= "</ul>\n";
				}
			}

			$content = $before . $postlisttext . $after;
		}
	}

	return $content;
}

add_filter('the_content', 'jameswilkes_catpostlist_content_handler');

?>
