jQuery(function() {

	$("#index-order-form").each(function(){
		defaultValidate($(this));
	});

	$("#top-callback-form").each(function(){
		validatePhone($(this));
	});

	$("#any-form").each(function(){
		defaultValidate($(this));
	});

	$("#callback-form").each(function(){
		defaultValidate($(this));
	});

	$("#modal-callback-form").each(function(){
		defaultValidate($(this));
	});

	$("#reservation-form").each(function(){
		defaultValidate($(this));
	});

	$("#big-form").each(function(){
		defaultValidate($(this));
	});

	$("#main-request-form").each(function(){
		defaultValidate($(this));
	});

	$("#index-phone-form").each(function(){
		defaultValidate($(this));
	});

	$("#main-callback-form").each(function(){
		defaultValidate($(this));
	});

	$("#express-application-1").each(function(){
		defaultValidate($(this));
	});

	$("#express-application-2").each(function(){
		defaultValidate($(this));
	});

	$("#express-application-3").each(function(){
		defaultValidate($(this));
	});

	function defaultValidate(element) {
		$(element).validate({ 
			focusInvalid: false,
			focusCleanup: true,
			ignore: "",
			rules: {
				phone: {required: true},
				name: {required: true}
				// email: {required: true, email: true}
			},      
			errorPlacement: function(error, element) {
				var er = element.attr("name");
				error.appendTo( element.parent().find("span.red_text"));
			} 
		});
	}

	function validatePhone(element) {
		$(element).validate({ 
			focusInvalid: false,
			focusCleanup: true,
			ignore: "",
			rules: {
				phone: {required: true}
			},      
			errorPlacement: function(error, element) {
				var er = element.attr("name");
				error.appendTo( element.parent().find("span.red_text"));
			} 
		});
	}
	$.mask.definitions['d'] = '[1-69]';
	$('input.input_phone').mask("+7 (d99) 999-99-99", {placeholder:"_"});
	$('input.phone').mask("+7 (d99) 999-99-99", {placeholder:"_"});
});