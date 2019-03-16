<h2>Добавление данных</h2>
<div>
	<div class="form-content">
		<h3>Вручную</h3>
		<form id="form-add" method="post" target="blank_" action="/?controller=rest&action=save">
			<label>
				Вид транспорта
				<select name="transport[name]">
					<?php foreach ($names as $name):?>
						<option value="<?php echo $name; ?>"><?php echo $name; ?></option>
					<?php endforeach;?>
				</select>
			</label>
			<label>
				Номер
				<input type="text" name="transport[number]">
			</label>
			<label>
				Направление
				<select name="transport[direction]">
					<?php foreach ($directions as $direction):?>
						<option value="<?php echo $direction; ?>"><?php echo $direction; ?></option>
					<?php endforeach;?>
				</select>
			</label>
			<div>
				<input type="submit" value="Сохранить"/>		
			</div>
		</form>
		<div class="info"></div>
	</div>

	<div class="auto-generate-panel">
		<h3>Автоматически</h3>
		<input data-status="0" type="button" value="Старт">
	</div>	
</div>
