function getXMLHttpRequest()
{
    var request = false;
    
    try {
        /*
	 * Przeglądarki: Firefox 2, Opera 9, IE 7
	 */
        request = new XMLHttpRequest();
    } catch(err1) {
        try {
            /*
             * Przeglądarka: IE 6
             */
            request = new ActiveXObject('Msxml2.XMLHTTP');
        } catch(err2) {
            try {
                /*
                 * Przeglądarka: IE 5
                 */
                request = new ActiveXObject('Microsoft.XMLHTTP');                
            } catch(err3) {
                request = false;
            }
        }
    }
    return request;
}    