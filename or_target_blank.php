<?
/*
  Plugin Name: Target Blank
  Plugin Author: Olivier Ruffin
  Description: A Wordpress plugin to add a target='_blank' to all post and comments links which are external to the blog
  Version: 1.0
  Author: Olivier Ruffin
  Author URI: http://veilleperso.com
*/

define('OR_EXTERNAL_LINK', "/^".preg_quote(get_option("siteurl"), "/i")."/");

function or_convert_external_link($matches) {
  if (preg_match(OR_EXTERNAL_LINK, $matches[2])) return "<a href=\"$matches[2]\"$matches[1]$matches[3]>";
  else return "<a href=\"$matches[2]\"$matches[1]$matches[3] target=\"_blank\">";
}
	
function or_external_link($text) {
  // use a target blank on external links
	$pattern = '/<a(.*?)href=[\"\'](https*:\/\/.*?)[\"\'](.*?)>/i';
	return preg_replace_callback($pattern, 'or_convert_external_link', $text);
}

add_filter('comment_text', 'or_external_link', 999);
add_filter('the_content', 'or_external_link', 999);
add_filter('get_comment_author_link', 'or_external_link', 999);
