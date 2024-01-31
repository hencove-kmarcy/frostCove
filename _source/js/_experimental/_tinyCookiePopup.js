
const tinyCookiePopup = {

    _instance : () => {
        // check if the popup exists
        const popupElem = $('#test-popup');

        // check if we have seen the popup
        let seenPopup = localStorage.getItem('seenPopup');
        
        // we have dismissed popup before
        if( seenPopup && popupElem.length > 0 ){
            // hide the popup 
            $(popupElem[0]).hide();
        }

        // dismissal button handler
        $(popupElem[0]).on('click', 'a', tinyCookiePopup._clickToDismiss);
        
    },
    // 
    _clickToDismiss : (e) => {
        // set that we have seen the popup into memory
        localStorage.setItem('seenPopup', 'true');
        // hide the popup manually
        $('#test-popup').hide();
    }

}

tinyCookiePopup._instance();