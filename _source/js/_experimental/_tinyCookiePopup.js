//
//
//
//
(function (document, window, $) {
	const tinyCookiePopup = {
		noticeText:
			"By using this website, you agree to our use of cookies. We use cookies to provide you with a great experience and to help our website run effectively.",

		_instance: () => {
			tinyCookiePopup.popupMarkup =
				'<div id="cove--temp-cookie-consent"><div><p>' +
				tinyCookiePopup.noticeText +
				'</p><a href="#">X</a></div></div>';

			$("body").append(tinyCookiePopup.popupMarkup);

			// check if the popup exists
			const popupElem = $("#cove--temp-cookie-consent");

			// check if we have seen the popup
			let seenPopup = localStorage.getItem("seenPopup");

			// we have dismissed popup before
			if (seenPopup && popupElem.length > 0) {
				// hide the popup
				$(popupElem[0]).hide();
			}

			// dismissal button handler
			$(popupElem[0]).on("click", "a", tinyCookiePopup._clickToDismiss);
		},
		//
		_clickToDismiss: (e) => {
			// set that we have seen the popup into memory
			localStorage.setItem("seenPopup", "true");
			// hide the popup manually
			$("#cove--temp-cookie-consent").hide();
		},
	};

	tinyCookiePopup._instance();
})(document, window, jQuery);
