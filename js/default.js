/**
 * Copyright © 2011-2014 EMBL - European Bioinformatics Institute
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); 
 * you may not use this file except in compliance with the License.  
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

(function ($) {
    
function initFooterSitemap() {
    /* copy the mainnavigation to the footer */
    var mainnavi = $('#mn').html();
    $('#footersitemap').html(mainnavi);
}
    
function initWindow() {
    /* if the body is not high enough, put the footer to the bottom of the window */
    var wrapperHeight  = parseInt($('#wrapper').innerHeight());
    var viewportHeight = parseInt(window.innerHeight);
    if (!viewportHeight) {
        /* later IE 9 */
        viewportHeight = parseInt(window.document.documentElement.clientHeight);
    } 
    if (viewportHeight - 50 > wrapperHeight) {
        $('body').addClass('footerToBottom'); 
    } else {
        $('body').removeClass('footerToBottom');
    }
}
    
function initScrolling() {
    /* smooth scrolling for anchor links */
    $('a[href^="#"]').live('click',function (e) {
        e.preventDefault();
        var target = this.hash,
        $target = $(target);
        var topposition = $target.offset().top - 70;
        $('html, body').stop().animate({ 'scrollTop': topposition }, 1000, 'swing', function () {
            /*window.location.hash = target;*/
        });
    });    
}

function initSlider() {
    /* Slider on the frontpage */
    $('.newslide').each(function() {
       $('.sliderbar ul').append('<li><i class="fa fa-circle"></i></li>'); 
    });
    $('.sliderbar li:not(.active)').live('click',function(e) {
        $('.sliderbar li.active').removeClass('active');
        $(this).addClass('active');
        var nr = $(this).index('.sliderbar li');
        showSlide(nr); 
    });
    $('.sliderbar li:first').addClass('active');
var sliderInterval = setInterval(function() {
		var countPointer = $('.sliderbar li').length;
		var activePointer = $('.sliderbar li.active').index('.sliderbar li');
		if (activePointer == countPointer - 1) {
			var nextPointer = 0;
		} else {
			var nextPointer = activePointer + 1;	
		}
		$('.sliderbar li').eq(nextPointer).trigger('click');
	},10000);

}

function showSlide(nr) {
    /* function for the frontpage slider */
    $('.newslide.active').fadeOut(500, function() {
        $('.newslide.active').removeClass('active');
        $('.newslide').eq(nr).hide();
        $('.newslide').eq(nr).addClass('active').fadeIn(500);
    });  
}

function initTooltips() {
    /* general qTip on titles */
    $('[title!=""]').qtip({
        style: { classes: 'qtipimpc' },      
        position: { my: 'top right', at: 'bottom center' }
    });
    /* Override tooltips of "forum topics" */
    $('.forum-table td.views-field-title a').qtip({
        style: { classes: 'qtipimpc' },      
        position: { my: 'top left', at: 'bottom center' }
    });
    /* more advanced tooltips */
    $('.has-tooltip').each(function() {
        $(this).qtip({
            style: { classes: 'qtipimpc' },
            position: { my: 'top right', at: 'bottom center' },
            content: { text: $(this).next('.data-tooltip')}
        });
    });
    /* Tooltips for descriptions in forms */
    $('.form-item').has('.description').each(function() {
        $(this).qtip({
            style: { classes: 'qtipimpc' },
            position: { my: 'center left', at: 'right center' },
            content: { text: $('.description',this) }
        });
    });
    /* Status Tooltips */
    $('.status').qtip({
        style: { classes: 'qtipimpc flat' },      
        position: { my: 'top center', at: 'bottom center' }
    });
}

function initAccordions() {
    /* Accordeon toggle */
    $('.accordion-heading').live('click',function() {
       $(this).next('.accordion-body').toggle('slow'); 
       $(this).closest('.accordion-group').toggleClass('open');
    });
}

function initSections() {
    /* Section toggle */
    $('.section.collapsed .title').live('click',function() {
        $(this).closest('.section').toggleClass('open');
        $(this).next('.inner').fadeToggle(function() { $(window).resize(); if ($('.ajaxtabs .tabs a.active',this).length == 0) { $('.ajaxtabs a:first',this).trigger('click'); } });
    });
    var shortDelay = setTimeout(function() { $('.section.collapsed:first .title').trigger('click'); }, 1500);
}

function initFancybox() {
    /* Fancybox (popup) */
    $('a[href$=".jpg"],.fancyframe').fancybox({'titlePosition':'inside','titleFormat':formatFancyboxTitle});    
    $('.fancybox').fancybox({'type':'image','titlePosition':'inside','titleFormat':formatFancyboxTitle});
}

function formatFancyboxTitle(title, currentObject, currentIndex, currentOpts) {
    if (title) {
        return title;
    } else if ($(currentObject).next('.data-title').html()) {
        // Look, if this fancybox link is followed by an data-title div
        return $(currentObject).next('.data-title').html();
    }
    //return '<div id="tip7-title"><span><a href="javascript:;" onclick="$.fancybox.close();"><img src="/data/closelabel.gif" /></a></span>' + (title && title.length ? '<b>' + title + '</b>' : '' ) + 'Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</div>';
}

function initTablesort() {
    /* Tablesort plugin */
    $('table.tablesorter').tablesorter({
        'cssHeader': 'headerSort'
    }); 
}

function initTableFilter() {
    /* Filter a table (used on gene page) */
    $('.filtertype').live('click',function() {
       $(this).toggleClass('open'); 
       $(this).next('.filteroptions').toggleClass('open'); 
    });
}

function initReduceLongTables() {
    /* Cut long tables and expan them, if needed */
    $('table.reduce').each(function() {
        if ($('tr',this).length > 3) {
            $('tr:gt(3)',this).hide();
            $('tr:last',this).after('<tr class="loadmore"><td colspan="100%"><i class="fa fa-th"></i> show all entries</td></tr>');
        }
    });
    $('tr.loadmore').live('click',function() {
        $(this).prevAll().fadeIn('slow');
        $(this).remove();
        $(this).closest('table').removeClass('reduce');       
    });
    $('.reduce.tablesorter th').live('mouseenter',function() {
        $('tr.loadmore').trigger('click');
    });
}

function initRowtoggle() {
    /* Some tables need to toggle some rows */
   $('tr.clickable').live('click',function() {
       $(this).toggleClass('open');
       if ($(this).hasClass('open')) {
           $('.fa-plus',this).removeClass('fa-plus').addClass('fa-minus');
       } else {
           $('.fa-minus',this).removeClass('fa-minus').addClass('fa-plus');
       }
       $(this).next('tr').fadeToggle('slow');    
   });
}

function initNiceButtons() {
    /* Gives buttons an icon, if they haven't one */
    $('.btn:not(:has(i))').prepend('<i class="fa fa-caret-right"></i>');
    $('.attachment-file .btn i.fa-caret-right').removeClass('fa-caret-right').addClass('fa-download');
}

function initRangeslider() {
    /* jquery UI Slider (for the heatmap) */
   if ($.ui) {   
       $('#rangeslider').slider({
           min: 0,
           max: 1,
           step: 0.001,
           slide: function(event,ui) {
               $('#rangeinput').val(ui.value);
           }
       });
       $('#rangeinput').val( $('#rangeslider').slider('value'));
   }
}

function initHighchartDefaults() {    
    /* Defaults settings for Highcharts */
    if (typeof Highcharts != 'undefined') {
        Highcharts.setOptions({
            chart: {
                style: {
                    fontFamily: '"Source Sans Pro",Arial,Helvetica,sans-serif'
                }
            }   
        });
    }
}

function initMessages() {
    if ($('body').hasClass('page-node') && $('.messages.status').length) {
        $('.messages.status').hide().slideDown(1000);
        setTimeout(function() { $('.messages.status').slideUp(1000); }, 6000);
    }
}

function initTabs() {
    /* Ajax Tabs */
    $('.ajaxtabs').each(function() {
        var ajaxtabs = $(this);
        $('.tabs a',this).live('click',function(e) {
            e.preventDefault();
            var index = $(this).index('.tabs a');
            var tabcontent = $('.tabcontent',ajaxtabs).eq(index);
            
            // show selected .tabcontent
            $('.tabs a',ajaxtabs).removeClass('active');
            $('.tabcontent',ajaxtabs).removeClass('active');
            $(this).addClass('active');
            $(tabcontent).addClass('active').html('<i class="fa fa-spinner fa-spin"></i>');
            
            // load ajax content
            var url = $(tabcontent).attr('data-ajax-url');
            $.ajax({url: url }).done(function(data){ tabcontent.html(data); $(window).resize(); }).error(function(jqXHR,status,msg) { alert('Ajax Error: '+msg); }); 
            
            
        });
    });
    $('.ajaxtabs a:first').not('.collapsed .ajaxtabs a:first').trigger('click');
}

/* Document ready event */
$(document).ready(function() {
        
    /* inits */
    initFooterSitemap();
    initWindow();
    initNiceButtons();
    initScrolling();
    initSections();
    initAccordions();
    initSlider();
    initMessages();
    initReduceLongTables();
    initRowtoggle();
    initTabs();

    /* init js plugins */
    initFancybox();
    initTablesort();
    initTooltips();
    
    /* init Highcharts */
    initHighchartDefaults(); 
    
    /* init special functions */
    initTableFilter();
    initRangeslider();            
    
});

/* Window scrolling event */
$(window).scroll(function() {
    
    if ($(window).scrollTop() > 20) {
      $('body').addClass('pinned');
    } else { 
      $('body').removeClass('pinned');  
    }

});

/* Window resize event */
$(window).resize(function() {
    
    initWindow();

});

})(jQuery);
jQuery.noConflict();
