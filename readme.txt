=== Gravity Forms - WCAG 2.0 form fields ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: gravity forms
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.0.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extends the Gravity Forms plugin - modifies radio, checkbox and repeater list fields so that they meet WCAG 2.0 accessibility requirements.

== Description ==

Extends the Gravity Forms plugin - modifies radio, checkbox and repeater list fields so that they meet WCAG 2.0 accessibility requirements.

By default the radio, checkbox and repeater list fields in Gravity Forms do not meet the WCAG 2.0 accessibility requirements.

This plugin modifies these fields so that they meet the requirements, passing automated checks such as achecker.ca

This is done by wrapping the fields in fieldsets, rather than having unattached labels as well as adding a title to each of the repeater list fields.

Simply install and activate the plugin - no configuration required.

**Please note:** this plugin does not cover other aspects of accessibility, such as order and colour contrast.

== Installation ==

1. This plugin requires the Gravity Forms plugin, installed and activated
1. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in the WordPress administration
1. Open the form you want to add an infobox to
1. The radio, checkbox and repeater list fields will now be automatically modified so that they meet the accessibility requirements.

== Changelog ==

= 1.0.3 =
* Fix php closing tag to resolve version number not appearing in WordPress Plugin Directory.

= 1.0 =
* First public release.