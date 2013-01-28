<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Easy_email_obfuscator Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			Aaron Gustafson
 * @copyright		Copyright (c) Easy Designs, LLC
 * @link			https://github.com/easy-designs/easy_email_obfuscator.ee_addon
 */

$plugin_info = array(
	'pi_name'			=> 'Easy Email Obfuscator',
	'pi_version'		=> '1.0',
	'pi_author'			=> 'Easy Designs',
	'pi_author_url'		=> 'http://easy-designs.net/',
	'pi_description'	=> 'Converts an email address into a string and provides a JavaScript reversion tool',
	'pi_usage'			=> Easy_email_obfuscator::usage()
);

class Easy_email_obfuscator {

	var $return_data;

	/**
	 * Easy_email_obfuscator constructor
	 * Does nothing
	 */
	function __construct()
	{
    	$this->EE =& get_instance();
		
		# just exit
		return $this->EE->TMPL->tagdata;
		
	} # end Easy_email_obfuscator constructor
  
	/**
	 * Easy_email_obfuscator::encode()
	 * Converts the email to a 
	 */
	function encode( $email=FALSE )
	{
		if ( ! $email ) $email = $this->EE->TMPL->tagdata;
		
		// obfuscate simply
		$email = str_replace(
			array( '@',			'.' ),
			array( ' [at] ',	' [dot] ' ),
			$email
		);

		# return the obfuscated email addy
		return empty( $email ) ? '' : '<em>' . $email . '</em>';
		
	} # end Easy_email_obfuscator::encode()
	
	/**
	 * Easy_email_obfuscator::jsdecode()
	 * Converts the email to a 
	 */
	function jsdecode( $email=FALSE )
	{
		
		$js = file_get_contents( 'easy-email-deobfuscator.min.js', TRUE );

		if ( ! $js )
		{
			$js = '';
		}

		# return
		return '<script>' . $js . '</script>';
		
	} # end Easy_email_obfuscator::jsdecode()

	/**
	 * Easy_email_obfuscator::usage()
	 * Describes how the plugin is used
	 */
	function usage()
	{
    	ob_start(); ?>
To obfuscate an email address, simply encode it:

{exp:easy_email_obfuscator:encode}me@domain.com{/exp:easy_email_obfuscator:encode}

That will make your email address appear as

<em>me [at] domain [dot] com</em>

Which should fool most harvesters. To decode it again, insert the decoder JavaScript at the bottom of your page (just before closing the body):
  
  {exp:easy_email_obfuscator:jsdecode}
</body>

<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	} # end Easy_email_obfuscator::usage()
	
} # end Easy_email_obfuscator

/* End of file pi.easy_email_obfuscator.php */ 
/* Location: ./system/expressionengine/third_party/easy_email_obfuscator/pi.easy_email_obfuscator.php */