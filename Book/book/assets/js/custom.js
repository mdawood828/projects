/**	
	* Template Name: Kindle
	* Version: 1.0	
	* Template Scripts
	* Author: MarkUps
	* Author URI: http://www.markups.io/

	Custom JS
	
	1. FIXED MENU
	2. MENU SMOOTH SCROLLING
	3. GOOGLE MAP
	4. READER TESTIMONIALS ( SLICK SLIDER )
	5. MOBILE MENU CLOSE 
	
**/



(function( $ ){


	/* ----------------------------------------------------------- */
	/*  1. FIXED MENU
	/* ----------------------------------------------------------- */


		jQuery(window).bind('scroll', function () {
    		if ($(window).scrollTop() > 150) {

		        $('#mu-header').addClass('mu-fixed-nav');
		        
			    } else {
			    $('#mu-header').removeClass('mu-fixed-nav');
			}
		});

		
	/* ----------------------------------------------------------- */
	/*  2. MENU SMOOTH SCROLLING
	/* ----------------------------------------------------------- */ 

		//MENU SCROLLING WITH ACTIVE ITEM SELECTED

		// Cache selectors
		var lastId,
		topMenu = $(".mu-menu"),
		topMenuHeight = topMenu.outerHeight()+13,
		// All list items
		menuItems = topMenu.find('a[href^=\\#]'),
		// Anchors corresponding to menu items
		scrollItems = menuItems.map(function(){
		  var item = $($(this).attr("href"));
		  if (item.length) { return item; }
		});

		// Bind click handler to menu items
		// so we can get a fancy scroll animation
		menuItems.click(function(e){
		  var href = $(this).attr("href"),
		      offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+22;
		  jQuery('html, body').stop().animate({ 
		      scrollTop: offsetTop
		  }, 1500);
		  e.preventDefault();
		});

		// Bind to scroll
		jQuery(window).scroll(function(){
		   // Get container scroll position
		   var fromTop = $(this).scrollTop()+topMenuHeight;
		   
		   // Get id of current scroll item
		   var cur = scrollItems.map(function(){
		     if ($(this).offset().top < fromTop)
		       return this;
		   });
		   // Get the id of the current element
		   cur = cur[cur.length-1];
		   var id = cur && cur.length ? cur[0].id : "";
		   
		   if (lastId !== id) {
		       lastId = id;
		       // Set/remove active class
		       menuItems
		         .parent().removeClass("active")
		         .end().filter("[href=\\#"+id+"]").parent().addClass("active");
		   }           
		})


	/* ----------------------------------------------------------- */
	/*  3. GOOGLE MAP
	/* ----------------------------------------------------------- */ 
		    
	    $('#mu-google-map').click(function () {

		    $('#mu-google-map iframe').css("pointer-events", "auto");

		});
		
		$("#mu-google-map").mouseleave(function() {

		  $('#mu-google-map iframe').css("pointer-events", "none"); 

		});
		
		

	/* ----------------------------------------------------------- */
	/*  4. READER TESTIMONIALS (SLICK SLIDER)
	/* ----------------------------------------------------------- */

		$('.mu-testimonial-slide').slick({
			arrows: false,
			dots: true,
			infinite: true,
			speed: 500,
			autoplay: true,
			cssEase: 'linear'
		});

	/* ----------------------------------------------------------- */
	/*  5. MOBILE MENU CLOSE 
	/* ----------------------------------------------------------- */ 

		jQuery('.mu-menu').on('click', 'li a', function() {
		  $('.mu-navbar .in').collapse('hide');
		});



	
	
})( jQuery );

    /* ----------------------------------------------------------- */
	/*  6. Form Validation 
	/* ----------------------------------------------------------- */ 
/*--Declaration of Variables*/
var minLength = 5;
var maxLength = 20;
var a, b, c, id_text;
/*----Read Function*/
$(document).ready(function(){
    $('#1, #2, #3').on('keydown keyup change', function(){

        $('#sbt').hide();
        var char = $(this).val();
        var charLength = $(this).val().length;
        a=$('#1').val().length;
        b=$('#2').val().length;
        c=$('#3').val().length;
        
        $('#ubt1,#ubt2').hide();

        if(charLength < minLength)
            {
            
            //$('#sp, #sp1, #sp2').text('Length is short, minimum '+minLength+' required.');
            
            $('#ubt1,#ubt2').hide();

            if($(this).attr('id')==1)
                {    
                $('#sp').text(' Your Field '+ $(this).attr('name') +  ' is short');       
                }
            else if($(this).attr('id')==2)
                { 
                $('#sp1').text(' Your Field '+ $(this).attr('name') +  ' is short');       
                }
            else if($(this).attr('id')==3)
                {  
                $('#sp2').text(' Your Field '+ $(this).attr('name') +  ' is short');       
                }
            
            }
            
        else if(charLength > maxLength)
            {   
                
            //$('#sp2').text('Length is not valid, maximum '+maxLength+' allowed.');
            
            $(this).val(char.substring(0, maxLength));
            if($(this).attr('id')==1)
                {
                id_text='#sp';    
                }
            else if($(this).attr('id')==2)
                {
                id_text='#sp1';    
                }
            else if($(this).attr('id')==3)
                {
                id_text='#sp2';    
                }
             $(id_text).text(' Length is not valid, maximum '+maxLength+' allowed.');   
            
            }

          
        else if(a>=5 && a<=20 && b>=5 && b<=20  && c>=5 && c<=20)
            {
                $('#sp').text('');
                $('#sp1').text('');
                $('#sp2').text('');
                $('#sp').addClass('glyphicon glyphicon-ok').removeClass('label label-warning');
                $('#sp1').addClass('glyphicon glyphicon-ok').removeClass('label label-warning');
                $('#sp2').addClass('glyphicon glyphicon-ok').removeClass('label label-warning');
                $('#sbt').show();
            }    

        //if min length >=5//
        
                
        else 
            {
            
            if($(this).attr('id')==1)
                {
                id_text='#sp';    
                }
            else if($(this).attr('id')==2)
                {
                id_text='#sp1';    
                }
            else if($(this).attr('id')==3)
                {
                id_text='#sp2';    
                }
               $(id_text).text(' Done');    
            }
            
            
    });
});
	