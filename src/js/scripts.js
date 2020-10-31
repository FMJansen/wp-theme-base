(function (window, document, $) {

  $(document).ready(onDocReady);

  function onDocReady () {

    let menu = $('.site-menu');

    ajaxurl = document.head.querySelector("[name=ajaxurl]").content;

    menuToggler(menu);
    menu.removeClass('opened');

  }



  function menuToggler (menu) {

    var menuToggle = $('.js-menu-toggle');

    menuToggle.click(function (e) {
      e.preventDefault();
      menu.toggleClass('opened');
      menuToggle.toggleClass('opened');
    });

  }

}(window, document, jQuery));
