<h1>Ученики</h1>

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
							<? for ($i = date('Y') - 5; $i >= date('Y') - 30; $i--) : ?>
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
					<td class="title"><label for="mother">Мама</label></td>
					<td class="input">
						<select id="mother" name="mother" size="1">
							<option value="0"></option>
							<? foreach ($listMother as $item) : ?>
								<option value="<?= $item->id ?>" <? if ($item->id == $mother) : ?> selected="" <? endif; ?>><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?></option>
							<? endforeach; ?>
						</select>
					</td>
					<td class="title"><span id="errMother"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="father">Папа</label></td>
					<td class="input">
						<select id="father" name="father" size="1">
							<option value="0"></option>
							<? foreach ($listFather as $item) : ?>
								<option value="<?= $item->id ?>" <? if ($item->id == $father) : ?> selected="" <? endif; ?>><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?></option>
							<? endforeach; ?>
						</select>
					</td>
					<td><span id="errFather"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="class">Класс</label></td>
					<td class="input">
						<select id="class" name="class" size="1">
							<option value="0"></option>
							<? for ($i = 1; $i <= 11; $i++) : ?>
								<? foreach ($letterClass as $value) : ?>
									<option value="<?= $i . $value ?>"<? if ($class == $i . $value) : ?> selected="" <? endif; ?>><?= $i . $value ?></option>
								<? endforeach; ?>
							<? endfor; ?>
						</select>
					</td>
					<td><span id="errClass"></span></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input id="addStudent" type="submit" name="addStudent" value="Добавить" /></td>
				</tr>
			</table>
		</form>
	<? endif; ?>
</div>

<div id="content-bottom">
</div>