$(document).ready(function(){
    $('.button').mousedown(function(){
        $(this).addClass('active');
    }).bind('mouseup mouseout', function(){
        $(this).removeClass('active');
    });
});


$(function() {
    $('table').attr('cellpadding', 0).attr('cellspacing', 0).attr('border', 0);
    $('header, #wrapper > header > div, header li, header a, header em, #wrapper > header ul, footer, #wrapper > section > div > aside nav > ul > li a, #wrapper > section > div > aside nav.global > ul > li > a span, .main-section, .main-content, .main-content > header, .main-content > header .help, .main-content > section, .preview-pane .preview, .listing li, .pagination a, input, button, .button, .button span, textarea, .ui-select, .ui-select span, .ui-file, .ui-date, .message, .message-close, #calroot, #calhead, #calbody, .progress > span, .progress, ul.tabs > li > a, ul.tabs > li, ul.tabs, .panes section, .panes, ul.sidebar-tabs > li > a, ul.sidebar-tabs > li, table.datatable thead th, table.datatable tr, table.datatable td, table.datatable, .accordion > section, .overlay-details').each(function() {
        PIE.attach(this);
    });

    /**
     * Fix balloon in ie
     */
    $('.has-popupballoon').click(function(){
        $(this).siblings().find('.popupballoon').each(function(){
            PIE.detach(this);
        });
        $(this).next().each(function(){
            PIE.attach(this);
        });
    });

    $('.popupballoon .close').click(function(){
        $(this).parents('.popupballoon').each(function(){
            PIE.detach(this);
        });
    });

});
