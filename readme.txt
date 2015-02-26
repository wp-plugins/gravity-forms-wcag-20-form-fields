=== Gravity Forms - WCAG 2.0 form fields ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: gravity forms, wcag, accessibility, usability
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.2.6
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Modifies Gravity Forms form fields and improves validation so that forms meet WCAG 2.0 accessibility requirements.

== Description ==

Extends the [Gravity Forms](http://www.gravityforms.com/ "Gravity Forms website") plugin - modifies form fields and improves validation so that forms meet WCAG 2.0 accessibility requirements.

**What does this plugin do?**

* Wraps radio, checkbox and list (repeater) fields in a fieldset.
* Improves form validation by displaying an on-page message that describes how many errors there were in the page. The message contains a list of the form fields with the errors, a description of the error and a link to the field.
* Adds aria-describedby attributes for date and website fields - providing clear instructions for screen reader users of what format is required for the field.
* Adds HTML5 'required' attribute and aria-required='true' for required fields
* Adds aria-describedby attributes for fields that have failed validation - providing clear instructions for screen reader users of what the field error is. Description used is the default validation message for the field, or if set, the validation message for the field.
* Disables the Gravity Forms configured tabindex - this stops users from being able to tab between fields and on-page links.
* Changes links in the form body, such as field descriptions or HTML fields, so they open in a new window. A title is added or appended to any existing title for screen reader users which reads 'this link will open in a new window'.
* Improved file upload field - wrapped in field set, clearly identifies to screen reader users if any file size of file type restrictions have been set of the field.
* Improved field instructions - if a description has been provided for the field, the field is 'described by' the description, using the aria-describedby attribute

**How to I use the plugin?**

Simply install and activate the plugin - no configuration required.

**Have a suggestion, comment or request?**

Please leave a detailed message on the support tab. 

**Let me know what you think**

Please take the time to review the plugin. Your feedback shows the need for Gravity Forms to meet the WCAG 2.0 requirements natively, and will help me understand the value of this plugin.

**Please note:**

* Accessibility is a complicated topic and sometimes there are different opinions on how to best achieve an accessible website. Accessible forms are even harder to achieve, with many different approaches. If you have a suggestion, comment or request please leave a detailed message on the support tab.
* This plugin does not cover other aspects of accessibility, such as content order, clear instructions, colour contrast etc.
* You will also need to ensure that your websites theme is accessible. 

== Installation ==

1. This plugin requires the Gravity Forms plugin, installed and activated
2. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in the WordPress administration
4. The radio, checkbox and repeater list fields will now be automatically modified so that they meet the accessibility requirements.

== Frequently Asked Questions ==

**I still see errors on my form**

Whilst this plugin goes a long way to taking a Gravity Form towards WCAG 2.0 compliance, there are still some things that haven't been looked at yet.

If you're having troubles or even better know a solution, please leave a detailed message on the support tab.

I am aware of three issues that are yet to be resolved - duplicate ID's for checkbox lists, duplicate ID's for multi-page form wrappers (the hidden pages have the same ID), and duplicate ID's for the 'Save and continue later' link/button.

**Opening links in new windows - isn't that bad practice?**

Typically forcing links to open in a new window is bad practice, both from a usability and accessibility point of view. However when it comes to forms there is reason enough to do this - if the user clicks on the link they are taken away from the form - loosing any data they may have provided.

This plugin uses jQuery to modify the form once the browser has loaded it, any links in the form are changed to open in a new window (target='_blank'), then a title is added (or appended to the existing title) which reads 'this link will open in a new window'.

This is the	[H33: Supplementing link text with the title attribute](http://www.w3.org/TR/WCAG20-TECHS/H33.html) technique.

Why not use the [C7: Using CSS to hide a portion of the link text](http://www.w3.org/TR/2014/NOTE-WCAG20-TECHS-20140916/C7) technique?

I'm concerned it would have a negative consequence SEO, because:

1. Search engines may down-rate your website, thinking you're attempting the black hat practice of stuffing a page with keywords that may not have any relevance to the content. 
2. Search engines may index the links with the hidden text. For example, 'document title this link will open in a new window' instead of 'document title'.

I'm willing to be convinced otherwise. But my goal is to make a Gravity Form as accessible for everyone - which needs to take into account how it affects search engines.

== Screenshots ==

1. Shows the improved validation message that is displayed when the form page contains errors. Validation message describes how many errors there were on the page and a list of the fields and errors. Each error is a link to the field. This message gets the browsers 'focus' when it is loaded - allowing screen reader users easy access to the information.
2. Shows list field with 'buttons' instead of images to add and delete rows - buttons are styled like the previous images but are keyboard accessible. 

== Changelog ==

= 1.2.6 =

* Feature: field description now included in a fields 'aria-describedby' attribute - giving screen reader users easy access to the fields description when jumping through fields and skipping page content.
* Feature: wrap single file upload field in a field set - providing screen reader users with the label of the upload field - instead of hearing 'browse' they will hear the title of the field followed by 'file upload'
* Feature: add 'accept' attribute to single file upload field, providing screen reader users a list of accepted file types when they select the file upload fields
* Feature: add screen reader only text below single file upload fields, providing screen readers users a human understandable description of the file type and file size restrictions placed on the field (if specified for the field)
* Maintenance: removed HTML 'required' attribute that was being applied by plugin - this was causing issues. Will be restored once this has been resolved. aria-required still applied to required fields, which is widely supported by assistive technologies.

= 1.2.5 =

* ** REMOVED ** Feature: change 'Save and continue' link to a button. This provides better accessibility by providing 'Save and continue' as a form field - making it listed along side with the 'Previous', 'Next' and 'Submit' buttons when a screen reader user lists all form fields. e.g. JAWS + F5.

= 1.2.4 =

* Fix: required checkbox and radio fields missing 'required' asterisk since version 1.2.2.

= 1.2.3 =

* Feature: links in form body, such as field descriptions or HTML fields, will be made to open in a new window. A title is added or appended to any existing title for screen reader users which reads 'this link will open in a new window'.


= 1.2.2 =

* Enqueue stylesheet instead of directly printing to page.
* Replace i18n slug with slug string instead of class reference.
* Fix text strings for internationalization.
* Fix bug with failing to be inserted.
* Add ARIA live attribute to form validation error
* Remove JS alert to avoid redundant notifications with ARIA

= 1.2.1 =

* Fix: added condition so that 'required' attributes are only added for fields on current page. 

= 1.2.0 =

* Fix: changed links in validation message to be relative to the current page - allowing the links to work regardless of where the form is being loaded
* Fix: changed validation alert so that HTML 'new line' <br/> is replaced with JavaScript 'new line' /n 
* Fix: added condition to column and field changing functions so that they only function on the front end - not in the Gravity Forms forms builder
* Maintenance: improved how date format instructions are built.
* Feature: 'list' field image buttons (add new row, delete row) are not keyboard accessible. Added to to replace with actual buttons they are keyboard accessible.
* Feature: add aria-describedby for website field - 'enter a valid website URL for example http://www.google.com'
* Fix: un-did 'required' attribute for checkbox field - it unduly made ALL checkboxes required, rather than just one.
* Maintenance: moved CSS to its own file.

= 1.1.0 =

* Feature: added aria-describedby for date fields - providing screen reader users with the instructions on how to type into the field, for example 'must be dd/mm/yyyy format'
* Feature: added screen reader only words for required fields - providing screen reader users with the word 'required' in addition to the default star
* Feature: added aria-describedby for fields that have failed validation - making it easier for screen reader users to determine why a field has failed validation
* Feature: improved validation message. Message now reads 'There were 2 errors found in the information you submitted.' and is followed by a list of each field that did not pass validation. Each item in the list is a clickable link, taking the user directly to the field.
* Feature: added browser alert if form did not pass validation. If the form did not pass validation, the first thing the user should see or hear is ''There were 2 errors found in the information you submitted.' followed by the list of errors. When the user clicks past the alert the browsers focus is taken to the on screen validation message and links to errors. 

= 1.0.3 =

* Maintenance: fix php closing tag to resolve version number not appearing in WordPress Plugin Directory.

= 1.0 =

* First public release.