(function($) {
	$(document).ready(function(){
		$('#rsvp').on('click', function(){
			$('.overlay, .modal, #close').fadeIn();
			$('body').css('overflow', 'hidden');
			$('body').css('position', 'fixed');
			$('body').css('width', '100%');
		});

		$('#close').on('click', function(){
			$('.overlay, .modal, #close').fadeOut();
			$('body').removeAttr("style");
		})

		$('input[type="radio"]').on('click', function(){
			var guest = $(this).data('guest-id');
			var answer = $(this).data('answer');

			if(answer == 'yes') {
				$('.diet').each(function(){
					if(($(this).data('guest-id') == guest) && $(this).is(':hidden')) {
						$(this).slideDown();
					}
				});
			}
			else if(answer == 'no') {
				$('.diet').each(function(){
					if(($(this).data('guest-id') == guest) && $(this).is(':visible')) {
						$(this).slideUp();
					}
				});
			}
		});
	});
})(jQuery);