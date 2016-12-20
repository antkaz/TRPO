<h1>Родители</h1>
<div id="content-top">
	<div id="top-menu">
		<ul class="line-menu">
			<? if ($result == 'success') : ?>
				<li><a href="<?= $helper->url ?>&action=add">Добавить</a></li>
			<? endif; ?>
			<li><a href="<?= $helper->url ?>">Список</a></li>
		</ul>
	</div>
</div>
<div id="content-main">
	<? if ($result == 'success') : ?>
		<? Messages::successMsg($helper->success); ?>
	<? else : ?>
		<? if ($result == 'error') : ?>
			<? Messages::errorMsg($helper->error); ?>
		<? endif; ?>
		<form action="<?= $url ?>" method="POST">
			<table id="form">
				<tr>
					<td class="title"><label for="surname">Фамилия</label></td>
					<td class="input"><input id="surname" type="text" name="surname" size="30" value="<?= $surname ?>" /></td>
					<td><span id="errSurname"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="name">Имя</label></td>
					<td class="input"><input id="name" type="text" name="name" size="30" value="<?= $name ?>"/></td>
					<td><span id="errName"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="patronymic">Отчество</label></td>
					<td class="input"><input id="patronymic" type="text" name="patronymic" size="30" value="<?= $patronymic ?>" /></td>
					<td><span id="errPatronymic"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="sex">Пол</label></td>
					<td class="">
						<input type="radio" name="sex" value="1" <? if (isset($sex) && $sex == 1) : ?> checked="" <? endif; ?> />Мужской
						<input type="radio" name="sex" value="0" <? if (isset($sex) && $sex == 0) : ?> checked="" <? endif; ?> />Женский
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="title"><label for="birth">Дата Рождения</label></td>
					<td class="">
						<select id="day" name="day" size="1" style="width: 25%">
							<option value="0">День</option>
							<? for ($i = 1; $i <= 31; $i++) : ?>
								<option value="<?= $i ?>" <? if ($day == $i) : ?> selected="" <? endif; ?>><?= $i ?></option>
							<? endfor; ?>
						</select>
						<select id="month" name="month" size="1" style="width: 42%">
							<option value="0">Месяц</option>
							<? foreach ($helper->month as $key => $value) : ?>
								<option value="<?= ++$key ?>" <? if ($month == $key) : ?> selected="" <? endif; ?>><?= $value ?></option>
							<? endforeach; ?>
						</select>
						<select id="year" name="year" size="1" style="width: 29%">
							<option value="0">Год</option>
							<? for ($i = date('Y') - 18; $i >= date('Y') - 50; $i--) : ?>
								<option value="<?= $i ?>" <? if ($year == $i) : ?> selected="" <? endif; ?>><?= $i ?></option>
							<? endfor; ?>
						</select>
					</td>
					<td><span id="errBirth"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="address">Адрес</label></td>
					<td class="input"><input id="address" type="text" name="address" size="30" value="<?= $address ?>" /></td>
					<td><span id="errAddress"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="phone">Телефон</label></td>
					<td class="">+7
						(<input id="phone-code" type="text" name="phone-code" size="3" value="<?= $phoneCode ?>" />)
						<input id="phone-number" type="text" name="phone-number" size="10" value="<?= $phoneNumber ?>" />
					</td>
					<td><span id="errPhone"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="work">Место работы</label></td>
					<td class="input"><input id="work" type="text" name="work" size="30" value="<?= $work ?>" /></td>
					<td><span id="errAddress"></span></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input id="addParent" type="submit" name="addParent" value="Добавить" /></td>
				</tr>
			</table>
		</form>
	<? endif; ?>
</div>
<div id="content-bottom">
</div>