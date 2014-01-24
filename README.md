Email Obfuscation for ExpressionEngine
======================================

To obfuscate an email address, simply encode it:

	{exp:easy_email_obfuscator:encode}me@domain.com{/exp:easy_email_obfuscator:encode}

That will make your email address appear as

	<em>me [at] domain [dot] com</em>

Which should fool most harvesters. To decode it again, insert the decoder JavaScript at the bottom of your page (just before closing the body):
  
  		{exp:easy_email_obfuscator:jsdecode}
	</body>