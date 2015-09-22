//jQuery.noConflict();

var ralsp = {
	activateProjectEntry: function(event) {
		if (event)
			event.preventDefault();

		// for project links
		var menuLinks = jQuery(this).parent().find('a');
		menuLinks.removeClass('active');
		jQuery(this).addClass('active');

		// for description
		var index = menuLinks.index(jQuery(this));
		var desc  = jQuery(this).parent().siblings('.project-desc').children();
		desc.removeClass('active');
		desc.eq(index).addClass('active');
	},

	countLetters: function(event) {
		console.log($(this).value.length);
		$('chars-counter').update($(this).value.length + " caracteres");
	},

	showEventPage: function(event) {
		if (event)
			event.preventDefault();

		var active = jQuery(this).hasClass('active');
		if (!active) {
			jQuery(this).siblings().removeClass('active');
			jQuery(this).addClass('active');

			if (jQuery(this).hasClass('newer')) {
				jQuery('.agenda .incoming').slideDown();
				jQuery('.agenda .occurred').slideUp();
			} else {
				jQuery('.agenda .incoming').slideUp();
				jQuery('.agenda .occurred').slideDown();
			}

		}
	},
};

(function($) {
	$(function() {
		$('.row.home .projects .project-select a').on('click',ralsp.activateProjectEntry);
		$('.summary').bind('input propertychange', ralsp.countLetters);
		$('.agenda.menu .newer, .agenda.menu .older').on('click', ralsp.showEventPage);
	});
})(jQuery);
