<?php
/*
Plugin Name: Gravity Forms - WCAG 2.0 form fields
Description: Extends the Gravity Forms plugin. Modifies radio, checkbox and repeater list fields so that they meet WCAG 2.0 accessibility requirements.
Version: 1.0.4
Author: Adrian Gordon
License: GPL2
*/

add_action('admin_notices', array('ITSP_GF_WCAG20_Form_Fields', 'admin_warnings'), 20);

if (!class_exists('ITSP_GF_WCAG20_Form_Fields')) {
    class ITSP_GF_WCAG20_Form_Fields
    {
        /**
         * Construct the plugin object
         */
		 public function __construct()
        {		
            // register actions
            if (self::is_gravityforms_installed()) {
                //start plug in
                add_filter('gform_column_input_content',  array(&$this,'change_column_add_title_wcag'), 10, 6);
				add_filter('gform_field_content',  array(&$this,'change_checkbox_radio_list_fields_wcag'), 10, 5);
				add_action('gform_enqueue_scripts',  array(&$this,'queue_scripts'), 90, 3);
				add_filter('gform_tabindex', create_function('', 'return false;'));   //disable tab-index
            }
        } // END __construct
		
		/**
         * Replaces field content for repeater lists - adds title to input fields using the column title
         */
		public static function change_column_add_title_wcag($input, $input_info, $field, $text, $value, $form_id) {
			$new_input = str_replace("<input ","<input title='".$text."'",$input);
			return $new_input;
		} // END change_column_add_title_wcag
		
		/*
         * Replaces field content with WCAG 2.0 complient fieldset, rather than the default orphaned labels - applied to checkboxes, radio lists and repeater lists
         */
		public static function change_checkbox_radio_list_fields_wcag($content, $field, $value, $lead_id, $form_id){
		$field_type = rgar($field,"type");
			if(("checkbox" == $field_type )|| ("radio" == $field_type) ){
				$label = rgar($field,"label");
				$content = str_replace("<label class='gfield_label'>".$label."</label>","<fieldset class='gfieldset'><legend class='gfield_label'>".$label."</legend>",$content);
				$content .= "</fieldset>";
			}
			if(("list" == $field_type ) ){
				$label = rgar($field,"label");
				$content = str_replace("<label class='gfield_label' for='input_".$form_id."_".rgar($field,"id")."'>".$label."</label>","<fieldset class='gfieldset'><legend class='gfield_label'>".$label."</legend>",$content);
				$content .= "</fieldset>";
			}
		return $content;
		} // END change_checkbox_radio_list_fields_wcag
		
		/*
         * Place required scripts in the footer
         */
		public function queue_scripts($form, $is_ajax) {
			add_action('wp_footer', array(&$this,'css_styles'));
		} // END queue_scripts
		
		/*
         * CSS styles - remove border, margin and padding from fieldset
         */
		public static function css_styles() {
		?>
				<style type="text/css">
					.gfieldset {
						border:none;
						margin: 0;
						padding: 0;
					}
				</style> <?php
		}
		
		/*
         * Warning message if Gravity Forms is not installed and enabled
         */
		public static function admin_warnings() {
			if ( !self::is_gravityforms_installed() ) {
				$message = __('Requires Gravity Forms to be installed.', self::$slug);
			} 
			if (empty($message)) {
				return;
			}
			?>
			<div class="error">
				<p>
					<?php _e('The plugin ', self::$slug); ?><strong><?php echo self::$name; ?></strong> <?php echo $message; ?><br />
					<?php _e('Please ',self::$slug); ?><a href="http://www.gravityforms.com/"><?php _e(' download the latest version',self::$slug); ?></a><?php _e(' of Gravity Forms and try again.',self::$slug) ?>
				</p>
			</div>
			<?php
		}
		
		/*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed()
        {
            return class_exists('GFAPI');
        } // END is_gravityforms_installed
	}
    $ITSP_GF_WCAG20_Form_Fields = new ITSP_GF_WCAG20_Form_Fields();
}
?>
