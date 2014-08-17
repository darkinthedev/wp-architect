/* ========================================================================
 * Extracted from ROOTS WordPress Theme: https://github.com/roots/roots
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
      html5();
      hooksnhelpers();
      dropDownMenu();

      function html5 () {
          //http://webdesignerwall.com/tutorials/cross-browser-html5-placeholder-text
          if(!Modernizr.input.placeholder){

              $('[placeholder]').focus(function() {
                  var input = $(this);
                  if (input.val() == input.attr('placeholder')) {
                      input.val('');
                      input.removeClass('placeholder');
                  }
              }).blur(function() {
                  var input = $(this);
                  if (input.val() == '' || input.val() == input.attr('placeholder')) {
                      input.addClass('placeholder');
                      input.val(input.attr('placeholder'));
                  }
                  }).blur();
                  $('[placeholder]').parents('form').submit(function() {
                      $(this).find('[placeholder]').each(function() {
                          var input = $(this);
                          if (input.val() == input.attr('placeholder')) {
                              input.val('');
                          }
                      })
                  });
          }
      }

      function hooksnhelpers () {
          //Add First and Last Child Class to List, Rows and Cells items
          $("li:first-child, tr:first-child, td:first-child").addClass('first-child');
          $("li:last-child, tr:last-child, td:last-child, article:last").addClass('last-child');

          // Removes Empty <p> tags that WordPress will sometimes insert automtically.
          $('.primary p:empty').each(function() {
            $(this).remove();
          });
      }

      function dropDownMenu  () {

          var menuParent = $('nav[role="navigation"] ul > li').has('ul').addClass('menuParent');
          var subMenu = $('nav[role="navigation"] ul > li > ul').addClass('subMenu');
          $(menuParent).append('<span class="touch-button">+</span>');

          var $menu = $('div.dropdown-menu > nav[role="navigation"]'),
          $menulink = $('a.menu-link'),
          $menuTrigger = $('span.touch-button');

          $menulink.click(function(e) {
              e.preventDefault();
              $menulink.toggleClass('active');
              $menu.toggleClass('active');
          });

          $menuTrigger.click(function(e) {
              e.preventDefault();
              var $this = $(this);
              if ($this.prev('ul.subMenu').is(':visible')) {
                  $this.prev('ul.subMenu').removeClass('active');
                  $this.removeClass('active')
              } else {
                 $this.closest('ul').find('.active').prev('ul.subMenu').removeClass('active');
                 $this.prev('ul.subMenu').addClass('active');
                 $this.addClass('active');
              }
          });
      }
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.





















