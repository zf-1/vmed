var w = window.innerWidth;
$(function() {
    var input_type = ['input', 'select', 'textarea'];
    var w = window.innerWidth;
    $('.tabs > ul > li').first().addClass('active');
    $('.reviews-list').find('.tabs > ul > li').removeClass('active');
    $('.price-block .tabs li').on('click', function() {
        var ind = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.services .list').hide().siblings().eq(ind).fadeIn();
    });
    $("#feedback-form-place").find('select[name=feedback_type]').on('change', function() {
        var vl = $(this).val();
        var form = $(this).closest('form');
        var ajax_res = form.find('.ajax_res');
        if (vl == 'false') {
            ajax_res.html('').hide();
        } else {
            $.post('/local/templates/nuvmed/nks/ajax.php', 'type=' + vl, function(data) {
                ajax_res.html(data).show();
            })
        }
    });
    $("#feedback-form-place").find('.btn').on('click', function() {
        var form = $(this).closest('form');
        var go = 0;
        form.find('[data-require=1]').each(function() {
            if ($(this).attr('name') == 'feedback_type') {
                if ($(this).val() == 'false') {
                    $(this).siblings('.jq-selectbox__select').css('border-color', 'red');
                    go++;
                } else {
                    $(this).siblings('.jq-selectbox__select').css('border-color', '');
                }
            } else {
                if (!$(this).hasClass('jq-selectbox')) {
                    if ($(this).val() == '') {
                        $(this).css('border-color', 'red');
                        go++;
                    } else {
                        $(this).css('border-color', '');
                    }
                }
            }
        });
        if (go > 0) {
            return;
        };
        $.post('/local/templates/nuvmed/nks/ajax.php', form.serialize(), function(data) {
        	console.log(data);
            $('#feedback-form-place').find('.title-form div').html('<h3>Благодарим за отзыв.</h3>').parent().siblings('.form-place').remove();
        })
    });
    $('.callme_sub').click(function() {
        var form = $(this).closest('form');
        var go = 0;
        form.find('input').each(function() {
            if ($(this).val() == '') {
                $(this).addClass('input_error');
                go++;
            } else {
                $(this).removeClass('input_error');
            }
        });
        if (go == 0) {
            fio = form.find('input[name="fio"]').val();
            phone = form.find('input[name="phone"]').val();
            console.log(fio, phone);
            $.ajax({
                type: "POST",
                url: "/local/ajax/lid.php",
                data: "fio=" + fio + "&phone=" + phone + "&calls=1",
                success: function(msg) {
                    yaCounter21109396.reachGoal('priem');
                    ga('send', 'event', 'order', 'callback');
                    var h = new Date();
                    if (h.getHours() >= 8 && h.getHours() <= 19) {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение! Наши операторы свяжутся с Вами в течение часа.</h4>');
                    } else {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение!</h4>');
                    }
                }
            });
        }
        return false;
    });
    $('#modal-callback-form .btn').click(function() {
        var form = $(this).closest('form');
        var go = 0;
        form.find('input[type=text]').each(function() {
            if ($(this).val() == '') {
                $(this).addClass('input_error');
                go++;
            } else {
                $(this).removeClass('input_error');
            }
        });
        if (go == 0) {
            fio = form.find('input[name="name"]').val();
            phone = form.find('input[name="phone"]').val();
            comment = form.find('textarea[name="comment"]').val();
            clinic = form.find('input[name="clinic"]').val();
            $.ajax({
                type: "POST",
                url: "/local/ajax/lid.php",
                data: "fio=" + fio + "&phone=" + phone + "&calls=1" + "&comment=" + comment + "&clinic=" + clinic,
                success: function(msg) {
                    form.find('input[name="clinic"]').val('');
                    yaCounter21109396.reachGoal('obrzv');
                    ga('send', 'event', 'order', 'callback');
                    var h = new Date();
                    if (h.getHours() >= 8 && h.getHours() <= 19) {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение! Наши операторы свяжутся с Вами в течение часа.</h4>');
                    } else {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение!</h4>');
                    }
                }
            });
        }
        return false;
    });
    $('.zapis_sub').click(function() {
        var form = $(this).closest('form');
        var go = 0;
        input_type.forEach(function(item, i, input_type) {
            form.find(item).each(function() {
                if ($(this).val() == '' && this.nodeName != 'TEXTAREA') {
                    $(this).addClass('input_error');
                    go++;
                } else {
                    $(this).removeClass('input_error');
                }
            });
        });
        if (go == 0) {
            fio = form.find('input[name="name"]').val();
            phone = form.find('input[name="phone"]').val();
            clinika = form.find('select[name="clinic"]').val();
            povod = form.find('textarea[name="comment"]').val();
            to = $("h1.title").text();
            $.ajax({
                type: "POST",
                url: "/local/ajax/lid.php",
                data: "fio=" + fio + "&phone=" + phone + "&clinika=" + clinika + "&povod=" + povod + "&to=" + to,
                success: function(msg) {
                    yaCounter21109396.reachGoal('zps');
                    ga('send', 'event', 'order', 'callback');
                    var h = new Date();
                    if (h.getHours() >= 8 && h.getHours() <= 19) {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение! Наши операторы свяжутся с Вами в течение часа.</h4>');
                    } else {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение!</h4>');
                    }
                }
            });
        }
        return false;
    });

    $('.zapis2_sub').click(function() {
        var form = $(this).closest('form');
        var go = 0;
        input_type.forEach(function(item, i, input_type) {
            form.find(item).each(function() {
                if ($(this).val() == '') {
                    $(this).addClass('input_error');
                    go++;
                } else {
                    $(this).removeClass('input_error');
                }
            });
        });
        if (go == 0) {
            /*phone = form.find('input[name="phone"]').val();
            fio = form.find('input[name="fio"]').val();
            fast_rec_type = form.find('input[name="fast_rec_type"]').val();*/
            var data = form.serialize();
            to = $("h1.title").text();
            data += '&to='+to;
            $.ajax({
                type: "POST",
                url: "/local/ajax/lid.php",
                data: data,
                success: function(msg) {
                    console.log(msg);
                    yaCounter21109396.reachGoal('priem');
                    ga('send', 'event', 'order', 'callback');
                    var h = new Date();
                    if (h.getHours() >= 8 && h.getHours() <= 19) {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение! Наши операторы свяжутся с Вами в течение часа.</h4>');
                    } else {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение!</h4>');
                    }
                }
            });
        }
        return false;
    });

    $(".show-more a").on('click', function() {
        if ($(this).text() == 'Подробнее') {
            $(this).text('Скрыть').parent().siblings('.text').find('span').css({
                'display': 'inline'
            });
        } else {
            $(this).text('Подробнее').parent().siblings('.text').find('span').css({
                'display': ''
            });
        }
    })
    $('.where a').each(function() {
        var adr = $(this).data('name');
        var myselect = $('#modal-register-form').find('select[name=clinic]');
        $('<option/>', {
            val: adr,
            text: adr
        }).prependTo(myselect);
    })
    setTimeout(function() {
        $('input, select').trigger('refresh');
    }, 1);
    $(".switcher").click(function() {
        if ($(this).hasClass('off')) {
            $(this).siblings('input').val('');
        } else {
            $(this).siblings('input').val('Y');
        };
    });
    $(".doc_filter_sub").on('click', function() {
        $(".show-more").attr('data-curpage', 1);
        $('.spec_select li').removeClass('active_spec');
        $('.letters li').removeClass('active');
        $('form[name=arrFilter_form]').find('input[name=LETTER]').val('');
        var query = getFilter();
        setFilter(query);
        if (w < 1185) {
            var to_filter = $('.result-list').offset().top;
            $('body, html').animate({
                scrollTop: to_filter - 55
            }, 300);
        }
    });
    $(".spec_select li").on('click', function() {
        var id = $(this).data('id');
        $(this).addClass('active_spec').siblings().removeClass('active_spec');
        $('.letters li').removeClass('active');
        clearFilter();
        var form = $('form[name=arrFilter_form]');
        form.find('select[name=SPECIAL]').val(id);
        setTimeout(function() {
            $('input, select').trigger('refresh');
        }, 1);
        var query = getFilter();
        setFilter(query);
    });
    $(".doc_page.letters li").on('click', function() {
        var letter = $(this).find('span').text();
        $('.spec_select li').removeClass('active_spec');
        $(this).addClass('active').siblings().removeClass('active');
        clearFilter();
        setTimeout(function() {
            $('input, select').trigger('refresh');
        }, 1);
        var form = $('form[name=arrFilter_form]');
        form.find('input[name=LETTER]').val(letter);
        var query = getFilter();
        setFilter(query);
    });
    $(".doc_page .pag_links").on('click', 'li', function() {
        $(this).addClass('cur_page').children('a').addClass('current').parent().siblings().each(function() {
            $(this).removeClass('cur_page').children('a').removeClass('current');
        })
        var num = $(this).find('a').text();
        var query = getFilter();
        query += '&page=' + num;
        $.post('/local/components/ivit/spec.main/templates/.default/ajax.php', query, function(data) {
            $('.result-list').html(data);
        })
    });
    $(".doc_page.pag .prev").on('click', function() {
        $('.pag_links').find('.cur_page').prev().trigger('click');
    });
    $(".doc_page.pag .next").on('click', function() {
        $('.pag_links').find('.cur_page').next().trigger('click');
    });
    $(".doc_page.to-start span").on('click', function() {
        if (w > 1185) {
            $('.pag_links li').first().trigger('click');
        } else {
            var to_filter = $('.filter').offset().top;
            $('body, html').animate({
                scrollTop: to_filter - 55
            }, 300);
        }
    });
    clearFilter();
    if (w < 1185) {
        if (location.pathname == '/uslugi/') {
            setServicsFilter({});
        } else {
            setFilter('set_filter=Y');
        }
    }
    $(".doc_page.show-more").on('click', function() {
        var cur_page = $(this).attr('data-curpage');
        cur_page++;
        $(this).attr('data-curpage', cur_page);
        var query = getFilter();
        query += '&append=1&page=' + cur_page;;
        setFilter(query);
    });
    $('.page-corporative-serv').prev('.breadcrumbs').addClass('dark_bg');
    $('.price-type-2').find('.list').first().show();
    setCorpPriceHeight(0);
    $('#clinic_select').on('change', function() {
        var num = $(this).val();
        $(this).closest('.select').siblings('.list').hide().eq(num).fadeIn();
    })
    $(".show-more-price").on('click', function() {
        $(this).hide();
        $('.price-type-2').find('.list').each(function() {
            $(this).height('auto');
        })
    })
    $(".service_page .letters li").on('click', function() {
        clearServiceFilter();
        var letter = $(this).find('span').text();
        $(this).addClass('active');
        var data = {
            'letter': letter
        };
        setServicsFilter(data);
    })
    $(".service_page .result-list .s-item").on('click', function() {
        var link = $(this).find('.level-1').children('a').attr('href');
        location.href = link;
    })
    $(".service_page .pag_links").on('click', 'li', function() {
        var num = $(this).find('a').text();
        var prev = $(this).siblings('.cur_page').text();
        var last_class = $('.s-item:not(.group_0)').last().attr('data-last');
        $(this).addClass('cur_page').children('a').addClass('current').parent().siblings().each(function() {
            $(this).removeClass('cur_page').children('a').removeClass('current');
        })
        if (last_class > 20) {
            if (prev <= 20 && num == ' ... ') {
                var links = '<li><a href="javascript:void(0)"> ... </a></li>';
                links += '<li class="cur_page"><a href="javascript:void(0)" class="current">21</a></li>';
                for (var i = 22; i <= last_class; i++) {
                    links += '<li><a href="javascript:void(0)">' + i + '</a></li>';
                };
                $('.pag_links').html(links);
            }
            if (prev >= 21 && num == ' ... ') {
                var links = '';
                for (var i = 1; i <= 19; i++) {
                    links += '<li><a href="javascript:void(0)">' + i + '</a></li>';
                };
                links += '<li class="cur_page"><a href="javascript:void(0)" class="current">20</a></li>';
                links += '<li><a href="javascript:void(0)"> ... </a></li>';
                $('.pag_links').html(links);
            }
        }
        if (num == ' ... ') {
            if (prev <= 20 && num == ' ... ') {
                $('.result-list .s-item').removeClass('vis').siblings('.group_21').addClass('vis');
            }
            if (prev >= 21 && num == ' ... ') {
                $('.result-list .s-item').removeClass('vis').siblings('.group_20').addClass('vis');
            }
        } else {
            $('.result-list .s-item').removeClass('vis').siblings('.group_' + num).addClass('vis');
        }
    });
    $(".service_page.pag .prev").on('click', function() {
        $('.pag_links').find('.cur_page').prev().trigger('click');
    });
    $(".service_page.pag .next").on('click', function() {
        $('.pag_links').find('.cur_page').next().trigger('click');
    });
    $(".service_page.to-start span").on('click', function() {
        if (w > 1185) {
            $('.pag_links li').first().trigger('click');
        } else {
            var to_filter = $('.filter').offset().top;
            $('body, html').animate({
                scrollTop: to_filter - 55
            }, 300);
        }
    });
    $(".service_select li").on('click', function() {
        clearServiceFilter();
        var parentid = $(this).data('parentid');
        $(this).addClass('active_spec');
        var data = {
            'parentid': parentid
        };
        setServicsFilter(data);
    });
    $(".service_filter_sub").on('click', function() {
        clearServiceFilter(1);
        var data = {};
        var form = $('form[name=arrFilter_form]');
        data.id = (form.find('select[name=id]').val() == 'Услуга') ? '' : form.find('select[name=id]').val();
        data.parentid = (form.find('select[name=parentid]').val() == 'Раздел') ? '' : form.find('select[name=parentid]').val();
        data.clinic = (form.find('select[name=clinic]').val() == 'Клиника') ? '' : form.find('select[name=clinic]').val();
        data.forchild = form.find('input[name=forchild]').val();
        setServicsFilter(data);
        if (w < 1185) {
            var to_filter = $('.result-list').offset().top;
            $('body, html').animate({
                scrollTop: to_filter - 55
            }, 300);
        }
    });
    $('.show-more.service_page').on('click', function() {
        var curpage = $(this).attr('data-curpage');
        ++curpage;
        $('.s-item.group_' + curpage).addClass('vis');
        $(this).attr('data-curpage', curpage);
        var last_class = $('.s-item:not(.group_0)').last().attr('data-last');
        if (curpage == last_class) {
            $(this).hide();
        }
    });
    $(".search_in").keyup(function(event) {
        if (event.keyCode == 13) {
            clearServiceFilter('s');
            if ($(this).val() != '') {
                var data = {
                    'search': $(this).val()
                };
                setServicsFilter(data);
            } else {
                setServicsFilter({});
            }
        }
    });
    $(".search_in_price").keyup(function(event) {
        if (event.keyCode == 13) {
            var txt = $(this).val().toLowerCase();
            var pattern = new RegExp(txt);
            var txtLength = txt.length;
            var cl = $(this).hasClass('cl_search') || false;
            if (cl) {
                $('.p_lvl_1').removeClass('vis_more');
                $('.cl_showmore').hide();
            };
            $('.services .list').each(function() {
                $(this).find('li.p_lvl_1').each(function() {
                    if (txtLength == 0) {
                        $(this).removeClass('open notvis').find('ul').hide().find('li').removeClass('notvis');
                        if (cl) {
                            $('.p_lvl_1:gt(9)').addClass('vis_more');
                            $('.cl_showmore').show().find('.btn').text('Показать ещё 10 услуг');
                        };
                    } else {
                        var elemTxt = $(this).find('.sect_name').text().toLowerCase();
                        var status = pattern.test(elemTxt);
                        if (status) {
                            $(this).addClass('open').removeClass('notvis').find('ul').show().find('li').removeClass('notvis');
                            if (elemTxt.length == txtLength) {
                                return true;
                            }
                        } else {
                            $(this).removeClass('open').addClass('notvis').children('ul').hide();
                        }
                        $(this).find('li.p_lvl_2').each(function() {
                            var elemTxt = $(this).children('span').eq(0).text().toLowerCase();
                            var status = pattern.test(elemTxt);
                            if (status) {
                                $(this).removeClass('notvis').parent('ul').show().parent('.p_lvl_1').addClass('open').removeClass('notvis');
                            } else {
                                $(this).addClass('notvis');
                            }
                        })
                    }
                });
            })
        }
    })
    $(".corporative-serv-head").find('.btn.red2').click(function() {
        openModalWindow("#callback-form-place");
    });
    $(".land_video").click(function() {
        openModalWindow("#dermablate");
    });
    $(".land_met").click(function() {
        openModalWindow("#dermablate_text");
        console.log(scr);
        var scr = $(document).scrollTop();
        $("#dermablate_text").offset({ top: scr});
    });
    $(".set_fdb").click(function() {
        openModalWindow("#feedback-form-place");
    });
    var prog_title = $('.prog_title').text();
    var prog_clinics = $('select[name=p_select_clinic]').html();
    $("#register_to_prog-form-place").find('input[name=prog_name]').val(prog_title);
    $("#register_to_prog-form-place").find('select[name=clinic]').html(prog_clinics);
    setTimeout(function() {
        $('input, select').trigger('refresh');
    }, 1);
    $('.prog_serv').on('click', function() {
        $('.vis_more').each(function() {
            $(this).removeClass('vis_more');
        })
        $(this).hide();
    })
    $(".reg_to_prog").click(function() {
        openModalWindow("#register_to_prog-form-place");
    });
    $('select[name=p_select_clinic]').on('change', function() {
        var ind = this.options.selectedIndex;
        var price = $(this).find(':selected').data('price');
        $("#register_to_prog-form-place").find('select[name=clinic]').children().eq(ind).prop('selected', true).siblings().prop('selected', false);
        setTimeout(function() {
            $('input, select').trigger('refresh');
        }, 1);
        $('.cell.price').find('span').text(price);
    })
    $('.zapis_to_prog_sub').click(function() {
        var form = $(this).closest('form');
        var go = 0;
        input_type.forEach(function(item, i, input_type) {
            form.find(item).each(function() {
                if ($(this).val() == '') {
                    $(this).addClass('input_error');
                    go++;
                } else {
                    $(this).removeClass('input_error');
                }
            });
        });
        if (go == 0) {
            fio = form.find('input[name="name"]').val();
            phone = form.find('input[name="phone"]').val();
            email = form.find('input[name="email"]').val();
            clinika = form.find('select[name="clinic"]').val();
            povod = form.find('textarea[name="comment"]').val();
            prog_name = form.find('input[name="prog_name"]').val();
            $.ajax({
                type: "POST",
                url: "/local/ajax/lid.php",
                data: "fio=" + fio + "&phone=" + phone + "&email=" + email + "&clinika=" + clinika + "&povod=" + povod + "&prog_name=" + prog_name,
                success: function(msg) {
                    var h = new Date();
                    if (h.getHours() >= 8 && h.getHours() <= 19) {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение! Наши операторы свяжутся с Вами в течение часа.</h4>');
                    } else {
                        form.slideUp().parent().append('<h4 class="text-center">Благодарим за обращение!</h4>');
                    }
                }
            });
        }
        return false;
    });
    $(".prog_sect_tostart").on('click', function() {
        var to_filter = $('.all-programs').offset().top;
        $('body, html').animate({
            scrollTop: to_filter - 55
        }, 300);
    });
    $(".prog_filter_sub").on('click', function() {
        var form = $(this).closest('form');
        var data = {};
        data.clinic = (form.find('select[name=clinic]').val() == 'Клиника') ? '' : form.find('select[name=clinic]').val();
        data.forchild = form.find('input[name=forchild]').val();
        var vis = 0;
        $('.programs-result .item').each(function(i) {
            $(this).removeClass('vis_more');
            var clinic = '' + $(this).data('clinic') || '';
            var forchild = $(this).data('forchild') || '';
            var show = 0;
            if (data.clinic != '' && (clinic.indexOf(data.clinic) == -1 || clinic == '')) {
                show++;
            }
            if (data.forchild != '' && data.forchild != forchild) {
                show++;
            }
            if (show == 0) {
                vis++;
                $(this).removeClass('group_0').addClass('group_1');
            } else {
                $(this).removeClass('group_1').addClass('group_0');
            }
        });
        if (vis > 5) {
            $('.prog_serv').show();
            $('.programs-result .item.group_1').each(function(i) {
                if (i > 4) {
                    $(this).addClass('vis_more');
                };
            })
        } else {
            $('.prog_serv').hide();
        }
        if (w < 1185) {
            var to_filter = $('.filter').offset().top;
            $('body, html').animate({
                scrollTop: to_filter - 55
            }, 300);
        }
    })
    $(".skidka-result-place .item").on('click', function() {
        var link = $(this).find('.more').children('a').attr('href');
        location.href = link;
    })
    $(".ac_filter_sub").on('click', function() {
        var form = $(this).closest('form');
        var data = {};
        data.clinic = (form.find('select[name=clinic]').val() == 'Клиника') ? '' : form.find('select[name=clinic]').val();
        var vis = 0;
        $('.skidka-result-place .item').each(function(i) {
            $(this).removeClass('vis_more');
            var clinic = '' + $(this).data('clinic') || '';
            var forchild = $(this).data('forchild') || '';
            var show = 0;
            if (data.clinic != '' && (clinic.indexOf(data.clinic) == -1 || clinic == '')) {
                show++;
            }
            if (show == 0) {
                vis++;
                $(this).removeClass('group_0').addClass('group_1');
            } else {
                $(this).removeClass('group_1').addClass('group_0');
            }
        });
        if (vis > 5) {
            $('.skidka-result-place .item.group_1').each(function(i) {
                if (i > 4) {
                    $(this).addClass('vis_more');
                };
            })
            var more = $('.vis_more').length;
            if (more >= 5) {
                $('.ac_more').show().find('.button').text('Показать еще 5 акций');
            } else {
                var art = ' акций';
                switch (more) {
                    case 1:
                        art = ' акцию';
                        break;
                    case 2:
                    case 3:
                    case 4:
                        art = ' акции';
                }
                $('.ac_more').show().find('.button').text('Показать еще ' + more + art);
            }
        } else {
            $('.ac_more').hide();
        }
        if (w < 1185) {
            var to_filter = $('.filter').offset().top;
            $('body, html').animate({
                scrollTop: to_filter - 55
            }, 300);
        }
    })
    $('.ac_more').on('click', function() {
        $('.vis_more:lt(5)').removeClass('vis_more');
        var more = $('.vis_more').length;
        if (!more) {
            $(this).hide();
        } else {
            if (more >= 5) {
                $(this).show().find('.button').text('Показать еще 5 акций');
            } else {
                var art = ' акций';
                switch (more) {
                    case 1:
                        art = ' акцию';
                        break;
                    case 2:
                    case 3:
                    case 4:
                        art = ' акции';
                }
                $(this).show().find('.button').text('Показать еще ' + more + art);
            }
        }
    })
    $(".ac_tostart").on('click', function() {
        var to_filter = $('.filter').offset().top;
        if (w < 1185) {
            to_filter -= 55;
        }
        $('body, html').animate({
            scrollTop: to_filter
        }, 300);
    });
    $('.page-one-skidka').prev('.breadcrumbs').addClass('dark_bg');
    $(".ac_call_sub").click(function() {
        var clinic = $(this).closest('form').find('select[name=clinic]').val();
        if (clinic != 'Выбрать клинику') {
            $('#modal-callback-form').find('input[name=clinic]').val(clinic);
        } else {
            $('#modal-callback-form').find('input[name=clinic]').val('');
        }
        openModalWindow("#callback-form-place");
    });
    $('.page-one-article').prev('.breadcrumbs').addClass('dark_bg');
    $(".art_tostart").on('click', function() {
        var to_filter = $('.filter').offset().top;
        if (w < 1185) {
            to_filter -= 55;
        }
        $('body, html').animate({
            scrollTop: to_filter
        }, 300);
    });
    $(".art_more").on('click', function() {
        var g = $(this).attr('data-curpage');
        g++;
        $(this).attr('data-curpage', g);
        $('.list-place').find('.group_' + g).removeClass('vis_more');
        var more = $('.list-place').find('.vis_more').length;
        if (!more) {
            $(this).hide();
        } else {
            if (more >= 6) {
                $(this).find('.button').text('Показать еще 6 статей');
            } else {
                var art = ' статей';
                switch (more) {
                    case 1:
                        art = ' статью';
                        break;
                    case 2:
                    case 3:
                    case 4:
                        art = ' статьи';
                }
                $(this).find('.button').text('Показать еще ' + more + art);
            }
        }
    })
    $("select[name=tags]").on('change', function() {
        var tag = $(this).val();
        if (history.pushState) {
            if (tag == 0) {
                history.pushState(null, null, ' ');
            } else {
                history.pushState(null, null, '#' + tag);
            }
        } else {
            if (tag == 0) {
                location.hash = ' ';
            } else {
                location.hash = '#' + tag;
            }
        }
        setArtFilter();
    })
    $(".popular-tags").find('li').on('click', function() {
        setArtFilter();
    })
    setArtFilter();
    $(".an_tostart").on('click', function() {
        to_top('.all-news-list');
    })
    $('.an_more').on('click', function() {
        var cup = $(this).attr('data-curpage');
        cup++;
        $(this).attr('data-curpage', cup);
        $('.all-news-list').find('.group_' + cup).removeClass('vis_more');
        var vis = $('.all-news-list').find('.item.vis_more').length;
        if (!vis) {
            $(this).attr('data-curpage', 1).hide();
        } else {
            if (vis >= 6) {
                $(this).find('.button').text('Показать еще 6 новостей');
            } else {
                var art = ' новостей';
                switch (vis) {
                    case 1:
                        art = ' новость';
                        break;
                    case 2:
                    case 3:
                    case 4:
                        art = ' новости';
                }
                $(this).find('.button').text('Показать еще ' + vis + art);
            }
        }
    })
    $('.main_more').on('click', function() {
        $('.result.res_2').show().siblings('.result').hide();
        $(this).hide();
    })
    $('.main_show_all').on('click', function() {
        $('.result.res_1').show().siblings('.result').hide();
        $('.main_more').show();
    })
    $('.main_filter a:not(.main_show_all)').on('click', function() {
        var
        let = $(this).text();
        $('.result.res_3 ul').html('');
        $('.result.res_2').find('li[data-letter="' +
            let +'"]').clone(true).appendTo('.result.res_3 ul');
        $('.result.res_3').show().siblings('.result').hide();
        $('.main_more').hide();
    })
    $('.cl_showmore').on('click', function() {
        $('.p_lvl_1.vis_more:lt(9)').removeClass('vis_more');
        var ln = $('.p_lvl_1.vis_more').length;
        var art = ' услуг';
        switch (ln) {
            case 1:
                art = ' услугу';
                break;
            case 2:
            case 3:
            case 4:
                art = ' услуги';
        }
        if (!ln) {
            $(this).hide();
        };
        if (ln >= 10) {
            $(this).find('.btn').text('Показать ещё 10 услуг');
        } else {
            $(this).find('.btn').text('Показать ещё ' + ln + art);
        }
    })
    $('.fdb_tostart').on('click', function() {
        to_top('.tabs');
    })
    $('.fdb_shomore').on('click', function() {
        var list = $(this).siblings('.list');
        list.find('.vis_more:lt(5)').removeClass('vis_more');
        var ln = list.find('.vis_more').length;
        var art = ' отзывов';
        switch (ln) {
            case 1:
                art = ' отзыв';
                break;
            case 2:
            case 3:
            case 4:
                art = ' отзыва';
        }
        if (!ln) {
            $(this).hide();
        };
        if (ln >= 5) {
            $(this).find('.button').text('Показать ещё 5 отзывов');
        } else {
            $(this).find('.button').text('Показать ещё ' + ln + art);
        }
    })
    $('#fdb_tabs li').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active');
        var type = $(this).data('type');
        $('.hidden-blocks .' + type).fadeIn().siblings().hide();
    })
    $('.vac_tostart').on('click', function() {
        to_top('.tabs');
    })
    $('.vac_shomore').on('click', function() {
        var list = $(this).siblings('.list');
        list.find('.vis_more:lt(5)').removeClass('vis_more');
        var ln = list.find('.vis_more').length;
        var art = ' вакансий';
        switch (ln) {
            case 1:
                art = ' вакансию';
                break;
            case 2:
            case 3:
            case 4:
                art = ' вакансии';
        }
        if (!ln) {
            $(this).hide();
        };
        if (ln >= 5) {
            $(this).find('.button').text('Показать ещё 5 вакансий');
        } else {
            $(this).find('.button').text('Показать ещё ' + ln + art);
        }
    })
    $('.page-one-vac').prev('.breadcrumbs').addClass('dark_bg');
    $('.get-resume').on('click', function() {
        var name = $('h1.title').text();
        $('#modal-resume-form').find('input[name=vac_name]').val(name);
    })
    $('#pict').on('change', function() {
        if ($(this).val() != '') {
            $(this).siblings('span').text($(this).val());
        }
    })
    $('#modal-resume-form').on('submit', function(e) {
        e.preventDefault();
        if (valid_form($(this))) {
            var $that = $(this),
                formData = new FormData($that.get(0));
            $('#loading').show();
            $.ajax({
                url: '/local/components/nks/news_clinics/templates/vac/bitrix/news.detail/.default/post.php',
                type: $that.attr('method'),
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                success: function(json) {
                    if (json) {
                        $('#loading').hide();
                        var notice = $('.k_notice');
                        switch (json) {
                            case 1:
                                notice.addClass('k_err').html('Прикрепите пожалуйста файл');
                                break;
                            case 2:
                                notice.addClass('k_err').html('Файл должен быть формата PNG, JPG или PDF');
                                break;
                            case 3:
                                notice.addClass('k_err').html('Файл слишком большой. Максимальный размер 10 Мб');
                                break;
                            case 4:
                                notice.addClass('k_err').html('Что-то пошло не так. Попробуйте позже');
                                break;
                            case 10:
                                $('#modal-resume-form').html('<h3>Благодарим за ваше обращение.<br> В ближайшее время с вами свяжется сотрудник отдела кадров.<br> Телефон для связи 8(495)150-03-03 доб. 3421</h3>');
                                break;
                        }
                        console.log(json);
                    }
                }
            });
        }
    });
    $('.faq_sect span').on('click', function() {
        clearFaq(1);
        var id = $(this).data('id');
        var num = 1;
        $('.res_ul>li').each(function() {
            var sect = $(this).data('sect');
            if (sect == id) {
                $(this).removeClass('not_show').find('.f_num').text(num);
                num++;
            } else {
                $(this).addClass('not_show');
            }
        })
        if (num > 11) {
            $('.faq_more').show();
        } else {
            $('.faq_more').hide();
        }
    })
    $('.faq_select').on('change', function() {
        clearFaq(1);
        var id = $(this).val();
        if (id == '') {
            return;
        };
        var num = 1;
        $('.res_ul>li').each(function() {
            var sect = $(this).data('sect');
            if (sect == id) {
                $(this).removeClass('not_show').find('.f_num').text(num);
                num++;
            } else {
                $(this).addClass('not_show');
            }
        })
    })
    $(".f_search").keyup(function(event) {
        if (event.keyCode == 13) {
            if ($(this).val() != '') {
                clearFaq();
                searchFaq($(this).val());
            } else {
                clearFaq(2);
            }
        }
    });
    $(".faq_more").on('click', function() {
        $('.res_ul>li').removeClass('vis_more');
        $(this).hide();
    });
    $(".owl_1").owlCarousel({
        items: 3,
        navigation: false,
        pagination: true,
        slideSpeed: 444,
        paginationSpeed: 333,
        touchDrag: true,
        autoPlay: false,
        navigationText: false,
        autoHeight: true
    });
    var pag_height = $('.owl-pagination').height();
    if (w < 1185) {
        pag_height -= 15;
    }
    $('.owl-carousel').css('padding-bottom', pag_height + 'px');
    $(window).on('scroll', function() {
        var targ = $('.header > .level-1');
        var h = $('.header > .level-1').height();
        var rbtop = targ.offset().top;
        var bb = $('.footer').offset().top;
        var curw = $(document).width();
        var cursr = $(document).scrollTop();
        var par_top = $('.header').offset().top + $('.header').height();
        if (curw > 1184) {
            if ($('.top_b').offset().top <= cursr) {
                if (!targ.hasClass('fixedBlock')) {
                    targ.addClass('fixedBlock');
                    $('.top_b').css('height', h + 'px');
                }
            } else {
                if (targ.hasClass('fixedBlock')) {
                    targ.removeClass('fixedBlock');
                    $('.top_b').css('height', '');
                }
            };
            if (rbtop >= bb) {
                if (!targ.hasClass('hideBlock')) {
                    targ.addClass('hideBlock');
                }
            } else {
                if (targ.hasClass('hideBlock')) {
                    targ.removeClass('hideBlock');
                }
            };
        };
    })
})

function clearFaq(f) {
    var full = f || false;
    $('.res_ul>li').each(function(i) {
        $(this).removeClass('vis_more');
        if (full) {
            var num = ++i;
            $(this).removeClass('not_show').find('.f_num').text(num);
        }
        if (full == 2) {
            if (i > 10) {
                $(this).addClass('vis_more')
            }
            if (num > 11) {
                $('.faq_more').show();
            }
        }
        var o_q = $(this).find('.original_q').html();
        var o_a = $(this).find('.original_a').html();
        $(this).find('.question').removeClass('open').find('.set_q').html(o_q).parent().siblings('.answer').html(o_a).hide();
    })
}

function searchFaq(req) {
    var search = req.toLowerCase();
    var pattern = new RegExp(search);
    var num = 1;
    $('.res_ul>li').each(function(i) {
        var q = $(this).find('.original_q').html();
        var a = $(this).find('.original_a').html();
        var low_q = q.toLowerCase();
        var low_a = a.toLowerCase();
        var status_q = pattern.test(low_q);
        var status_a = pattern.test(low_a);
        if (status_q || status_a) {
            $(this).removeClass('not_show').find('.question').addClass('open').find('.f_num').text(num).parent().siblings('.answer').show();
            if (status_q) {
                text = q.replace(new RegExp(search, "gim"), "<font class='red_select'>$&</font>");
                $(this).find('.set_q').html(text);
            }
            if (status_a) {
                text = a.replace(new RegExp(search, "gim"), "<font class='red_select'>$&</font>");
                $(this).find('.answer').html(text);
            }
            num++;
        } else {
            $(this).addClass('not_show');
        }
    })
}

function valid_form(form) {
    var res = true;
    form.find(':input[required]').each(function() {
        console.log($(this));
        if ($(this).val() == '') {
            if ($(this).attr('id') == 'pict') {
                $(this).parent().css('background', 'red');
            } else {
                $(this).addClass('input_error');
            }
            res = false;
        } else {
            if ($(this).attr('id') == 'pict') {
                $(this).parent().css('background', '');
            } else {
                $(this).removeClass('input_error');
            }
        }
    })
    return res;
}

function to_top(cl) {
    var to_filter = $(cl).offset().top;
    if (w < 1185) {
        to_filter -= 55;
    }
    $('body, html').animate({
        scrollTop: to_filter
    }, 300);
}

function setArtFilter() {
    setTimeout(function() {
        var hs = location.hash.slice(1);
        hs = decodeURI(hs);
        $("select[name=tags] option").each(function() {
            var vl = $(this).text();
            if (vl == hs) {
                $(this).prop('selected', true);
            } else {
                $(this).prop('selected', false);
            }
            setTimeout(function() {
                $('input, select').trigger('refresh');
            }, 1);
        })
        $('.list-place').find('.item').removeClassWild('group_*').removeClass('vis_more');
        if (hs == '') {
            $('.list-place').find('.item').each(function(i) {
                var cnt = ++i;
                var g = Math.ceil(cnt / 6);
                $(this).addClass('group_' + g);
                if (i > 6) {
                    $(this).addClass('vis_more');
                }
            })
            $(".art_more").attr('data-curpage', 1).show().find('.button').text('Показать еще 6 статей');
        } else {
            $('.list-place').find('.item').each(function(i) {
                var tags = $(this).data('tags');
                console.log(tags);
                if (tags.indexOf(hs) == -1) {
                    $(this).addClass('group_0');
                }
            })
            $('.list-place').find('.item:not(.group_0)').each(function(i) {
                var ind = ++i;
                var g = Math.ceil(ind / 6);
                $(this).addClass('group_' + g);
                if (i > 6) {
                    $(this).addClass('vis_more');
                }
            });
            var vis = $('.list-place').find('.item.vis_more').length;
            if (!vis) {
                $(".art_more").attr('data-curpage', 1).hide();
            } else {
                if (vis >= 6) {
                    $(".art_more").attr('data-curpage', 1).show().find('.button').text('Показать еще 6 статей');
                } else {
                    var art = ' статей';
                    switch (vis) {
                        case 1:
                            art = ' статью';
                            break;
                        case 2:
                        case 3:
                        case 4:
                            art = ' статьи';
                    }
                    $(".art_more").attr('data-curpage', 1).show().find('.button').text('Показать еще ' + vis + art);
                }
            }
        }
    }, 100);
}

function clearServiceFilter(f) {
    var f = f || 0;
    $(".service_select li").removeClass('active_spec');
    $(".service_page .letters li").removeClass('active');
    $(".show-more").attr('data-curpage', 1);
    if (f == 0 || f == 's') {
        var form = $('form[name=arrFilter_form]');
        form.find('select').each(function() {
            if ($(this).attr('name') == 'id') {
                $(this).val('Услуга');
            }
            if ($(this).attr('name') == 'parentid') {
                $(this).val('Раздел');
            }
            if ($(this).attr('name') == 'clinic') {
                $(this).val('Клиника');
            }
        })
        form.find('input[name=forchild]').val('');
        form.find('.switcher').addClass('off');
        setTimeout(function() {
            $('input, select').trigger('refresh');
        }, 1);
    }
    if (f != 's') {
        $(".search_in").val('');
    }
};

function setServicsFilter(data) {
    data.id = data.id || '';
    data.parentid = data.parentid || '';
    data.clinic = data.clinic || '';
    data.forchild = data.forchild || '';
    data.letter = data.letter || '';
    data.search = data.search || '';
    if (w < 1185) {
        data.cnt = 6;
    } else {
        data.cnt = 9;
    }
    var group = 1;
    $('.s-item').each(function(i) {
        $(this).removeClass('vis');
        var id = $(this).data('id');
        var parentid = $(this).data('parentid');
        var forchild = $(this).data('forchild');
        var letter = $(this).data('letter');
        var clinic = $(this).data('clinics');
        var realname = $(this).data('realname');
        var search = $(this).find('.level-1 a').text();
        var show = 0;
        if (data.clinic != '' && (clinic.indexOf(data.clinic) == -1 || clinic == '')) {
            show++;
        }
        if (data.id != '' && data.id != id) {
            show++;
        }
        if (data.parentid != '' && data.parentid != parentid) {
            show++;
        }
        if (data.forchild != '' && data.forchild != forchild) {
            show++;
        }
        if (data.letter != '' && data.letter != letter) {
            show++;
        }
        var pos = '';
        if (data.search != '') {
            var l_data_search = data.search.toLowerCase();
            var l_search = search.toLowerCase();
            if (l_search.indexOf(l_data_search) == -1) {
                show++;
            } else {
                text = search.replace(new RegExp('^([^<>]*)(' + data.search + ')([^<>]*)$', "gi"), "$1<font color='red'>$2</font>$3");
                $(this).find('.level-1 a').html(text);
            }
            $('h2.sect_name').html(data.search);
        } else {
            $(this).find('.level-1 a').text(realname);
            $('h2.sect_name').html('');
        }
        if (show == 0) {
            var g = Math.ceil(group / data.cnt);
            $(this).removeClassWild('group_*').addClass('group_' + g);
            if (g == 1) {
                $(this).addClass('vis')
            };
            group++;
        } else {
            $(this).removeClassWild('group_*').addClass('group_0');
        }
        $(this).attr('data-last', '');
    })
    if (data.parentid != '') {
        var elem = $('.service_select').find('li[data-parentid=' + data.parentid + ']');
        var name = elem.text();
        var url = elem.data('url');
        var link = $('<a/>', {
            href: url,
            text: name
        });
        $('h2.sect_name').html(link);
    } else {
        if (data.search != '') {
            $('h2.sect_name').html(data.search);
        } else {
            $('h2.sect_name').html('');
        }
    }
    var g = Math.ceil((group - 1) / data.cnt);
    $('.s-item:not(.group_0)').last().attr('data-last', g);
    var cnt_vis = 0;
    $('.s-item:not(.group_0)').each(function(i) {
        cnt_vis++;
        var ii = ++i;
        var delim = data.cnt / 3;
        if (ii % delim == 0) {
            $(this).css('margin-right', '0');
        } else {
            $(this).css('margin-right', '1.444%');
        }
    })
    $('#zero_res').remove();
    if (cnt_vis == 0) {
        var zero = $('<h3/>', {
            text: 'По вашему запросу ничего не найдено, попробуйте изменить запрос или воспользуйтесь фильтром разделов услуг',
            id: 'zero_res'
        });
        $('.result-list').prepend(zero);
    }
    $('.count').children().eq(0).text(cnt_vis);
    var cnt_vis_str = cnt_vis + '';
    var digit = cnt_vis_str.slice(-1);
    if (['0', '5', '6', '7', '8', '9'].indexOf(digit) != -1 || cnt_vis_str == '11') {
        $('.count').children().eq(1).text('Услуг');
    }
    if (['2', '3', '4'].indexOf(digit) != -1) {
        $('.count').children().eq(1).text('Услуги');
    }
    if (digit == '1' && cnt_vis_str != '11') {
        $('.count').children().eq(1).text('Услуга');
    }
    var g = Math.ceil(group / data.cnt);
    if (g < 2) {
        $('.paginator').hide();
    } else {
        var links = '<li class="cur_page"><a href="javascript:void(0)" class="current">1</a></li>';
        for (var i = 2; i <= g; i++) {
            if (i == 21) {
                links += '<li><a href="javascript:void(0)"> ... </a></li>';
                break;
            }
            links += '<li><a href="javascript:void(0)">' + i + '</a></li>';
        };
        $('.pag_links').html(links);
        $('.paginator').show();
    }
    if (cnt_vis < 7) {
        $('.show-more.service_page').hide();
    } else {
        $('.show-more.service_page').show();
    }
}

function setCorpPriceHeight(cnt) {
    var list = $('.price-type-2:not(.full_price)').find('.list').eq(cnt);
    var h = 0;
    for (var i = 0; i < 10; i++) {
        h += list.find('li').eq(i).outerHeight();
    };
    $('.price-type-2:not(.full_price)').find('.list').each(function() {
        $(this).height(h);
    })
}

function getFilter() {
    var form = $('form[name=arrFilter_form]');
    var ID = form.find('select[name=ID]').val();
    var SPECIAL = form.find('select[name=SPECIAL]').val();
    var CLINIC = form.find('select[name=CLINIC]').val();
    var CHILD = form.find('input[name=CHILD]').val();
    var LETTER = form.find('input[name=LETTER]').val();
    return 'ID=' + ID + '&SPECIAL=' + SPECIAL + '&CLINIC=' + CLINIC + '&CHILD=' + CHILD + '&LETTER=' + LETTER;
}

function clearFilter() {
    var form = $('form[name=arrFilter_form]');
    form.find('select').each(function() {
        if ($(this).attr('name') == 'SPECIAL') {
            $(this).val('Специализация');
        }
        if ($(this).attr('name') == 'ID') {
            $(this).val('ФИО врача');
        }
        if ($(this).attr('name') == 'CLINIC') {
            $(this).val('Клиника');
        }
    })
    form.find('input[name=CHILD]').val('');
    form.find('input[name=LETTER]').val('');
    $(".show-more").attr('data-curpage', 1);
}

function setFilter(query) {
    var w = window.innerWidth;
    if (w < 1185) {
        query += '&nPageSize=' + 6;
    } else {
        query += '&nPageSize=' + 9;
    }
    $.post('/local/components/ivit/spec.main/templates/.default/ajax.php', query, function(data) {
        if (query.indexOf('append') == -1) {
            $('.result-list').html(data);
        } else {
            $('.result-list').append(data);
        }
    })
    $.post('/local/components/ivit/spec.main/templates/.default/ajax.php', query + '&counters=1', function(cnt) {
        var arr = cnt.split('&');
        $('.count').children().eq(0).text(arr[0]);
        var digit = arr[0].slice(-1);
        if (['0', '5', '6', '7', '8', '9'].indexOf(digit) != -1) {
            $('.count').children().eq(1).text('Врачей');
        }
        if (['2', '3', '4'].indexOf(digit) != -1) {
            $('.count').children().eq(1).text('Врача');
        }
        if (digit == '1') {
            $('.count').children().eq(1).text('Врач');
        }
        if (arr[1]) {
            var link = $('<a/>', {
                href: arr[2],
                text: arr[1]
            });
            $('h2.sect_name').html(link);
        } else {
            $('h2.sect_name').html('');
        }
        if (w > 1184) {
            if (arr[0] <= 9) {
                $('.paginator').hide();
            } else {
                var links = '<li class="cur_page"><a href="javascript:void(0)" class="current">1</a></li>';
                var cnt = Math.ceil(arr[0] / 9);
                for (var i = 2; i <= cnt; i++) {
                    links += '<li><a href="javascript:void(0)">' + i + '</a></li>';
                };
                $('.pag_links').html(links);
                $('.paginator').show();
            }
        } else {
            setTimeout(function() {
                var show_el = $('.result-list .item').length;
                var more = arr[0] - show_el;
                console.log(show_el, arr[0], more);
                if (arr[0] <= 6 || more == 0) {
                    $('.show-more.doc_page').hide();
                } else {
                    if (more > 6) {
                        $('.show-more.doc_page .button').text('Показать еще 6 врачей');
                    } else {
                        $('.show-more.doc_page .button').text('Показать еще ' + more + ' врачей');
                    }
                    $('.show-more.doc_page').show();
                }
            }, 200);
        }
    })
}(function($) {
    $.fn.removeClassWild = function(mask) {
        return this.removeClass(function(index, cls) {
            var re = mask.replace(/\*/g, '\\S+');
            return (cls.match(new RegExp('\\b' + re + '', 'g')) || []).join(' ');
        });
    };
})(jQuery);
if (typeof openModalWindow === "function") {} else {
    openModalWindow = function(xx) {
        closeAdaptiveMenue();
        xx = $(xx);
        $("body").addClass("open-modal-window");
        $(".modal-window").hide();
        xx.show();
        xx.css({
            "position": "absolute"
        });
        $(".wrapper").css({
            "position": "fixed",
            "top": currentScroll * -1
        });
        return $(".darkness").show();
    };
    closeModalWindows = function() {
        var xx;
        xx = $(".modal-window");
        xx.hide();
        xx.css({
            "position": "absolute"
        });
        $(".wrapper").css({
            "position": "relative",
            "top": 0
        });
        $(".darkness").hide();
        closeAdaptiveMenue();
        scrollCurrent();
        return $("body").removeClass("open-modal-window");
    };
    closeAdaptiveMenue = function() {
        return $(".adaptive-menue").hide();
    };
    resizeModalWindows = function() {
        var wHeight;
        wHeight = $(window).height() / 10;
        return $(".modal-window .place").css({
            "marginTop": wHeight
        });
    };
    scrollCurrent = function() {
        return $('html, body').animate({
            scrollTop: currentScroll
        }, 0);
    };
}(function() {
    var getBodyScrollTop;
    getBodyScrollTop = function() {
        return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
    };
    window.currentScroll = getBodyScrollTop();
}).call(this);