$(function () {

	var fromId = 0; // ID крайней загруженной записи
	var t1; // таймер периодического обновления таблицы раз в 5 секунд


	/**
	*	Функция обновления таблицы
	*/
	function refreshTable() 
	{
		$.ajax({
			url: "/?controller=rest",
			data: {"from_id": fromId},
			dataType: "json",
			success: function (result) {
				if (result.result == 1) {
					var rows = result.data.rows;
					if (rows.length) {
						var tr = $("#output-table tbody tr:first");
						if (tr.length == 0) {tr = null;}
						var id = 0;
						for (var i = 0; i < rows.length; i++) {
							id = rows[i].id;
							if (tr == null) {
								tr = $("<tr/>").appendTo("#output-table tbody");
							} else {
								tr = $("<tr/>").insertBefore(tr);
							}
							$("<td/>").appendTo(tr).html(id);					
							$("<td/>").appendTo(tr).html(rows[i].name);					
							$("<td/>").appendTo(tr).html(rows[i].number);					
							$("<td/>").appendTo(tr).html(rows[i].direction);					
						}
						fromId = id; 
					}
				}
			}
		});
	}


	/**
	*	Запуск таймера на обновление таблицы раз в 5 секунд
	*/
	function timer1()
	{
		refreshTable();
		t1 = window.setTimeout(timer1, 5000);
	}

	timer1();

});