$(document).ready ->	
	

	###
	ползунки на странице ДЕПОЗИТ
	###
	$("#dep-slider-1").slider(
		range: "min"
		value: 1000000
		min: 10000
		max: 1000000
		step: 1000
		slide: (event, ui) ->
			$("#dep-amount-1").html(separator(ui.value))
	)
	$("#dep-slider-2").slider(
		range: "min"
		value: 12
		min: 1
		max: 36
		step: 1
		slide: (event, ui) ->
			$("#dep-amount-2").html(separator(ui.value) + " месяцев")
	)
	###
	ползунки на странице ПОДБОР АВТО
	###
	$("#selection-slider").slider(
		range: true
		values: [300000, 1500000]
		min: 10000
		max: 3000000
		step: 1000
		slide: (event, ui) ->
			$("#selection-amount-1").html(separator(ui.values[0]) + "Р.")
			$("#selection-amount-2").html(separator(ui.values[1]) + "Р.")
	)

	###
	ползунки на странице СТРАХОВАНИЕ
	###
	$("#kasko-slider").slider(
		range: "min"
		value: 12
		min: 1
		max: 36
		step: 1
		slide: (event, ui) ->
			$("#kasko-amount").html(separator(ui.value) + " месяца")
	)


separator = (n) ->
	return (n + '').split('').reverse().join('').replace(/(\d{3})/g, '$1 ').split('').reverse().join('').replace(/^ /, '')
