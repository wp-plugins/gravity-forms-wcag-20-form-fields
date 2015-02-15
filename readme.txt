=== Gravity Forms - WCAG 2.0 form fields ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: gravity forms
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Modifies Gravity Forms form fields and improves validation so that forms meet WCAG 2.0 accessibility requirements.

== Description ==

Extends the Gravity Forms plugin - modifies form fields and improves validation so that forms meet WCAG 2.0 accessibility requirements.

By default the radio, checkbox and repeater list fields in Gravity Forms do not meet the WCAG 2.0 accessibility requirements.

This plugin modifies these fields so that they meet the requirements, passing automated checks such as achecker.ca

This is done by wrapping the fields in fieldsets, rather than having unattached labels as well as adding a title to each of the repeater list fields.

Simply install and activate the plugin - no configuration required.

**Please note:** this plugin does not cover other aspects of accessibility, such as order and clear instructions. You will also need to ensure that your websites theme is accessible. 

== Installation ==

1. This plugin requires the Gravity Forms plugin, installed and activated
1. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in the WordPress administration
1. The radio, checkbox and repeater list fields will now be automatically modified so that they meet the accessibility requirements.

== Changelog ==

= 1.1.0 =
* Feature: added aria-describedby for date fields - providing screen reader users with the instructions on how to type into the field, for example 'must be dd/mm/yyyy format'
* Feature: added screen reader only words for required fields - providing screen reader users with the word 'required' in addition to the default star
* Feature: added aria-describedby for fields that have failed validation - making it easier for screen reader users to determine why a field has failed validation
* Feature: improved validation message. Message now reads 'There were 2 errors found in the information you submitted.' and is followed by a list of each field that did not pass validation. Each item in the list is a clickable link, taking the user directly to the field.
* Feature: added browser alert if form did not pass validation. If the form did not pass validation, the first thing the user should see or hear is ''There were 2 errors found in the information you submitted.' followed by the list of errors. When the user clicks past the alert the browsers focus is taken to the on screen validation message and links to errors. 

= 1.0.3 =
* Fix php closing tag to resolve version number not appearing in WordPress Plugin Directory.

= 1.0 =
* First public release.