/**
 * Slovopys theme custom scripts
 */

/**
 * jQuery self-invoking wrapper
 * @param {type} $ jQuery
 * @returns {undefined}
 */
(function($) {
    
// on load.
$(window).load(function() {
    var footerFixer = new FooterFixer('footer', ['header', '.menu-main', '#page_content']);

    // on resize footer fix.
    $(window).resize(function () {
        footerFixer.fix();
    }).trigger('resize');
    
    initScrollTop();
});

$(document).ready(function() {
    $('.news-carousel').owlCarousel({
        loop: true,
        nav: true,
        navText: ['<!-- prev -->','<!-- next -->'],
        autoHeight:true,
        responsive:{
            0:{
                items:1
            },
            1000:{
                items:2
            }
        }
    });
});

/**
 * Footer fixer hack
 * @param string selector Footer selector
 * @param array contentSelectors
 * @returns {start_L2.FooterFixer}
 */
var FooterFixer = function(selector, contentSelectors) {
    var self = this;
    
    if (!selector) {
        selector = 'footer';
    }
    
    if (!contentSelectors) {
        contentSelectors = ['header', '#content'];
    }
    
    var footerHeight = 0;

    this.getFooterHeight = function() {
        return footerHeight;
    };
    
    this.updateFooter = function() {
        footerHeight = $(selector).outerHeight();
    };
    this.updateFooter();
    
    this.fix = function() {
        var contentHeight = footerHeight;
        var windowHeight = $(window).height();
        for (var i in contentSelectors) {
            contentHeight += $(contentSelectors[i]).outerHeight();
        }
        
        if (windowHeight < contentHeight) {
            $(selector).removeClass('fixed fixed-bottom');
        } else {
            $(selector).addClass('fixed fixed-bottom');
        }
    };
};

/**
 * 
 * @returns {Boolean}
 */
var initScrollTop = function() {
    var btnTop = $('#btn-top');
    if (btnTop.length < 1) {
        return false;
    }
    
    btnTop.fadeOut();
    $(document).scroll(function() {
        if ($(this).scrollTop() > 0) {
            btnTop.fadeIn();
        } else {
            btnTop.fadeOut();
        }
    });

    btnTop.click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
    return true;
}

}(jQuery));