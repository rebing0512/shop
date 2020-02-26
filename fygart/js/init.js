/*
	Aerial by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function() {

	skel.init({
		reset: 'full',
		breakpoints: {
			'global': { range: '*', href: 'css/style.css', viewport: { scalable: false } },
            'mobile-4': { media: 'only screen and (max-width: 720px)', href: 'css/style-mobile-4.css'},
            'mobile-3': { media: 'only screen and (min-device-width: 414px) and (max-device-height: 736px)', href: 'css/style-mobile-3.css'},
            'mobile-2': { media: 'only screen and (min-device-width: 320px) and (max-device-height: 667px)', href: 'css/style-mobile-2.css'},
            'mobile-1': { media: 'only screen and (min-device-width: 320px) and (max-device-height: 480px)', href: 'css/style-mobile-1.css'}
        }
	});

	// Events (JS).
		
		// Remove "loading" class once the page has fully loaded.
			window.onload = function() {
				document.body.className = '';
			}

		// Prevent scrolling on touch.
			window.ontouchmove = function() {
				return false;
			}

		// Fix scroll position on orientation change.
			window.onorientationchange = function() {
				document.body.scrollTop = 0;
			}

	/*

	// Events (jQuery).
	// Aerial doesn't need jQuery, but if you're going to use it anyway remove the
	// block of JS events above and use the jQuery-based ones below instead.

		jQuery(window)

			// Remove "loading" class once the page has fully loaded.
				.on('load', function() {
					jQuery('body').removeClass('loading');
				})

			// Prevent scrolling on touch.
				.on('touchmove', function() {
					return false;
				})

			// Fix scroll position on orientation change.
				.on('orientationchange', function() {
					jQuery('body').scrollTop(0);
				});

	*/

})();