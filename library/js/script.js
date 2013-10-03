/* Author: 

*/
// Stuff to do as soon as the DOM is ready;
$(document).ready(function() {

    
    hooksnhelpers();
    dropDownMenu();

    function hooksnhelpers () {
        //Add First and Last Child Class to List, Rows and Cells items
        $("li:first-child, tr:first-child, td:first-child").addClass('first-child');
        $("li:last-child, tr:last-child, td:last-child").addClass('last-child');

        // Removes Empty <p> tags that WordPress will sometimes insert automtically.
        $('.primary p:empty').each(function() {
          $(this).remove();
        });
    }

    function dropDownMenu  () {

        var menuParent = $('nav[role="navigation"] ul > li').has('ul').addClass('menuParent');
        var subMenu = $('nav[role="navigation"] ul > li > ul').addClass('subMenu');
        $(menuParent).append('<span class="touch-button">+</span>');

        var $menu = $('#mainmenu'),
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
            $this.toggleClass('active').prev('ul.subMenu').toggleClass('active');
        });
    }

});





















