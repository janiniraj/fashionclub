$(document).ready(function(){
    
    // function to show our popups
    function showPopup(whichpopup){
        var docHeight = $(document).height(); //grab the height of the page
		var docWidth = $(document).width()
        var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
        $('.overlay-bg').fadeIn("slow").css({'height' : docHeight, 'width': docWidth }); //display your popup background and set height to the page height
        $('.popup'+whichpopup).show().css({'top': scrollTop+20+'%'}); 
    }
 
    // function to close our popups
    function closePopup(){
        $('.overlay-bg, .overlay-content').hide(); //hide the overlay
		sessionStorage.setItem('hoverad', 'shown');
		document.cookie="hoveradcookie=shown";
		//console.log("Closing pop-up. Hoverad: "+sessionStorage.getItem("hoverad"));
    }
 
    // timer if we want to show a popup after a few seconds.
    //get rid of this if you don't want a popup to show up automatically
    setTimeout(function() {
        // Show popup3 after 1 second
       //if (sessionStorage.getItem("hoverad")!="shown") showPopup(1)
	   if (get_cookie("hoveradcookie")!="shown") showPopup(1)
    }, 1000);
 
 
    // hide popup when user clicks on close button or if user clicks anywhere outside the container
    $('.close-btn, .overlay-bg, .overlay-content').click(function(){
        closePopup();
    });
     
    // hide the popup when user presses the esc key
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // if user presses esc key
            closePopup();
        }
    });
});

//console.log("Hoverad: "+sessionStorage.getItem("hoverad"));
//console.log("Hoverad Cookie: "+get_cookie("hoveradcookie"));

//Get cookie routine by Shelley Powers 
function get_cookie(Name) {
  var search = Name + "="
  var returnvalue = "";
  if (document.cookie.length > 0) {
    offset = document.cookie.indexOf(search)
    // if cookie exists
    if (offset != -1) { 
      offset += search.length
      // set index of beginning of value
      end = document.cookie.indexOf(";", offset);
      // set index of end of cookie value
      if (end == -1) end = document.cookie.length;
      returnvalue=unescape(document.cookie.substring(offset, end))
      }
   }
  return returnvalue;
}