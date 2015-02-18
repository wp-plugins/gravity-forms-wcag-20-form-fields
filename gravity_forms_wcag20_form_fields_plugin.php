<?php
/*
Plugin Name: Gravity Forms - WCAG 2.0 form fields
Description: Extends the Gravity Forms plugin. Modifies radio, checkbox and repeater list fields so that they meet WCAG 2.0 accessibility requirements.
Version: 1.2.0
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
				add_filter('gform_field_content',  array(&$this,'change_fields_content_wcag'), 10, 5);
				add_action('gform_enqueue_scripts',  array(&$this,'queue_scripts'), 90, 3);
				add_filter('gform_tabindex', create_function('', 'return false;'));   //disable tab-index
				
				add_filter('gform_validation_message', array(&$this,'change_validation_message'), 10, 2);
            }
        } // END __construct
		
		public static function change_validation_message($message, $form){
		$referrer = $_SERVER['HTTP_REFERER'];
		
			foreach ( $form['fields'] as $field ) {
				$failed[] = rgget("failed_validation", $field);
				
				$failed_field = rgget("failed_validation", $field);
				$failed_message = rgget("validation_message", $field);
				if ( $failed_field == 1) {
				
				$error .= '<li><a href="'.$referrer.'#field_'.$form['id'].'_'.$field['id'].'">'.$field[label].' - '.(( "" == $field[errorMessage]) ? $failed_message:$field[errorMessage]).'</a></li>';
				$errorAlert .= '\n\n'. $field[label].' - '.(( "" == $field[errorMessage]) ? $failed_message:$field[errorMessage]);
				
				// replace <br> with new line 
				$errorAlert =  str_replace(strtolower("<br>"),"\\n\\n",$errorAlert);
				// replace <br/> with new line 
				$errorAlert =  str_replace(strtolower("<br/>"),"\\n\\n",$errorAlert);
				// replace <br /> with new line 
				$errorAlert =  str_replace(strtolower("<br />"),"\\n\\n",$errorAlert);
				}
				
			}
			
			$length  = count( array_keys( $failed, "true" ));
			$prompt .= "There ".(($length > 1) ? 'were':'was')." ". $length." ".(($length > 1) ? 'errors':'error')." found in the information you submitted.";
			
			$javascript = "<script type='text/javascript'>";
			$javascript .= "jQuery(document).bind('gform_post_render', function(){";
			$javascript .= "window.setTimeout(function(){";
			$javascript .= "alert('".$prompt.$errorAlert."');";
			$javascript .= "window.location.hash = '#error';";
			$javascript .= "jQuery(this).find('.validation_error').focus();";
			$javascript .= "jQuery(this).scrollTop(jQuery('.validation_error').offset().top);";
			$javascript .= "				}, 500);";
			$javascript .= "});";
			$javascript .= "</script>";
			
			$message = $javascript;
			$message .= "<div id='error'>";
			$message .= "<div class='validation_error'>";
			$message .= $prompt;
			$message .= "</div>";
			$message .= "<ol class='validation_list'>";
			$message .= $error;
			$message .= "</ol>";
			$message .= "</div>";
			return $message;
		}

		/**
         * Replaces field content for repeater lists - adds title to input fields using the column title
         */
		public static function change_column_add_title_wcag($input, $input_info, $field, $text, $value, $form_id) {
		if (!is_admin()) {
			$input = str_replace("<input ","<input title='".$text."'",$input);
		}
		return $input;
		} // END change_column_add_title_wcag
		
		/*
         * Replaces field content with WCAG 2.0 compliant fieldset, rather than the default orphaned labels - applied to checkboxes, radio lists and repeater lists
         */
		public static function change_fields_content_wcag($content, $field, $value, $lead_id, $form_id){
		if (!is_admin()) {
		$field_type = rgar($field,"type");
		$field_required = rgar($field,"isRequired");
		$field_failed_valid = rgar($field,"failed_validation");
		$field_label = rgar($field,"label");
		$field_id = rgar($field,"id");
		$field_page = rgar($field,"pageNumber");
		$current_page = GFFormDisplay::get_current_page( $form_id );
			
			//radio and checkbox fields in fieldset
			if( ("checkbox" == $field_type ) || ("radio" == $field_type) ){
			//wrap in fieldset
				if (true == $field_required ) {
					$content = str_replace("<label class='gfield_label' for='input_".$form_id."_".$field_id."' >".$field_label."<span class='gfield_required'>*</span></label>","<fieldset class='gfieldset'><legend class='gfield_label'>".$field_label."</legend>",$content);
				} else {
					$content = str_replace("<label class='gfield_label' for='input_".$form_id."_".$field_id."' >".$field_label."</label>","<fieldset class='gfieldset'><legend class='gfield_label'>".$field_label."</legend>",$content);
				}
				$content .= "</fieldset>";
			}
			
			if(("list" == $field_type ) ){
				$maxRow = intval(rgar($field, "maxRows"));
				
				//wrap list fields in fieldset
				$content = str_replace("<label class='gfield_label' for='input_".$form_id."_".$field_id."_shim' >".$field_label."</label>","<fieldset class='gfieldset'><legend class='gfield_label'>".$field_label."</legend>",$content);
				$content .= "</fieldset>";
				
				//remove shim input 
				$content = str_replace("<input type='text' id='input_".$form_id."_".$field_id."_shim' style='position:absolute;left:-999em;' onfocus='jQuery( \"#field_".$form_id."_".$field_id." table tr td:first-child input\" ).focus();' />","",$content);
				
				//replace 'add another row' image with button
				$content = str_replace("<img src='".GFCommon::get_base_url()."/images/blankspace.png' class='add_list_item '  title='Add another row' alt='Add a row' onclick='gformAddListItem(this, ".$maxRow.")' style='cursor:pointer; margin:0 3px;' />","<button type='button' class='add_list_item'  title='Add another row' alt='Add a row' onclick='gformAddListItem(this, ".$maxRow.")'></button>",$content);
				
				//replace 'remove this row' image with button - if field is visible 
				$content = str_replace("<img src='".GFCommon::get_base_url()."/images/blankspace.png'  title='Remove this row' alt='Remove this row' class='delete_list_item' style='cursor:pointer; ' onclick='gformDeleteListItem(this, ".$maxRow.")' />","<button type='button' class='delete_list_item'  title='Remove this row' alt='Remove this row' onclick='gformDeleteListItem(this, ".$maxRow.")'></button>",$content);
				
				//replace 'remove this row' image with button - if field is hidden 
				$content = str_replace("<img src='".GFCommon::get_base_url()."/images/blankspace.png'  title='Remove this row' alt='Remove this row' class='delete_list_item' style='cursor:pointer; visibility:hidden;' onclick='gformDeleteListItem(this, ".$maxRow.")' />","<button style='visibility:hidden;' type='button' class='delete_list_item'  title='Remove this row' alt='Remove this row' onclick='gformDeleteListItem(this, ".$maxRow.")'></button>",$content);
			}
			
			// add description for date field 
			if("date" == $field_type ){
				if ( 'mdy' == $field["dateFormat"]) {
					$date_format = 'mm/dd/yyyy';
				} else if ( 'dmy' == $field["dateFormat"]) {
					$date_format = 'dd/mm/yyyy';
				} else if ( 'dmy_dash' == $field["dateFormat"]) {
					$date_format = 'dd-mm-yyyy';
				} else if ( 'dmy_dot' == $field["dateFormat"]) {
					$date_format = 'dd.mm.yyyy';
				} else if ( 'ymd_slash' == $field["dateFormat"]) {
					$date_format = 'yyyy/mm/dd';
				} else if ( 'ymd_dash' == $field["dateFormat"]) {
					$date_format = 'yyyy-mm-dd';
				} else if ( 'ymd_dot' == $field["dateFormat"]) {
					$date_format = 'yyyy.mm.dd';
				} 
				
				$content = str_replace("<label class='gfield_label' for='input_".$form_id."_".$field_id."' >".$field_label,"<label class='gfield_label' for='input_".$form_id."_".$field_id."' >".$field_label." <span id='field_".$form_id."_".$field_id."_dmessage' class='sr-only'> - must be ".$date_format." format</span>",$content);
				
				// attach to aria-described-by
				$content = str_replace(" name='input_"," aria-describedby='field_".$form_id."_".$field_id."_dmessage' name='input_",$content);
			}
			
			// add description for website field 
			if ("website" == $field_type ){
				$content = str_replace("<label class='gfield_label' for='input_".$form_id."_".$field_id."' >".$field_label,"<label class='gfield_label' for='input_".$form_id."_".$field_id."' >".$field_label." <span id='field_".$form_id."_".$field_id."_dmessage' class='sr-only'> - enter a valid website URL for example http://www.google.com</span>",$content);
				
				// attach to aria-described-by
				$content = str_replace(" name='input_"," aria-describedby='field_".$form_id."_".$field_id."_dmessage' name='input_",$content);
			}
			
			//validation for fields in page 
			if ($current_page == $field_page) {
				//if field has failed validation
					if(true == $field_failed_valid ){
					//add add aria-invalid='true' attribute to input
					$content = str_replace(" name='input_"," aria-invalid='true' name='input_",$content);
					//if aria-describedby attribute not already present
					if (strpos(strtolower($content),'aria-describedby') !== true)  {
						$content = str_replace(" aria-describedby='"," aria-describedby='field_".$form_id."_".$field_id."_vmessage ",$content);
					} else { 
						// aria-describedby attribute is already present
						$content = str_replace(" name='input_"," aria-describedby='field_".$form_id."_".$field_id."_vmessage' name='input_",$content);
					}
					//add add class for aria-describedby error message
					$content = str_replace(" class='gfield_description validation_message'"," class='gfield_description validation_message' id='field_".$form_id."_".$field_id."_vmessage'",$content);
				}
			
				//if field is required
				if(true == $field_required ){
					//if HTML5 required attribute not already present
					if (( strpos(strtolower($content),'required') !== true ) && ("checkbox" != $field_type ) )  {
						//add HTML5 required attribute
						$content = str_replace(" name='input_"," required name='input_",$content);
					}
					if ( (strpos(strtolower($content),"aria-required='true'") !== true) && ("checkbox" != $field_type ) )  {
						//add aria-required='true'
						$content = str_replace(" name='input_"," aria-required='true' name='input_",$content);
					}
					//add screen reader only 'Required' message to asterisk
					$content = str_replace("*</span>"," * <span class='sr-only'> Required</span></span>",$content);
				}
			}
			
		}
		return $content;
		} // END change_fields_content_wcag
		
		/*
         * Place required scripts in the footer
         */
		public function queue_scripts($form, $is_ajax) {
		if (!is_admin()) {
			add_action('wp_footer', array(&$this,'css_styles'));
			}
		} // END queue_scripts
		
		/*
         * CSS styles - remove border, margin and padding from fieldset
         */
		public static function css_styles() {
			?>
			<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('gf_wcag20_form_fields.css', __FILE__);?>" media="all" />
			<?php
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
