$(document).ready ->

	$(".top-info .close").click ->
		$(".top-info").slideUp(333)

	timelineCount = 0

	$(".timeline .place .section").each ->
		timelineCount+=1
	$(".timeline .place").addClass("count-"+timelineCount)

	$(".faq .faq-place .question").click ->
		$(this).toggleClass "open"
		$(this).closest("li").find(".answer").slideToggle(333)


	$(".faq .big-list-block .list li.has-children >span").click ->
		$(this).closest(".has-children").find("ul").slideToggle(333)
		$(this).toggleClass "open"
	
	$(".info-text-block .tabs ul li").click ->
		open = $(this).attr("data-open")
		$(".info-text-block .tabs ul li").removeClass "active"
		$(this).addClass "active"

		$(".info-text-block .text-block").slideUp(333)
		$(".info-text-block .text-block.block-"+open).slideDown(333)


	$(".switcher").click ->
		$(this).toggleClass "off"
	$(".header .level-1 .search").click ->

		$(".hidden-search").css 
			"left": 0
		setTimeout (->
			$(".hidden-search").addClass "open"			
		), 108

	$(document).click (event) ->
		#console.log event
		if $(event.target).closest('.hidden-search.open').length
			#alert()
		else 
			if $(".hidden-search").hasClass "open"
				$(".hidden-search.open").css 
					"left": "-100%"
				$(".hidden-search").removeClass "open"	
		event.stopPropagation()

	$(".sandwich-menue ul li a").click ->
		count = 0
		$(this).closest("li").find("ul").each ->	
			count += 1
		if count != 0
			$(this).closest("li").find("ul").slideToggle(333)
			$(this).closest("li").toggleClass "active"
			return false

	$(".price-block .services .list >ul >li").click ->
		if $(this).closest(".price-block").hasClass "type-two"
			return false
		else 
			$(this).toggleClass "open"
			$(this).find("ul").slideToggle(333)
	
	$(".vac-list .tabs ul li").click ->
		open = $(this).attr("data-open")
		$(".vac-list .tabs ul li").removeClass "active"
		$(this).addClass "active"

		$(".hidden-blocks .block").slideUp(333)
		$(".hidden-blocks .block.block-"+open).slideDown(333)

	$(".reviews-list .tabs ul li").click ->
		open = $(this).attr("data-open")
		$(".reviews-list .tabs ul li").removeClass "active"
		$(this).addClass "active"

		$(".hidden-blocks .block").slideUp(333)
		$(".hidden-blocks .block.block-"+open).slideDown(333)

	$(".about-doctor .tabs ul li").click ->
		open = $(this).attr("data-open")
		$(".about-doctor .tabs ul li").removeClass "active"
		$(this).addClass "active"

		hiddenBlocksSlider = $(".hidden-blocks-slider").data('owlCarousel')
		hiddenBlocksSlider.goTo(open)

	$('.scrollbar-outer').scrollbar()
	
	$("select").styler(
		selectPlaceholder: "Выбрать"
		selectSmartPositioning: no
	)
	$(".fancybox").fancybox()

	$(".sandwich").click ->
		if $(this).hasClass "open"
			$(this).removeClass "open"
			closeSandwich()
		else 
			$(this).addClass "open"
			openSandwich()

	$(".show-cut").click ->
		if $(this).hasClass "active"
			$(this).removeClass "active"
			$(this).closest(".container").find(".cut").slideUp(333)
			$(this).html "Подробнее"
		else
			$(this).addClass "active"
			$(this).closest(".container").find(".cut").slideDown(333)
			$(this).html "Скрыть"

	month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь']
	days = ['Вс','Пн','Вт','Ср','Чт','Пт','Сб']

	
	$(".submit-this").click ->
		$(this).closest("form").submit()

	$('input').iCheck
		checkboxClass: 'icheckbox_minimal-red'
		radioClass: 'iradio_minimal-red'
		increaseArea: '20%'
		
	$(".certificates-slider-one").owlCarousel
		navigation: no
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: yes
		touchDrag: yes
		autoPlay: no
		navigationText: no
		autoHeight: yes

	$(".certificates-slider-two").owlCarousel
		navigation: yes
		pagination: no
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: no
		touchDrag: yes
		autoPlay: no
		items: 4
		navigationText: no

	$(".doctors-slider").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: no
		touchDrag: yes
		autoPlay: no
		items: 4
		navigationText: no

	$(".where-slider").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: no
		touchDrag: yes
		autoPlay: no
		items: 2
		navigationText: no
		itemsDesktop: [1240,2]
		itemsDesktopSmall : [1000,2]
		itemsTablet : [600,1]

	$(".all-news-slider .list").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: no
		touchDrag: yes
		autoPlay: no
		items: 5
		autoHeight: yes
		navigationText: no
		#itemsDesktop: [1240,2]
		#itemsDesktopSmall : [1000,2]
		#itemsTablet : [600,1]

	$(".articles-slider").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: no
		touchDrag: yes
		autoPlay: no
		items: 2
		navigationText: no
		itemsDesktop: [1240,2]
		itemsDesktopSmall : [1000,2]
		itemsTablet : [600,1]

	$(".index-slider").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: yes
		touchDrag: yes
		autoPlay: no
		navigationText: no

	$(".example-slider").owlCarousel
		navigation: no
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: yes
		touchDrag: yes
		autoPlay: no
		navigationText: no

	$(".review-slider").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: yes
		touchDrag: yes
		autoPlay: no
		navigationText: no

	$(".vac-list-slider .list-slider").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: yes
		touchDrag: yes
		autoPlay: no
		autoHeight: yes
		navigationText: no

	$(".slider-actions-block").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: yes
		touchDrag: yes
		autoPlay: no
		navigationText: no

	$(".slider-new-programs").owlCarousel
		navigation: yes
		pagination: yes
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: no
		items: 1
		touchDrag: yes
		autoPlay: no
		navigationText: no
		itemsDesktop: [1240,1]
		itemsDesktopSmall : [800,2]
		itemsTablet : [640,1]

	$(".hidden-blocks-slider").owlCarousel
		navigation: no
		pagination: no
		slideSpeed: 444
		paginationSpeed: 333
		singleItem: yes
		touchDrag: yes
		autoPlay: no
		navigationText: no
		autoHeight: yes
		afterAction: ->
			current = this.owl.currentItem
			#$(".hidden-blocks-slider").attr("data-current-slide", current)
			hiddenBlocksSlider = $(".hidden-blocks-slider").data('owlCarousel')
			#hiddenBlocksSlider.goTo(current)
			openTab = parseInt(current) + 1
			$(".about-doctor .tabs ul li").removeClass "active"
			$(".about-doctor .tabs ul li:nth-child(" + openTab + ")").addClass "active"



	resizeModalWindows()
	resizeSandwich()

	$(".get-register").click ->
		openModalWindow("#register-form-place")
		return false

	$(".get-callback").click ->
		openModalWindow("#callback-form-place")
		return false

	$(".get-resume").click ->
		openModalWindow("#resume-form-place")
		return false
	
	$(".modal-window .icons-close, .darkness, .sandwich-menue .title").click ->
		closeModalWindows()
		closeSandwich()

	# /menue/
	$(".menue-list .title").click ->		
		$(this).closest(".section").find(".row").slideToggle(108)
		$(this).toggleClass("active")

	# adaptive menue
	$(".open-adaptive-menue").click ->
		#openSandwich()		

	$(".open-hidden-buttons").click ->
		closeAdaptiveMenue()
		$(".hidden-buttons-menue").show()
		$(".darkness").show()

$(window).resize ->
	resizeModalWindows()
	resizeSandwich()

$(window).scroll ->
	if $("body").hasClass("open-modal-window")
		#
	else 
		window.currentScroll = getBodyScrollTop()

openModalWindow = (xx) ->
	closeAdaptiveMenue()
	xx = $(xx)
	$("body").addClass("open-modal-window")
	$(".modal-window").hide()
	xx.show()
	xx.css
		"position": "absolute"
	$(".wrapper").css
		"position": "fixed"
		"top": currentScroll * -1
	$(".darkness").show()

closeModalWindows = ->
	xx = $(".modal-window")
	xx.hide()
	xx.css
		"position": "absolute"
	$(".wrapper").css
		"position": "relative"
		"top": 0
	$(".darkness").hide()
	closeAdaptiveMenue()
	scrollCurrent()
	$("body").removeClass("open-modal-window")

closeAdaptiveMenue = ->
	$(".adaptive-menue").hide()

resizeModalWindows = ->
	wHeight = $(window).height() / 10
	$(".modal-window .place").css
		"marginTop": wHeight

resizeSandwich = ->
	
	wWidth = $(window).width()
	wHeight = $(window).height()
	denominator = 3

	if wWidth < 800 
		denominator = 2
	if wWidth < 700
		denominator = 1.5	
	if wWidth < 600
		denominator = 1.25

	#$(".sandwich-menue").width(wWidth / denominator)
	$(".sandwich-menue").css
		"height":wHeight - 48
	

openSandwich = ->
	#$(".darkness").show()
	$(".sandwich-menue").addClass "open"
closeSandwich = ->
	#$(".sandwich").addClass "open"
	$(".sandwich-menue").removeClass "open"

resizeCells = (object) ->
	#функция которая делает одинаковой высоту во всех блоках .cell
	if object == undefined
		object = $(".cell-need-resize .cell")
	blocksArray = []
	object.each ->
		blockHeight = $(this).height()
		blocksArray.push blockHeight
	#а теперь узнаем самое большое значение в массиве
	blocksMax = Math.max.apply null, blocksArray
	#это и есть высота которая будет задана всем блокам
	object.css 
		"height": blocksMax

getBodyScrollTop =  ->
	return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop)

scrollCurrent = () ->
	$('html, body').animate
		scrollTop: currentScroll
	,0
scrollTo = (target) ->
	scrollPath = $(target).offset().top - 40
	$('html, body').animate
		scrollTop: scrollPath
	,333