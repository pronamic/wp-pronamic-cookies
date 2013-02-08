=== Pronamic Cookies ===
Contributors: pronamic, zogot, remcotolsma
Tags: law, eprivacy, cookie, footer, header
Donate link: http://pronamic.eu/donate/?for=wp-plugin-pronamic-cookies&source=wp-plugin-readme-txt
Requires at least: 3.2
Tested up to: 3.5
Stable tag: 0.2

== Description ==

Allows your site to follow the new Cookie Law.  Gives a small overlay that will show text you can customize in the settings.

You can also chose a location, and a link for the text.

== Usage ==

=== Bar ===

The Cookie Bar is a simple bar along the top or bottom of the page that gives notification that this site uses cookies.  Text and a link are modifiable

=== Wall ===

The Cookie Wall is a full site lockout until cookies have been accepted.  It is run before anything that can set any javascript or cookies.  A background image, color and text are modifiable
from the settings.

__Note: The Cookie Bar and Cookie Wall share the same cookie as they aim to solve the same problem, just in different ways.  Choose one of the two__

=== Sections ===

You can specify sections you want to require a cookie to be set with the following:

pronamic_cookies_is_section_accepted( $name );

$name will be a unique name for this cookie. This method will return boolean depending if the cookie has been set or not.

pronamic_cookies_button( $name, $arguments = array());

$name will be the same name used in is_pronamic_cookies_section_accepted();
$arguments allow an array of the following keys:

*	title (the title message in the modal)
*	description (an overode description text, from the option set)
*	button (the text on the button itself)

=== Dynamic ===

A new dynamic component is available that will ensure that sections are correctly shown even with any caching in place.

```php

$arguments = array(
	'title' => __( 'Title on the message modal' ),
	'description' => __( 'Will overide the description text from the options' ),
	'button' => __( 'The text on the button' )
);

pronamic_cookies_dynamic( $name );

```

You no longer require an if statement ( or the usage of pronamic_cookies_is_section_accepted() ).


== Installation ==

1.	Upload 'wp-pronamic-cookies' to the '/wp-content/plugins/' directory,
2.	Activate the plugin through the 'Plugins' menu in WordPress.

== Changelog ==

= 0.2 =
*	?

= 0.1 =
*	Initial release
