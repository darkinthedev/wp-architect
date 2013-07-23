/* Author: 

*/
// Stuff to do as soon as the DOM is ready;
$(document).ready(function() {

    
    hooksnhelpers();

    function hooksnhelpers () {
        //Add First and Last Child Class to List, Rows and Cells items
        $("li:first-child, tr:first-child, td:first-child").addClass('first-child');
        $("li:last-child, tr:last-child, td:last-child").addClass('last-child');
        
        // Add Some Navigation Helper Classes
        var menuParent = $('nav[role="navigation"] ul > li').has('ul').addClass('menuParent');
        var subMenu = $('nav[role="navigation"] ul > li > ul').addClass('subMenu');

        menuParent.hover(function() {
            $(this).addClass('hover');
            $(this).children('ul.subMenu').addClass('hover');
        }, function() {
            $(this).removeClass('hover');
            $(this).children('ul.hover').removeClass('hover');
        });
    }

});





















