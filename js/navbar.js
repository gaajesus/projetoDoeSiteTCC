$(function(){
    $(window).scroll(function(){
      if($(this).scrollTop() < 50){
        $("nav").removeClass("topo")
      }
      else{
        $("nav").addClass("topo")
      }
    })
  }) 