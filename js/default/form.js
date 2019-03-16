$(function () {

	var t1; // таймер

	/**
	*	Обработка отправки формы на сервер - передаем по ajax и сообщаем о результате
	*/
	$('#form-add').on('submit', function (evnt) {
		var data = $(evnt.currentTarget).serialize();

		$.ajax({
			url: "/?controller=rest&action=save",
			method: "post",
			data: data,
			dataType: "json",
			success: function (result) {
				var msg;
				if (result.result == 1) {
					msg = 'Создана запись с ID = ' + result.data.id;
				} else {
					msg = result.error;
				}

				$('div.form-content div.info').html(msg);
				window.setTimeout(function () {$('div.form-content div.info').empty();}, 1000);
			}
		});


		return false;
	});


	/**
	*	Обработка переключателя старт/стоп
	*/
	$("div.auto-generate-panel input[type=button]").on('click', function (evnt) {
		var button = $(evnt.currentTarget);
		console.log(button.data('status'));
		if (button.data('status') == 0 ) {
			button.data('status', 1);
			timer1();
			button.val("Стоп");
		} else {
			button.data('status', 0);
			window.clearTimeout(t1)
			button.val("Старт");
		}
		return  false;
	});


	/**
	*	Автоматическое создание записей
	*/
	function generareRandomRecord()
	{
		$.ajax({
			url: "/?controller=rest&action=generate",
			method: "get",
			dataType: "json",
			success: function (result) {
				var msg;
				if (result.result == 1) {
				}
			}
		});


	}

	/**
	*	Запуск таймера на создание записей раз в 7 секунд
	*/
	function timer1()
	{
		generareRandomRecord();
		t1 = window.setTimeout(timer1, 7000);
	}


});