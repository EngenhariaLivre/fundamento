( function() {
	const button = document.getElementsByClassName( 'menu-toggle' )[0];
	const menuContainer = document.getElementsByClassName( 'site-links' )[0];

	button.onclick = () => {
		function toggleAttributeAndClass( element ) {
			if ( element.getAttribute( 'aria-expanded' ) === 'false' ) {
				element.setAttribute( 'aria-expanded', 'true' );
			} else {
				element.setAttribute( 'aria-expanded', 'false' );
			}

			element.classList.toggle( 'is-active' );
			element.classList.toggle( 'is-not-active' );
		}

		toggleAttributeAndClass( button );
		toggleAttributeAndClass( menuContainer );
	};
}() );
