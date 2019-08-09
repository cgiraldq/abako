$j( window ).on( "load", function() {

//jQuery('.nav-1  a').removeAttr( 'rel' );
  /*jQuery('.nav-1  a').removeAttr( 'href' );*/
 // jQuery('.nav-4  a').removeAttr( 'href' );
 // jQuery('.nav-2  a').removeAttr( 'href' );
  
  jQuery('.level1 ul').addClass( 'transisition' );
  
  jQuery(".transisition").mouseover(function(){
//console.log($(this).children().children());
    jQuery(this).css("transition: cubic-bezier(0.26, 1, 1, 1)");
  });
  
jQuery('#menu5 .parentMenu a').removeAttr( 'rel' );
jQuery('#menu5 .parentMenu a').removeAttr( 'href' );
  
jQuery('#menu7 .parentMenu a').removeAttr( 'rel' );
jQuery('#menu7 .parentMenu a').removeAttr( 'href' );

  var owl = $j(".cms-home .block-content .products-grid");
 
  owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1000,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsTablet: [500,1], //2 items between 600 and 0
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
      autoPlay: true 
  });
  
   // Custom Navigation Events
  $j("#fechauno").click(function(){
    owl.trigger('owl.next');
  })
  $j("#fechados").click(function(){
    owl.trigger('owl.prev');
  })
  $j(".play").click(function(){
    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $j(".stop").click(function(){
    owl.trigger('owl.stop');
  })
 /* slider home*/
 


});


jQuery(document).ready(function(){
  
  jQuery( ".nav-primary .level0.parent" ).addClass( "quitancla" );
  jQuery( ".level2.parent ul.level2").addClass( "color-submenu-backcolor2");
  jQuery( ".level2.parent ul.level3").addClass( "color-submenu-backcolor3");
  jQuery( ".level2.parent ul.level4").addClass( "color-submenu-backcolor4");

  jQuery(".quitancla").click(function(){
//console.log($(this).children().children());
    jQuery(this).children().removeAttr("href");
  });


  var owl = $j(".category-productos .block-content .products-grid");
 
  owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1000,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsTablet: [500,1], //2 items between 600 and 0
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
      autoPlay: true 
  });
  
   // Custom Navigation Events
  $j("#fechauno").click(function(){
    owl.trigger('owl.next');
  })
  $j("#fechados").click(function(){
    owl.trigger('owl.prev');
  })
  $j(".play").click(function(){
    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $j(".stop").click(function(){
    owl.trigger('owl.stop');
  })
 /* slider home*/
 





  var owl = $j(".catalog-product-view .block-content .products-grid");
 
  owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1000,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsTablet: [500,1], //2 items between 600 and 0
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
      autoPlay: true 
  });
  
   // Custom Navigation Events
  $j("#fechauno").click(function(){
    owl.trigger('owl.next');
  })
  $j("#fechados").click(function(){
    owl.trigger('owl.prev');
  })
  $j(".play").click(function(){
    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $j(".stop").click(function(){
    owl.trigger('owl.stop');
  })
 /* slider home*/
  
  
    
  
 
  /*$j(".level1").hover(function(e){
    console.log("hovered"+e.target.parentNode.childNodes[1].childNodes[0].classList)
    e.target.parentNode.childNodes[1].childNodes[0].childNodes[0].classList.add("-nav-test-init")
    e.target.parentNode.childNodes[1].childNodes[0].childNodes[0].classList.toggle("-nav-test")
    
  });
  
  $j(".level2").hover(function(e){
    console.log("hovered"+e.target.parentNode.childNodes[1].childNodes[0].classList)
    e.target.parentNode.childNodes[1].childNodes[0].childNodes[0].classList.add("-nav-test-init")
    e.target.parentNode.childNodes[1].childNodes[0].childNodes[0].classList.toggle("-nav-test")
    
  });
  
  $j(".level3").hover(function(e){
    console.log("hovered"+e.target.parentNode.childNodes[1].childNodes[0].classList)
    e.target.parentNode.childNodes[1].childNodes[0].childNodes[0].classList.add("-nav-test-init")
    e.target.parentNode.childNodes[1].childNodes[0].childNodes[0].classList.toggle("-nav-test")
    
  });*/

});


setInterval(
    function () {
        $j('#triangulo-equilatero-bottom-left1mora').animate({rotate: '+=10deg'}, 0);
    },
    200
);

