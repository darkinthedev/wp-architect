/* Author:

*/
// Stuff to do as soon as the DOM is ready;
$(document).ready(function() {

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

});





















