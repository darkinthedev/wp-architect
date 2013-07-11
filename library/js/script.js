/* Author: 

*/
// Stuff to do as soon as the DOM is ready;
$(document).ready(function() {
    
    //Add First and Last Child Class to List, Rows and Cells items
    $("li:first-child, tr:first-child, td:first-child").addClass('first-child');
    $("li:last-child, tr:last-child, td:last-child").addClass('last-child');
    
    // Add Some Navigation Helper Classes
    var menuParent = $('nav[role="navigation"] ul > li').has('ul').addClass('menuParent');
    var subMenu = $('nav[role="navigation"] ul > li > ul').addClass('subMenu');

    menuParent.hover(function() {
        $(this).addClass('active');
        $(this).children('ul.subMenu').addClass('active');
    }, function() {
        $(this).removeClass('active');
        $(this).children('ul.subMenu').removeClass('active');
    });

});





















