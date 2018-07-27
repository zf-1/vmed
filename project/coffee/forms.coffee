$(document).ready ->

	$("#index-order-form .btn").click ->
		sendForm("#index-order-form")
		
	$("#top-callback-form .btn").click ->
		sendForm("#top-callback-form")

	$("#any-form .btn").click ->
		sendForm("#any-form")

	$("#main-request-form .btn").click ->
		sendForm("#main-request-form")

	$("#modal-callback-form .btn").click ->
		sendForm("#modal-callback-form")

	$("#index-phone-form .btn").click ->
		sendForm("#index-phone-form")

	$("#big-form .btn").click ->
		sendForm("#big-form")

	$("#express-application-1 .btn").click ->
		sendForm("#express-application-1")

	$("#express-application-2 .btn").click ->
		sendForm("#express-application-2")

	$("#express-application-3 .btn").click ->
		sendForm("#express-application-3")

	$("#express-application-4 .btn").click ->
		sendForm("#express-application-4")

sendForm = (form) -> 
	form = $(form)
	form.validate()
	if form.valid()
		form.find('.btn').attr('disabled', 'disabled')
		form.slideUp().parent().append('<h4 class="text-center">В ближайшее время наш менеджер свяжется с вами.</h4>')
		return $.post("/forms.php", form.serialize()).done((data) -> {})