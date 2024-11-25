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

  // on clicking user menu button
  $('#user-menu-button').on("click", function() {
		$('#user-menu').toggleClass('opacity-1 opacity-0');
		$('#user-menu > a').toggleClass('pointer-events-auto pointer-events-none');
	});

  // on clicking outside of user menu
  $('body').on("click", function(evt){    
    if(!$(evt.target).is('#user-img')) {
      if($('#user-menu').hasClass('opacity-1')) {
        $('#user-menu').removeClass('opacity-1').addClass('opacity-0');
        $('#user-menu > a').removeClass('pointer-events-auto').addClass('pointer-events-none');
      }
    }
});
  
})
