/* begin Back to Top button & show menu @package tinydancer */

(function() {
  'use strict';

  function trackScroll() {
    var scrolled = window.scrollY;
    var coords = document.documentElement.clientHeight;

    if (scrolled > coords) {
      goTopBtn.classList.add('back_to_top-show');
    }
    if (scrolled < coords) {
      goTopBtn.classList.remove('back_to_top-show');
    }
  }

  function backToTop() {
    if (window.scrollY > 0) {
      window.scrollBy(0, -80);
      setTimeout(backToTop, 0);
    }
  }

  var goTopBtn = document.querySelector('.back_to_top');

  window.addEventListener('scroll', trackScroll);
  goTopBtn.addEventListener('click', backToTop);

  document.getElementById("nav_button").addEventListener('click', openMenu );
  function openMenu(){
    
    var opv = document.getElementById("open_menu").checked;
    var x = document.getElementsByClassName("nav-wrapper")[0];
    if( true === opv ) {

      if (x.style.display === "flex") {
        x.style.display = "none";
      } else {
        x.style.display = "flex";
      }
    }
    
    return false;
    //console.log(opv);
  }

})(); 
