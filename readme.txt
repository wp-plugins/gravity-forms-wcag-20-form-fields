=== Gravity Forms - WCAG 2.0 form fields ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: gravity forms
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.2.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Modifies Gravity Forms form fields and improves validation so that forms meet WCAG 2.0 accessibility requirements.

== Description ==

Extends the Gravity Forms plugin - modifies form fields and improves validation so that forms meet WCAG 2.0 accessibility requirements.

**What does this plugin do?**
*   Wraps radio, checkbox and list (repeater) fields in a fieldset.
*   Improves form validation by displaying an alert message and on-page message that describes how many errors there were in the page. On-page message contains a list of the form fields with the errors, a description of the error and a link to the field.
*   Adds aria-describedby attributes for date and website fields - providing clear instructions for screen reader users of what format is required for the field.
*   Adds HTML5 'required' attribute and aria-required='true' for required fields
*   Adds aria-describedby attributes for fields that have failed validation - providing clear instructions for screen reader users of what the field error is. Description used is the default validation message for the field, or if set, the validation message for the field.
*   Disables the Gravity Forms configured tabindex - this stops users from being able to tab between fields and on-page links.

**How to I use this plugin?**
Simply install and activate the plugin - no configuration required.

**Have a suggestion or request?**
Please leave a detailed message on the support tab. 

**Please note:**
*   Accessibility is a complicated topic and sometimes there are different opinions on how to best achieve an accessible website. Accessible forms are even harder to achieve, with many different approaches. 
*   This plugin does not cover other aspects of accessibility, such as content order and clear instructions, colour contrast etc.
*   You will also need to ensure that your websites theme is accessible. 

== Installation ==

1. This plugin requires the Gravity Forms plugin, installed and activated
1. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in the WordPress administration
1. The radio, checkbox and repeater list fields will now be automatically modified so that they meet the accessibility requirements.

== Screenshots ==

1. Shows the alert message that is displayed when form page contains errors. Alert message describes how many errors there were on the page and a list of the fields and error.
2. Shows the improved validation message that is displayed when the form page contains errors. Validation message describes how many errors there were on the page and a list of the fields and errors. Each error is a link to the field. This message gets the browsers 'focus' when it is loaded - allowing screen reader users easy access to the information.
3. Shows list field with 'buttons' instead of images to add and delete rows - buttons are styled like the previous images but are keyboard accessible. 

== Changelog ==

= 1.2.0 =
*   Fix: changed links in validation message to be relative to the current page - allowing the links to work regardless of where the form is being loaded
*   Fix: changed validation alert so that HTML 'new line' <br/> is replaced with JavaScript 'new line' /n 
*   Fix: added condition to column and field changing functions so that they only function on the front end - not in the Gravity Forms forms builder
*   Maintenance: improved how date format instructions are built.
*   Feature: 'list' field image buttons (add new row, delete row) are not keyboard accessible. Added to to replace with actual buttons they are keyboard accessible.
*   Feature: add aria-describedby for website field - 'enter a valid website URL for example http://www.google.com'
*   Fix: un-did 'required' attribute for checkbox field - it unduly made ALL checkboxes required, rather than just one.
*   Maintenance: moved CSS to its own file.

= 1.1.0 =
*   Feature: added aria-describedby for date fields - providing screen reader users with the instructions on how to type into the field, for example 'must be dd/mm/yyyy format'
*   Feature: added screen reader only words for required fields - providing screen reader users with the word 'required' in addition to the default star
*   Feature: added aria-describedby for fields that have failed validation - making it easier for screen reader users to determine why a field has failed validation
*   Feature: improved validation message. Message now reads 'There were 2 errors found in the information you submitted.' and is followed by a list of each field that did not pass validation. Each item in the list is a clickable link, taking the user directly to the field.
*   Feature: added browser alert if form did not pass validation. If the form did not pass validation, the first thing the user should see or hear is ''There were 2 errors found in the information you submitted.' followed by the list of errors. When the user clicks past the alert the browsers focus is taken to the on screen validation message and links to errors. 

= 1.0.3 =
*   Maintenance: fix php closing tag to resolve version number not appearing in WordPress Plugin Directory.

= 1.0 =
*   First public release.