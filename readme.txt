=== Pronamic Cookies ===
Contributors: pronamic, zogot, remcotolsma
Tags: cookies, cookie, bar, wall, header, section, privacy, eprivacy, law, pronamic, share
Donate link: http://pronamic.eu/donate/?for=wp-plugin-pronamic-cookies&source=wp-plugin-readme-txt
Requires at least: 3.2
Tested up to: 3.5.1
Stable tag: 0.2.2

== Description ==

The Pronamic Cookies plugin allows you to activate a cookie solution on
your WordPress website. There are multiple ways to inform the visitors of the use 
of cookies. The Pronamic Cookies plugin supports the following techniques:

= Bar =

The cookie bar technique is a simple bar along the top or bottom of the page 
that gives notification that your website uses cookies. The location, link and 
text of the bar can be easily adjusted. 

**Note:** This technique won't block any cookies which are used on your website.

= Wall =

The cookie wall technique is a full site lockout until cookies have been 
accepted. It is run before anything that can set any JavaScript or cookies. 
A background image, color and text are modifiable from the settings.

= Section =

The cookie section technique is useful for small components or functionalities 
on your website wich require cookies. You could for example use this for the 
sharing buttons from Facebook, Twitter, Google+, etc. 

**Note:** This technique requires adjustments in the theme or plugins you use.


== Installation ==

1.	Upload 'wp-pronamic-cookies' to the '/wp-content/plugins/' directory,
2.	Activate the plugin through the 'Plugins' menu in WordPress.


== Frequently Asked Questions ==

1.	Have a question? Make a thread in the support forum and we will get back to you.


== Screenshots ==

1.	Example of Pronamic Cookies Wall
2.	Example of Pronamic Cookies Bar
3.	Pronamic Cookies Section/Dynamic Prior to accept
4.	Pronamic Cookies Section/Dynamic modal example
5.	Settings Page


== Changelog ==

= 0.2.2 =
*	Fixed fatal error on plugin activation
*	Fixed filename of screenshot-1.png

= 0.2.1 =
*	Improved documentation

= 0.2 =
*	Cookie Wall Feature: Enables full blocking of the site until cookie is accepted.
*	Cookies Dynamic: Dynamic area for cookies
*	Functions now follow a better naming structure. Old names (pcl_) are now deprecated
*	Screenshots

= 0.1 =
*	Initial release


== Sections ==

You can specify sections you want to require a cookie to be set with the 
following:

`<?php pronamic_cookies_is_section_accepted( $name ); ?>`

$name will be a unique name for this cookie. This method will return boolean 
depending if the cookie has been set or not.

`<?php pronamic_cookies_button( $name, $arguments = array() ); ?>`

$name will be the same name used in is_pronamic_cookies_section_accepted();
$arguments allow an array of the following keys:

*	title (the title message in the modal)
*	description (an overode description text, from the option set)
*	button (the text on the button itself)


== Dynamic ==

A new dynamic component is available that will ensure that sections are 
correctly shown even with any caching in place.

`<?php $name = 'pronamic_cookies_dynamic'; ?>`

Name is the unique naming given to this dynamic section. Its name is important 
for determining the content you want to show once accepted.

`<?php $container = 'pronamic_cookies_dynamic_container'; ?>`

This is the name of the surrounding div ( CSS CLASS NAME )

`<?php

$arguments = array(
	'title'       => __( 'Title on the message modal' ),
	'description' => __( 'Will overide the description text from the options' ),
	'button'      => __( 'The text on the button' )
);

pronamic_cookies_dynamic( $name, $container, $arguments );

?> `

You don't require an if statement with dynamic ( or the usage of pronamic_cookies_is_section_accepted() ).


== Success Content ==

To show the success content for pronamic_cookies_dynamic, you require a 
function that is used in combination with add_filter

`<?php add_filter( 'pronamic_cookies_dynamic_$name', 'function_name' ); ?>`

Where $name is the name used in the call to pronamic_cookies_dynamic();


== Example ==

`
<div class="pronamic_cookies_dynamic_container">
	<a href="#" class="jShowCookieLawModal">Click</a>
</div>
<?php

pronamic_cookies_dynamic( 'facebook_section', 'pronamic_cookies_dynamic_container', array(
	'title' => __( 'Cookies are required for this section' )
) );

// In a functions file
add_filter( 'pronamic_cookies_dynamic_facebook_section', 'facebook_section_success' );

function facebook_section_success( $content ) {
	$content = 'custom javascript or anything else';
	return $content;
}
?>`


== JavaScript ==

You can call the modal of pronamic_cookies_dynamic and pronamic_cookies_section 
from anything (imgs, buttons, links) just give that element the class
'jShowCookieLawModal'

