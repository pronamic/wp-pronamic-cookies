=== Pronamic Cookies ===
Contributors: pronamic, zogot, remcotolsma
Tags: law, eprivacy, cookie, footer, header
Donate link: http://pronamic.eu/donate/?for=wp-plugin-pronamic-cookies&source=wp-plugin-readme-txt
Requires at least: 3.2
Tested up to: 3.5
Stable tag: 0.1

== Description ==

Allows your site to follow the new Cookie Law.  Gives a small overlay that will show text you can customize in the settings.

You can also chose a location, and a link for the text.

== Usage ==

=== Sections ===

You can specify sections you want to require a cookie to be set with the following:

is_pronamic_cookies_section_accepted( $name );

$name will be a unique name for this cookie. This method will return boolean depending if the cookie has been set or not.

pcl_button( $name, $arguments = array());

$name will be the same name used in is_pronamic_cookies_section_accepted();
$arguments allow an array of the following keys:

* title (the title message in the modal)
* description (an overode description text, from the option set)
* button (the text on the button itself)

== Installation ==

1.	Upload 'wp-pronamic-cookies' to the '/wp-content/plugins/' directory, 
2.	Activate the plugin through the 'Plugins' menu in WordPress.

== Changelog ==

= 1.0.0 =
*	Initial release
