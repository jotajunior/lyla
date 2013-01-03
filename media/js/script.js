// JavaScript Document
  


// prettyPhoto
$(document).ready(function(){
						   
// THIS IS CODE FOR THE superfish menu
        $("ul.sf-menu").supersubs({ 
           minWidth:    12,   // minimum width of sub-menus in em units
            maxWidth:    25,   // maximum width of sub-menus in em units
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over

                               // due to slight rounding differences and font-family 
        }).superfish({  animation: {height:'show'},   // slide-down effect without fade-in
            delay:     1000               // 1.2 second delay on mouseout
        });  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
 
// THIS IS CODE FOR THE PRODUCT PAGE CONTENT SLIDER
		//Set the selector in the first tab
				$(".product_detail .TabMenu span:first").addClass("selector");
				//Basic hover action
				$(".product_detail .TabMenu span").mouseover(function(){
					$(this).addClass("hovering");
				});
				$(".product_detail .TabMenu span").mouseout(function(){
					$(this).removeClass("hovering");
				});				
				
				//Add click action to tab menu
				$(".product_detail .TabMenu span").click(function(){
					//Remove the exist selector
					$(".selector").removeClass("selector");
					//Add the selector class to the sender
					$(this).addClass("selector");
					
					//Find the width of a tab
					var TabWidth = $(".TabContent:first").width();
					if(parseInt($(".TabContent:first").css("margin-left")) > 0)
						TabWidth += parseInt($(".TabContent:first").css("margin-left"));
					if(parseInt($(".TabContent:first").css("margin-right")) >0)
						TabWidth += parseInt($(".TabContent:first").css("margin-right"));
					//But wait, how far we slide to? Let find out
					var newLeft = -1* $("span").index(this) * TabWidth;
					//Ok, now slide
					$(".AllTabs").animate({
						left: + newLeft + "px"
					},1000);
				});

						   
// THIS IS CODE FOR THE PRETTY PHOTO PLUGIN						   
		$("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 630,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			
		});
		
		// lightbox image
			$(".papillon_image").append("<span></span>")
					
			$(".papillon_image").hover(function(){
				$(this).find("img").stop().animate({opacity:0.5}, "normal")
			}, function(){
				$(this).find("img").stop().animate({opacity:1}, "normal")
			});
			$(".papillon_video").append("<span></span>")
				
			$(".papillon_video").hover(function(){
				$(this).find("img").stop().animate({opacity:0.5}, "normal")
			}, function(){
				$(this).find("img").stop().animate({opacity:1}, "normal")
			});


// THIS IS CODE FOR THE INFINITE CAROUSEL
(function () {
    $.fn.infiniteCarousel = function () {
        function repeat(str, n) {
            return new Array( n + 1 ).join(str);
        }
        
        return this.each(function () {
            // magic!
            var $wrapper = $('> div', this).css('overflow', 'hidden'),
                $slider = $wrapper.find('> ul').width(9999),
                $items = $slider.find('> li'),
                $single = $items.filter(':first')
                
                singleWidth = $single.outerWidth(),
                visible = Math.ceil($wrapper.innerWidth() / singleWidth),
                currentPage = 1,
                pages = Math.ceil($items.length / visible);
                
            /* TASKS */
            
            // 1. pad the pages with empty element if required
            if ($items.length % visible != 0) {
                // pad
                $slider.append(repeat('<li class="empty" />', visible - ($items.length % visible)));
                $items = $slider.find('> li');
            }
            
            // 2. create the carousel padding on left and right (cloned)
            $items.filter(':first').before($items.slice(-visible).clone().addClass('cloned'));
            $items.filter(':last').after($items.slice(0, visible).clone().addClass('cloned'));
            $items = $slider.find('> li');
            
            // 3. reset scroll
            $wrapper.scrollLeft(singleWidth * visible);
            
            // 4. paging function
            function gotoPage(page) {
                var dir = page < currentPage ? -1 : 1,
                    n = Math.abs(currentPage - page),
                    left = singleWidth * dir * visible * n;
                
                $wrapper.filter(':not(:animated)').animate({
                    scrollLeft : '+=' + left
                }, 500, function () {
                    // if page == last page - then reset position
                    if (page > pages) {
                        $wrapper.scrollLeft(singleWidth * visible);
                        page = 1;
                    } else if (page == 0) {
                        page = pages;
                        $wrapper.scrollLeft(singleWidth * visible * pages);
                    }
                    
                    currentPage = page;
                });
            }
            
            // 5. insert the back and forward link
            $wrapper.after('<a href="#" class="arrow back">&lt;</a><a href="#" class="arrow forward"></a>');
            
            // 6. bind the back and forward links
            $('a.back', this).click(function () {
                gotoPage(currentPage - 1);
                return false;
            });
            
            $('a.forward', this).click(function () {
                gotoPage(currentPage + 1);
                return false;
            });
            
            $(this).bind('goto', function (event, page) {
                gotoPage(page);
            });
            
            // THIS IS NEW CODE FOR THE AUTOMATIC INFINITE CAROUSEL
            $(this).bind('next', function () {
                gotoPage(currentPage + 1);
            });
        });
    };
})(jQuery);


// THIS IS NEW CODE FOR THE AUTOMATIC INFINITE CAROUSEL
    var autoscrolling = false;
    
    $('.infiniteCarousel').infiniteCarousel().mouseover(function () {
        autoscrolling = false;
    }).mouseout(function () {
        autoscrolling = false;
    });
    
    setInterval(function () {
        if (autoscrolling) {
            $('.infiniteCarousel').trigger('next');
        }
    }, 4000);

//Set default open/close settings
$('.acc_container').hide(); //Hide/close all containers
//$('.acc_trigger:first').addClass('active').next().hide(); //Add "active" class to first trigger, then show/open the immediate next container

 $(".acc_trigger").toggle(function(){
 $(this).addClass("acc_active");
 }, function () {
 $(this).removeClass("acc_active");
 }); 

//On Click
$('.acc_trigger').click(function(){


//	if( $(this).next().is(':hidden') ) { //If immediate next container is closed...
$(this).next().slideToggle("slow"); //Add "active" state to clicked trigger and slide down the immediate next container
		//$('.acc_trigger').removeClass('active').next().slideUp(); //Remove all "active" state and slide up the immediate next container
		
	//}
	//return false; //Prevent the browser jump to the link anchor
});

});



