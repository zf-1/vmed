(function() {
  var calculation, separator;

  $(document).ready(function() {
    calculation();
    $("#slider-1").slider({
      range: "min",
      value: 1,
      min: 1,
      max: 46,
      step: 1,
      slide: function(event, ui) {
        $("#input-cost-auto").val(ui.value);
        return calculation();
      }
    });
    return $("#slider-2").slider({
      range: "min",
      value: 4,
      min: 1,
      max: 15,
      step: 1,
      slide: function(event, ui) {
        $("#input-term").val(ui.value);
        return calculation();
      }
    });
  });

  calculation = function() {
    var cost, count, final_sum, formula, payment, percent, percent_show, term, term_view, value;
    term = parseInt($("#input-term").attr("value"));
    cost = parseInt($("#input-cost-auto").attr("value"));
    value = cost;
    if (value === 1) {
      count = 50000;
    }
    if (value === 2) {
      count = 100000;
    }
    if (value === 3) {
      count = 150000;
    }
    if (value === 4) {
      count = 200000;
    }
    if (value === 5) {
      count = 250000;
    }
    if (value === 6) {
      count = 300000;
    }
    if (value === 7) {
      count = 350000;
    }
    if (value === 8) {
      count = 400000;
    }
    if (value === 9) {
      count = 450000;
    }
    if (value === 10) {
      count = 500000;
    }
    if (value === 11) {
      count = 600000;
    }
    if (value === 12) {
      count = 700000;
    }
    if (value === 13) {
      count = 800000;
    }
    if (value === 14) {
      count = 900000;
    }
    if (value === 15) {
      count = 1000000;
    }
    if (value === 16) {
      count = 1100000;
    }
    if (value === 17) {
      count = 1200000;
    }
    if (value === 18) {
      count = 1300000;
    }
    if (value === 19) {
      count = 1500000;
    }
    if (value === 20) {
      count = 1700000;
    }
    if (value === 21) {
      count = 1900000;
    }
    if (value === 22) {
      count = 2100000;
    }
    if (value === 23) {
      count = 2300000;
    }
    if (value === 24) {
      count = 2500000;
    }
    if (value === 25) {
      count = 2700000;
    }
    if (value === 26) {
      count = 2900000;
    }
    if (value === 27) {
      count = 3100000;
    }
    if (value === 28) {
      count = 3300000;
    }
    if (value === 29) {
      count = 3500000;
    }
    if (value === 30) {
      count = 3700000;
    }
    if (value === 31) {
      count = 3900000;
    }
    if (value === 32) {
      count = 4100000;
    }
    if (value === 33) {
      count = 4300000;
    }
    if (value === 34) {
      count = 4500000;
    }
    if (value === 35) {
      count = 4700000;
    }
    if (value === 36) {
      count = 5000000;
    }
    if (value === 37) {
      count = 5500000;
    }
    if (value === 38) {
      count = 6000000;
    }
    if (value === 39) {
      count = 6500000;
    }
    if (value === 40) {
      count = 7000000;
    }
    if (value === 41) {
      count = 7500000;
    }
    if (value === 42) {
      count = 8000000;
    }
    if (value === 43) {
      count = 8500000;
    }
    if (value === 44) {
      count = 9000000;
    }
    if (value === 45) {
      count = 9500000;
    }
    if (value === 46) {
      count = 10000000;
    }
    $("#input-cost-auto-absolute").val(count);
    final_sum = count * .85;

    /*
    	считаем проценты
     */
    switch (term) {
      case 1:
        percent = 1.9;
        break;
      case 2:
        percent = 2.9;
        break;
      case 3:
        percent = 3.9;
        break;
      case 4:
        percent = 4.9;
        break;
      case 5:
        percent = 4.8;
        break;
      case 6:
        percent = 4.8;
        break;
      case 7:
        percent = 4.7;
        break;
      case 8:
        percent = 4.7;
        break;
      case 9:
        percent = 4.7;
        break;
      case 10:
        percent = 4.3;
        break;
      case 11:
        percent = 4.3;
        break;
      case 12:
        percent = 4.3;
        break;
      case 13:
        percent = 4.3;
        break;
      case 14:
        percent = 4.3;
        break;
      case 15:
        percent = 4;
    }
    if (term > 3 && final_sum > 1000000) {
      formula = Math.ceil((final_sum - 1000000) / 500000);
      percent = percent - .1 * formula;
      percent = percent.toFixed(1);
      console.log(formula, percent, final_sum);
    }
    $("#amount-1").html(separator(count));
    $("#input-cost-auto").val(value);
    $("#final-sum").html(separator(final_sum) + " руб.");
    payment = final_sum * percent / 100;
    payment = Math.round(payment);
    $("#payment").html(separator(payment) + " руб.");
    if (term === void 0) {
      term = $("#input-term").val();
    }
    if (term < 3) {
      percent_show = "% в неделю";
    } else {
      percent_show = "% в месяц";
    }
    switch (term) {
      case 1:
        term_view = "1 неделя";
        break;
      case 2:
        term_view = "2 недели";
        break;
      case 3:
        term_view = "3 недели";
        break;
      case 4:
        term_view = "1 месяц";
        break;
      case 5:
        term_view = "2 месяца";
        break;
      case 6:
        term_view = "3 месяца";
        break;
      case 7:
        term_view = "4 месяца";
        break;
      case 8:
        term_view = "5 месяца";
        break;
      case 9:
        term_view = "6 месяцев";
        break;
      case 10:
        term_view = "7 месяцев";
        break;
      case 11:
        term_view = "8 месяцев";
        break;
      case 12:
        term_view = "9 месяцев";
        break;
      case 13:
        term_view = "10 месяцев";
        break;
      case 14:
        term_view = "11 месяцев";
        break;
      case 15:
        term_view = "12 месяцев";
    }
    $("#amount-2").html(term_view);
    return $("#percent-payment").html(percent + percent_show);
  };

  separator = function(n) {
    return (n + '').split('').reverse().join('').replace(/(\d{3})/g, '$1 ').split('').reverse().join('').replace(/^ /, '');
  };

}).call(this);

