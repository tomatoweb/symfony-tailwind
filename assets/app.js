/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';
import $ from 'jquery';
import welcome from './js/welcome.js';

$(function() {

  //$('body').prepend('<h1>' + welcome('Gary') + '</h1>');

  // on clicking user menu dropdown button
  $('#user-menu-button').on("click", function() {
		$('#user-menu').toggleClass('opacity-0');
    $('#user-menu > a').toggleClass('pointer-events-none');
	});

  // hide dropdown user menu on click outside user button
  $('body').on("click", function(evt){
    if(!$(evt.target).is('#user-img')) {
        $('#user-menu').addClass('opacity-0');
        if(!$('#user-menu > a').hasClass('pointer-events-none'))
          $('#user-menu > a').toggleClass('pointer-events-none');
    }
  });

  // open dialog: product details
  $('.dialog-btn').on("click", function() {
    let id = $(this).attr('id');
    console.log(id);
		$('#dialog'+id).removeClass('opacity-0 pointer-events-none');
	});
  
  // close dialog: product details
  $('.close-dialog-btn').on("click", function() {
    let id = $(this).attr('id');
		$('#dialog'+id).addClass('opacity-0 pointer-events-none');
	});
})
