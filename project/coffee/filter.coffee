$(document).ready ->

	$("#range-slider").slider
		range: true,
		min: 0,
		max: 3146000,
		values: [0, 3146000],
		slide: (event, ui) ->
			console.log ui.values[0],ui.values[1]
	
	$("#accuracy-slider").slider
		range: true,
		min: 20,
		max: 400,
		values: [20, 400],
		slide: (event, ui) ->
			console.log ui.values[0],ui.values[1]
	
