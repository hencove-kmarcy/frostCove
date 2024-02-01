/* main theme js */
//
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

import './_experimental/_tinyCookiePopup.js';
//
(function (document, window, $) {
	//
	// jQuery is ready as $

	const fadeIn_Elements = gsap.utils.toArray([
		".entry-content > .wp-block-group.alignfull > .wp-block-group",
		".entry-content > .wp-block-group:not(.alignfull)",
	]);

	gsap.set(fadeIn_Elements, { opacity: 0, y: 30 });

	ScrollTrigger.batch(fadeIn_Elements, {
		start: "top 85%",
		end: "bottom 15%",
		duration: 1,
		onEnter: (batch) => gsap.to(batch, { y: 0, autoAlpha: 1, stagger: 0.2 }),
	});

	//
	//
	//
	//
})(document, window, jQuery);
