/* 
 * Copyright (C) 2014 Rezaur
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

 var bdyElms = document.querySelectorAll('textarea, select, input, table');
 var elmsNum = bdyElms.length;
  if(elmsNum >= 1  ){
       for(var i = 0; i < elmsNum; i++){
         //  console.log(bdyElms[i].localName);
            if(bdyElms[i].type === 'submit' || bdyElms[i].type === 'reset'){
              bdyElms[i].setAttribute('class', 'btn btn-default');  
            }else if(bdyElms[i].type === 'checkbox' || bdyElms[i].type === 'radio'){
                 bdyElms[i].setAttribute('class', '');   
            }else if(bdyElms[i].localName === 'table'){
              bdyElms[i].setAttribute('class', 'table table-bordered');   
            }
            else{
              bdyElms[i].setAttribute('class', 'form-control'); 
            }
       }
  }

//GLOBALS
jQuery(document).ready(function () {    
    //Remove info/warning bar after 15 sec
    setTimeout( "jQuery('.alert-warning').fadeOut('slow');",15000 );

    var $ = jQuery;  
    $( 'input.search-field' ).addClass( 'form-control' );
    $( '.comment-reply-link' ).addClass( 'btn btn-primary' );
    $( '#commentsubmit' ).addClass( 'btn btn-primary' );
    $( 'input.search-field' ).addClass( 'form-control' );
    $( 'input.search-submit' ).addClass( 'btn btn-default' );
    $( '.widget_rss ul' ).addClass( 'media-list' );
    $( '.widget_meta ul, .widget_recent_entries ul, .widget_archive ul, .widget_categories ul, .widget_nav_menu ul, .widget_pages ul' ).addClass( 'nav' );
    $( '.widget_recent_comments ul#recentcomments' ).css( 'list-style', 'none').css( 'padding-left', '0' );
    $( '.widget_recent_comments ul#recentcomments li' ).css( 'padding', '5px 15px');
    $( 'table#wp-calendar' ).addClass( 'table table-striped');
    
    //show time
    $(document.body).removeClass('loading').delay(800).fadeIn(1400);
    //Back to top link smoth scroll
	var offset = 220;
	var duration = 500;
	$(window).scroll(function() {
	if ($(this).scrollTop() > offset) {
		$('.back-to-top').fadeIn(duration);
	} else {
		$('.back-to-top').fadeOut(duration);
		}
	});
	
	$('.back-to-top').click(function(event) {
	event.preventDefault();
	$('html, body').animate({scrollTop: 0}, duration);
	return false;
	})

});
