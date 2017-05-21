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

}(jQuery));