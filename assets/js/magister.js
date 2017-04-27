// global. currently active menu item
var current_item = 0;

// few settings
var section_hide_time = 500;
var section_show_time = 500;

var tab = new Array();

tab[0] = "img/background/glock.jpg";
tab[1] = "img/background/awp.jpg";
tab[2] = "img/background/usp.jpg";
tab[3] = "img/background/ak47.jpg";
tab[4] = "img/background/m4.jpg";

document.body.style.background = "url("+tab[0]+") no-repeat fixed center";
var i = 1;

function randomBg(){
  if(i < tab.length){
    document.body.style.background = "url("+tab[i]+") no-repeat fixed center";
    i++;
  }else{
    i = 0;
    document.body.style.background = "url("+tab[i]+") no-repeat fixed center";
    i++;
  }
}

function background_reload(){
// traitement
setInterval(function(){ randomBg();}, 3000);
}

// jQuery stuff
jQuery(document).ready(function($) {

	// Switch section
	$("a", '.mainmenu').click(function()
	{
		if( ! $(this).hasClass('active') ) {
			current_item = this;
			// close all visible divs with the class of .section
			$('.section:visible').fadeOut( section_hide_time, function() {
				$('a', '.mainmenu').removeClass( 'active' );
				$(current_item).addClass( 'active' );
				var new_section = $( $(current_item).attr('href') );
				new_section.fadeIn( section_show_time );
			} );
		}
		return false;
	});
});
