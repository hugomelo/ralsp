jQuery.noConflict();

var ralsp_admin = {

	countLetters: function(event) {
		$('chars-counter').update($(this).value.length + " caracteres");
	},

};

(function($) {
	$(function() {
		$('.summary').bind('input propertychange', ralsp_admin.countLetters);
	});
})(jQuery);
