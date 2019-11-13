( function() {
	function toggleAttributeAndClass( element ) {
		if (element.getAttribute('aria-expanded') === 'false') {
			element.setAttribute('aria-expanded', 'true');
		} else {
			element.setAttribute('aria-expanded', 'false');
		}

		element.classList.toggle('is-active');
		element.classList.toggle('is-not-active');
	}

	try {
		const menuButton = document.getElementsByClassName('menu-toggle')[0];
		const menuContainer = document.getElementsByClassName('site-links')[0];

		menuButton.onclick = () => {
			toggleAttributeAndClass(menuButton);
			toggleAttributeAndClass(menuContainer);
		};	
	} catch ( error )  {
		// This is a special page, without the trivial menu.
	}

	try {
		const leaveAComment = document.getElementsByClassName('comments-link')[0].getElementsByTagName('a')[0];
		const comments = document.getElementById('comments');

		leaveAComment.onclick = () => {
			toggleAttributeAndClass(comments);
		}
	} catch ( error ) {
		// This is not a singular() page.
	}
}() );
