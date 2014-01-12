/*
    File Name: script.js
    by Tolga Can
    RT-Theme 16
*/

//remove no-js - javascript is enabled
jQuery(document).ready(function() {
	jQuery("html").removeClass="no-js";
});

//100% background
jQuery(window).load(function() {
	jQuery("#background").fullBg();
});
 
// Kwicks extention for RT-Theme
(function($){
    
    $.fn.rt_accordion_effect= function() {
			 
		// If the browser is IE 7-6
		var BSversion = $.browser;
		
		if ( BSversion.msie ) { 
		  var browserNmae = "IE";
		}
		
		var $this = $(this);
		
		var browserVersion = BSversion.version.slice(0,1);
	   
		 if (browserNmae=="IE" && browserVersion<9){
		    
			 $(this).find('ul li .desc_accordion').stop().animate({ "top":"-500" }, 50);
		  
			 $(this).bind("mouseover", function() {
				$(this).find('.desc_accordion').stop().css({  "visibility":"visible", "opacity":"1", "display":"inline-block"});
				$(this).find('.desc_accordion').stop().animate({ "top":"70"}, 500);  	
			 });
		 
			  $(this).bind("mouseleave", function() {
				  $(this).find('.desc_accordion').stop().css({ "opacity":"0" , "display":"none"}, 50);	
			 });
		    
		 }else {
		    
			 $(this).find('.desc_accordion').stop().css({  "visibility":"visible", "opacity":"0",  "display":"inline-block"});
			 
			 $(this).find('.kwicks-border').mouseover(function(){
				
				$(this).find('.desc_accordion').stop().animate({ "opacity":"1"}, 800, "easeIn");    		  
			 }).mouseout(function(){
				$(this).find('.desc_accordion').stop().animate({ "opacity":"0" }, 50, "easeIn");	
			 });
		    
		 }
			 
		this.each(function() {
			
			var kwicks_layer  = $(this);		 
			
			//slide image classname
			var slide_image_classname= $(this).find('div.kwicks-image').attr("id");
		   
			//slide image url
			var slide_image_url= $('.'+slide_image_classname).attr("src");

			//slide image url
			var link= $('.'+slide_image_classname).attr("data-gal");			
		 	if(link=="") kwicks_layer.css({"cursor":"default"});
			
			//kwicks slide background image 
			$('#'+slide_image_classname).css('background-image','url('+slide_image_url+')');

			//slide links
			$('#'+slide_image_classname).click(function() {
			    if(link){
					location.href=link;
			    } 
			});			
 
		});  
	}; 
	
})(jQuery);


//Helper functions for jQuery Cycle
function onBefore(curr, next, opts, fwd) {
	jQuery(next).find('.desc').css({'top':'-110px','opacity':'0'}); 
} 

function onAfter(curr, next, opts, fwd) {
    jQuery(next).find('.desc').animate({'top':'40px','opacity':'1'},800,'easeOutBack');
} 

//drop down menu
jQuery(document).ready(function() {
  
	// If the browser is IE 7-6
	var ua = jQuery.browser;
	if ( ua.msie && ua.version.slice(0,1) < 8 ) { // IE7-6
		 jQuery("#navigation li").parents().each(function() {
			var p = jQuery(this);
			var pos = p.css("position"); 
			    p.hover(function() {
					  jQuery(this).addClass("on-top");
				   },
				   function() {
					  jQuery(this).removeClass("on-top");
				   });
		 });
	}
				
	jQuery("#navigation ul li").each(function()
	{
	 
	 if(jQuery(this).children('ul').length>0){//add sub menu class
	   jQuery(this).addClass('hasSubMenu').text();
	 } 
	 
		jQuery(this).hover(function()
		{
		    var position = jQuery(this).position();
		    var width = jQuery(this).find("a:first-child").width();
		    
			jQuery(this).find('ul:first').stop().css({
				left:width+15,
				top:position.top,
				height:"auto",
				overflow:"hidden",
				zIndex:"1000",
				position:"absolute",
				display:"none"
				}).slideDown(200, function() {
					jQuery(this).css({
					height:"auto",
					overflow:"visible"
				});
		 
		    });
			  
		},
		    
		function()
		{	
			jQuery(this).find('ul:first').stop().slideUp(200, function()
			{	
				  jQuery(this).css({
				  display:"none",
				  overflow:"hidden"
				  });
			});
		});	
	});  
	   
     jQuery("#navigation ul ul ").css({display: ""}); 
	
	jQuery("#navigation2  li").each(function()
	{
		jQuery(this).hover(function()
		{
		    var position = jQuery(this).position();
		    var width = jQuery(this).find("a:first-child").width();
		    
			jQuery(this).find('ul:first').stop().css({
			
				 height:"auto",
				 overflow:"hidden",
				 zIndex:"1000",
				 position:"absolute",
				 display:"none"
				 }).slideDown(200, function()
			{
			jQuery(this).css({
				 height:"auto",
				 overflow:"visible"
			}); 
		});
			  
		},
		    
		function()
		{	
			jQuery(this).find('ul:first').stop().slideUp(200, function()
			{	
				  jQuery(this).css({
				  display:"none",
				  overflow:"hidden"
				  });
			});
		});	
	});

}); 
 

//RT Portfolio Effect
jQuery(window).load(function() {
     
	var portfolio_item=jQuery("a.imgeffect"); 
 		
	portfolio_item.each(function(){
		var imageClass = jQuery(this).attr("class"); // get the class
		var theImage = jQuery(this).html(); 	// save the image
		jQuery(this).find("img").addClass("active");
		jQuery(this).append('<span class="imagemask '+imageClass+'">'+theImage+'</span>'); //create new image within span
		jQuery(this).find('span').parents('img').remove(); //remove image 
	});
		
	jQuery('a.imgeffect .active').remove(); //remove image 
	
	portfolio_item.mouseover(function(){

		portfolio_item.each(function(){
		    jQuery(this).stop().animate({ opacity:"0.5"}, 300, "easeIn");
		});
		
		jQuery(this).stop().animate({ opacity:"1"}, 100, "easeIn");
		jQuery(this).find('img').stop().animate({ top:"-22px" }, 100, "easeIn");
		
		if(jQuery(this).parents().hasClass('blog_list')){
		  jQuery(this).find('.imagemask').stop().animate({ "padding-top":"22px" }, 100, "easeIn");		 
		} 

	}).mouseout(function(){
		portfolio_item.each(function(){
		    jQuery(this).stop().animate({ opacity:"1"}, 200, "easeIn");
		});
		
		jQuery(this).find('.imagemask').stop().animate({ "padding-top":"0px" }, 100, "easeIn");
		jQuery(this).find('img').stop().animate({ top:"0" }, 100, "easeIn"); 	
	});    

});


// Tabs
jQuery(function() {// perform JavaScript after the document is scriptable.
    jQuery("ul.tabs").tabs("> .pane", {effect: 'fade'});
    
    jQuery(".accordion").tabs(".pane", {tabs: '.title', effect: 'slide'});
    jQuery(".scrollable").scrollable();


    jQuery(".items.big_image img").click(function() {
    
       // see if same thumb is being clicked
       if (jQuery(this).hasClass("active")) { return; }
    
       // calclulate large image's URL based on the thumbnail URL (flickr specific)
       var url = jQuery(this).attr("alt");
	 
    
       // get handle to element that wraps the image and make it semi-transparent
       var wrap = jQuery("#image_wrap").fadeTo("medium", 0.5);
    
       // the large image from www.flickr.com
       var img = new Image();
    
    
       // call this function after it's loaded
       img.onload = function() {
    
          // make wrapper fully visible
          wrap.fadeTo("fast", 1);
    
          // change the image
          wrap.find("img").attr("src", url);
    
       };
    
       // begin loading the image from www.flickr.com
       img.src = url;
    
       // activate item
       jQuery(".items img").removeClass("active");
       jQuery(this).addClass("active");
    
    // when page loads simulate a "click" on the first image
    }).filter(":first").click();

});

//Slide to top
jQuery(document).ready(function(){
    jQuery(".line span.top").click(function() {
        jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );
    });
});

//Photo Slider
jQuery(window).load(function(){ 
    if (jQuery('.photo_gallery_cycle').length>0){
	   
	   jQuery(".photo_gallery_cycle ul").each(function(i) {
		   var pager_2 =jQuery(this).parent('div').find('.slider_buttons');
		   jQuery(this).cycle({ 
				    fx:     'fade', 
				    timeout:  10000,
				    pager:  pager_2, 
				    cleartype:  1,
				    pause:           true,     // true to enable "pause on hover"
				    pauseOnPagerHover: true,   // true to pause when hovering over pager link						
					   pagerAnchorBuilder: function(idx) { 
						  return '<a href="#" title=""><img src="'+rttheme_template_dir+'/images/pixel.gif" width="7" heigth="6"></a>'; 
					   }
				});
	   });
    }
});

//Fade effect for photo galleries and flickr
jQuery(window).load(function() {
     
	var flickrItems=jQuery(".flickr_thumbs img");
	
	flickrItems.mouseover(function(){
		
		flickrItems.each(function(){
		    jQuery(this).stop().animate({ opacity:"0.4"}, 300, "easeIn");
		});
		
		jQuery(this).stop().animate({ opacity:"1"}, 100, "easeIn");
		
	}).mouseout(function(){
		flickrItems.each(function(){
		    jQuery(this).stop().animate({ opacity:"1"}, 200, "easeIn");
		});
	});    

}); 

//RT form field - text back function
jQuery(document).ready(function() {

var form_inputs=jQuery(".showtextback");

	form_inputs.each(function(){
	
		jQuery(this).focus( function()
		{
			val = jQuery(this).val();
			if (jQuery(this).attr("alt") != "0"){
			    jQuery(this).attr("alt",jQuery(this).attr("value")); 
			    jQuery(this).attr("value","");
			}
		});
	
		jQuery(this).blur( function(){
			if (jQuery(this).attr("alt") != "0"){
				val = jQuery(this).val(); 
				if (val == '' || val == jQuery(this).attr("alt")){
				    jQuery(this).attr("value",jQuery(this).attr("alt"));
				}
			}
		});
	
		jQuery(this).keypress( function(){  
			jQuery(this).attr("alt","0");	    
		});                 
	});  
         
}); 


//RT Featured Slider
jQuery(document).ready(function() {
     if (jQuery('.sldr_1 ul').length>0){
	   jQuery('.sldr_1').rt_feature_slider({
		  duration: 500,
		  effect: 'slide'	   
	   });
	}
});

//Carousel for product images
jQuery(document).ready(function() {
    if (jQuery('#product_thumbnails').length>0){
	   jQuery('#product_thumbnails').jcarousel({});
    }
}); 



//Effect for product images in carousel
jQuery(document).ready(function() {
     
	var carousel_item=jQuery(".jcarousel-skin-rt a");
	
	carousel_item.mouseover(function(){  
	   jQuery(this).find('img').stop().animate({ opacity:"0.6"}, 200, "easeIn");
	    
	}).mouseout(function(){
	   jQuery(this).find('img').stop().animate({ opacity:"1"}, 100, "easeIn");
	   
	});    
}); 

//Blog Post Types Effect
jQuery(document).ready(function() { 
	var blog_posts=jQuery(".box.blog");
	
	blog_posts.mouseover(function(){
		jQuery(this).find(".post_type").css({ display:"block"});
		jQuery(this).find(".post_type").stop().animate({ opacity:"1"}, 200, "easeIn");
	}),blog_posts.mouseout(function(){
		jQuery(this).find(".post_type").stop().animate({ opacity:"0"}, 200, "easeIn");
		jQuery(this).find(".post_type").css({ display:"none"});
	});

}); 

//tool tips  
jQuery(document).ready(function(){
	jQuery('.j_ttip,.j_ttip2').colorTip({color:'black'});
});


//social media icons  
(function($){ 
    $.fn.rt_social_media_effect= function(options) {
		// If the browser is IE 7-6
		var BSversion = $.browser;
		
		if ( BSversion.msie ) { 
		  var browserNmae = "IE";
		}
		
		var browserVersion = BSversion.version.slice(0,1);		 

		if (browserNmae=="IE" && browserVersion<9){
			return false;
		}
		
		var $this    = $(this);
		var settings = $.extend({}, $.fn.rt_social_media_effect.defaults, options);		
		
		//default settings
		settings = jQuery.extend({
		speed: 200,
		opacity:"0.8",
		effect: 'easeIn'
		}, options);	
						
		$this.on('mouseenter',function(){
			$(this).find("a").stop().animate({position:"relative",marginTop:"-3px"}, settings.speed, settings.effect);	
			$(this).find("img").stop().animate({opacity:settings.opacity}, settings.speed, settings.effect);	
		})

		$this.on('mouseleave',function(){
			$(this).find("a").stop().animate({marginTop:"0"}, settings.speed, settings.effect);	
			$(this).find("img").stop().animate({opacity:"1"}, settings.speed, settings.effect);	
		})		
	}; 
	
})(jQuery); 

jQuery(document).ready(function() {
	jQuery('.social_media_icons li').rt_social_media_effect({	
		speed: 100,
		opacity:"0.7",
		effect: 'easeIn'		
	});
});



//pretty photo
jQuery(document).ready(function(){
	jQuery('a[data-gal]').each(function() {
	    jQuery(this).attr('rel', jQuery(this).data('gal'));
	});  	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',slideshow:false,overlay_gallery: false,social_tools:false,deeplinking:false});
});



//validate contact form
jQuery(document).ready(function(){

      // show a simple loading indicator
      var loader = jQuery('<img src=""+rttheme_template_dir+"images/loading.gif" alt="..." />')
              .appendTo(".loading")
              .hide();
      jQuery().ajaxStart(function() {
              loader.show();
      }).ajaxStop(function() {
              loader.hide();
      }).ajaxError(function(a, b, e) {
              throw e;
      });
      
      jQuery.validator.messages.required = "";
      var v = jQuery("#validate_form").validate({
              submitHandler: function(form) {
                      jQuery(form).ajaxSubmit({
                              target: "#result"
                      });
              }
      });
      
      jQuery("#reset").click(function() {
              v.resetForm();
      });
 });
