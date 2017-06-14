// Fonction qui retourne la valeur du cookie que l'on recherche
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

if(document.cookie.indexOf("active=") >= 0){
  // On récupère l'id de la section qui était active
  var id_section_active = getCookie("active");
  // On vérifie si la section existe dans le document
  var id_section_found = $(id_section_active).length >= 0 ? true : false;
  if(id_section_found){
    // On enlève la classe active à toutes les sections
    $(".section").each(function(){
      var active = $(this).hasClass("active");
      if(active){
        $(this).removeClass( 'active' );
      }
    });
    // On rajoute la classe active à la section qui était active avant le refresh
    $(id_section_active).addClass('active');
    // On met la nav du menu active en conséquence
    $('li.nav-item > a').not(".btn").each(function(){
      $(this).parent().removeClass( 'active' );
      if($(this).attr('href') == id_section_active){
        $(this).parent().addClass('active');
      }
    });
  }
}
// On cache toutes les sections qui ne possède pas la classe active
$(".section").each(function(){
  var active = $(this).hasClass("active");
  if(!active){
    $(this).hide();
  }
});

// global. currently active menu item
var current_item = 0;

var section_hide_time = 50;
var section_show_time = 50;

//Switch section
$("a", 'nav').not(".btn").click(function()
{
  var new_section = $( $(this).attr('href') );
  $('a', 'nav').parent().removeClass( 'active' );
  $(this).parent().addClass( 'active' );
  $('.section:visible').fadeOut( section_hide_time, function() {
    new_section.addClass('active');
    new_section.fadeIn( section_show_time );
    var new_section_id = "#" + new_section.attr('id');
    document.cookie = "active=" + new_section_id;
  });
});

// Incremente le compteur du bootcampomètre
$(".incremente").click(function()
{
  if(parseInt($(".compteur_bootcamp").text()) < 100){
    var objdata = "incremente";
    $.ajax({
      url: "./update_bootcamp.php",
      type: 'POST',
      data: { type: "incremente"},
      success:function() {
        var compteur = parseInt($(".compteur_bootcamp").text()) + 1;
        $(".compteur_bootcamp").text(compteur);
      }
    });
  }
});

// Decremente le compteur du bootcampomètre
$(".decremente").click(function()
{
  if(parseInt($(".compteur_bootcamp").text()) > 0){
    var objdata = "decremente";
    $.ajax({
      url: "./update_bootcamp.php",
      type: 'POST',
      data: { type: "decremente"},
      success:function() {
        var compteur = parseInt($(".compteur_bootcamp").text()) - 1;
        $(".compteur_bootcamp").text(compteur);
      }
    });
  }
});

// Switch section
// $("a", 'nav').not(".btn").click(function()
// {
//   if( ! $(this).hasClass('active') ) {
//     current_item = this;
//     // close all visible divs with the class of .section
//     $('.section:visible').fadeOut( section_hide_time, function() {
//       $('a', 'nav').removeClass( 'active' );
//       $(current_item).addClass( 'active' );
//       var new_section = $( $(current_item).attr('href') );
//       new_section.fadeIn( section_show_time );
//     } );
//   }
//   return false;
// });
