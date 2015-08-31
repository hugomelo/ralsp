jQuery.noConflict();

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
	}
};

(function($) {
	$(function() {
		$('.row.home .projects .project-select a').on('click',ralsp.activateProjectEntry);
		$('.summary').bind('input propertychange', ralsp.countLetters);
	});
})(jQuery);
