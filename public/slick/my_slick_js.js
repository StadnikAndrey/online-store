$(document).on('ready', function() {
      
     $('.slider-for').slick({
   slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  // fade: true,
  asNavFor: '.slider-nav',
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 450,
      settings: {         
        infinite: true,
        dots: true
      }
    } 
  ]
});
     
$('.slider-nav').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: '.slider-for',   
  focusOnSelect: true,            
  vertical: true,
  // centerMode: true,
         
});
  

});