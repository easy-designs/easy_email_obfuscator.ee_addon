/*! (c) Easy Designs (@EasyDesigns). MIT License. http://github.com/easy-designs/easy_email_obfuscator.ee_addon */
(function( doc ){
	
	if ( ! ( 'slice' in Array.prototype ) )
	{
		// sorry IE6
		return;
	}
	
		// coerce the element collection to a proper array (so it isn’t live)
	var ems = document.getElementsByTagName('em'),
		len = ems.length,
		temp,
		a = document.createElement('a'),
		AT = ' [at] ',
		DOT = ' [dot] ',
		em,
		text,
		email,
		link;
		
	try {
		ems = Array.prototype.slice.call( ems );
	} catch(e) {
		temp = [];
		while ( len-- )
		{
			temp.push( ems[len] );
		}
		ems = temp;
		len = ems.length;
	}
		
	a.setAttribute( 'class', 'email' );
	
	while ( len-- )
	{
		em = ems[len];
		text = em.innerText;

		if ( text.indexOf( AT ) > -1 &&
		 	 text.indexOf( DOT ) > -1 )
		{

			// decode the email address
			email = text.replace( AT, '@' ).replace( /\s\[dot\]\s/g, '.' );
			
			// create the link
			link = a.cloneNode( true );
			link.setAttribute( 'href', 'mailto:' + email );
			link.appendChild(
				document.createTextNode( email )
			);
			
			// replace the em
			em.parentNode.replaceChild( link, em );

		}
	}
	
	// release RAM
	ems = em = a = link = null;
	
}( document ));