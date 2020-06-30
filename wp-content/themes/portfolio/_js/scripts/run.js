jQuery(function($) {
  $(document).ready(function() {

    // $(".swipebox").swipebox({
    //   afterOpen: function() {
    //     var $selectorClose = $("#swipebox-close");
    //     var clickAction = "touchend click";
    //
    //     $selectorClose.unbind(clickAction);
    //
    //     $selectorClose.bind(clickAction, function(event) {
    //       event.preventDefault();
    //       event.stopPropagation();
    //       $.swipebox.close();
    //     });
    //   }
    // });


    // --------------------------------------------------------------------------------------------------
		// Back to Top button
		// --------------------------------------------------------------------------------------------------
		$("#back-top").hide();
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 300) {
					$('#back-top').fadeIn();
				} else {
					$('#back-top').fadeOut();
				}
			});
		});
		$("#back-top").click(function() {
			$("html, body").animate({
			scrollTop: $("body").offset().top
			}, 750);
		});

		if($(window).width() >= 1200) {
			$('.top-area').css('margin-top', $('header').height());
		}

  });
});
