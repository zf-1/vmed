$(document).ready ->

	
	calculation()
	$("#slider-1").slider(
		range: "min"
		value: 1
		min: 1
		max: 46
		step: 1
		slide: (event, ui) ->
			$("#input-cost-auto").val ui.value
			calculation()
	)
	$("#slider-2").slider(
		range: "min"
		value: 4
		min: 1
		max: 15
		step: 1
		slide: (event, ui) ->
			$("#input-term").val ui.value
			calculation()
	)
			

calculation = () ->
	term = parseInt $("#input-term").attr("value")
	cost = parseInt $("#input-cost-auto").attr("value")
	value = cost

	if value == 1
		count = 50000
	if value == 2
		count = 100000
	if value == 3
		count = 150000
	if value == 4
		count = 200000
	if value == 5
		count = 250000
	if value == 6
		count = 300000
	if value == 7
		count = 350000
	if value == 8
		count = 400000
	if value == 9
		count = 450000
	if value == 10
		count = 500000
	if value == 11
		count = 600000
	if value == 12
		count = 700000
	if value == 13
		count = 800000
	if value == 14
		count = 900000
	if value == 15
		count = 1000000
	if value == 16
		count = 1100000	
	if value == 17
		count = 1200000	
	if value == 18
		count = 1300000	
	if value == 19
		count = 1500000	
	if value == 20
		count = 1700000	
	if value == 21
		count = 1900000	
	if value == 22
		count = 2100000	
	if value == 23
		count = 2300000	
	if value == 24
		count = 2500000	
	if value == 25
		count = 2700000
	if value == 26
		count = 2900000	
	if value == 27
		count = 3100000	
	if value == 28
		count = 3300000		
	if value == 29
		count = 3500000	
	if value == 30
		count = 3700000	
	if value == 31
		count = 3900000
	if value == 32
		count = 4100000		
	if value == 33
		count = 4300000	
	if value == 34
		count = 4500000		
	if value == 35
		count = 4700000		
	if value == 36
		count = 5000000	
	if value == 37
		count = 5500000	
	if value == 38
		count = 6000000	
	if value == 39
		count = 6500000	
	if value == 40
		count = 7000000	
	if value == 41
		count = 7500000	
	if value == 42
		count = 8000000	
	if value == 43
		count = 8500000	
	if value == 44
		count = 9000000	
	if value == 45
		count = 9500000	
	if value == 46
		count = 10000000	

	$("#input-cost-auto-absolute").val(count)
	final_sum = count * .85
	

	###
	считаем проценты
	###

	# базовый процент
	switch term
		when 1 then percent = 1.9 #1 неделя
		when 2 then percent = 2.9 #2 неделя
		when 3 then percent = 3.9 #2 неделя
		when 4 then percent = 4.9 #1 месяц
		when 5 then percent = 4.8 #2 месяц
		when 6 then percent = 4.8 #3 месяц
		when 7 then percent = 4.7 #4 месяц
		when 8 then percent = 4.7 #5 месяц
		when 9 then percent = 4.7 #6 месяц
		when 10 then percent = 4.3 #7 месяц
		when 11 then percent = 4.3 #8 месяц
		when 12 then percent = 4.3 #9 месяц
		when 13 then percent = 4.3 #10 месяц
		when 14 then percent = 4.3 #11 месяц
		when 15 then percent = 4 #12 месяц

	if term > 3 and final_sum > 1000000
		formula = Math.ceil((final_sum - 1000000) / 500000)
		percent = percent - .1 * formula
		percent = percent.toFixed(1)
		
		console.log formula, percent, final_sum


	$("#amount-1").html(separator(count))
	$("#input-cost-auto").val(value)


	$("#final-sum").html(separator(final_sum) + " руб.")

	payment = final_sum * percent / 100
	payment = Math.round(payment)
	$("#payment").html(separator(payment) + " руб.")

	if term == undefined
		term = $("#input-term").val()
	if term < 3
		percent_show = "% в неделю"
	else 
		percent_show = "% в месяц"	

	switch term
		when 1 then term_view = "1 неделя"
		when 2 then term_view = "2 недели"
		when 3 then term_view = "3 недели"
		when 4 then term_view = "1 месяц"
		when 5 then term_view = "2 месяца"
		when 6 then term_view = "3 месяца"
		when 7 then term_view = "4 месяца"
		when 8 then term_view = "5 месяца"
		when 9 then term_view = "6 месяцев"
		when 10 then term_view = "7 месяцев"
		when 11 then term_view = "8 месяцев"
		when 12 then term_view = "9 месяцев"
		when 13 then term_view = "10 месяцев"
		when 14 then term_view = "11 месяцев"
		when 15 then term_view = "12 месяцев"

	$("#amount-2").html(term_view)
	$("#percent-payment").html(percent + percent_show)


separator = (n) ->
	return (n + '').split('').reverse().join('').replace(/(\d{3})/g, '$1 ').split('').reverse().join('').replace(/^ /, '')
