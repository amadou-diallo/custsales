//first declare the global variable
//'ajax' which will become the httprequest object
var ajax;
//when the form loads, run the init function 
//to do the ajax preliminary work
window.onload = init;
//the init function checks that an http object
//is available and that the main form has a
//results section to receive the ajax send-back.
function init() {
    ajax = getXMLHttpRequestObject();
    if (ajax) {
        if (document.getElementById('results')) {
            document.getElementById('CustomerForm').onsubmit = function () {
                //if the form is ok, then an on-submit function
                //is added to the form so that it processes
                //via ajax
                var cid = document.getElementById('custid').value;
                //the only data that needs to be sent to the 
                //server is the branch id; this is done as a
                //'get' submission
                ajax.open('get','SalesResults.php?custid=' +
                    encodeURIComponent(cid));
                //now a function to watch for the server 
                //response must be established
                ajax.onreadystatechange = function() {
                    handleResponse();
                }
                //make the ajax call
                ajax.send(null);
                return false; //prevents form from normal submission
            }
        }
    }

}
//the handle response function looks for a 'finished' state (=4)
//and then checks for a success code (200 or 304)
//if all is ok, we post the text form of the response into the
//div area
function handleResponse() {
    if (ajax.readyState === 4) { //server has completed the request
        if (ajax.status === 200 || ajax.status === 304) {
            var r = document.getElementById('results');
            r.innerHTML = ajax.responseText;
        } else {
            //all was not ok, so we have to try again
            //using the normal submit (postback) process
            document.getElementById('CustomerForm').submit();
        }
    }
}
