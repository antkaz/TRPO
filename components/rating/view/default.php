<h1>Рейтинг</h1>

<div id="content-top">
	<div id="top-menu">
		<ul class="line-menu">
			<li><a id="print" href="#" onclick="printDiv('content-main'); return false;">Печать</a></li>
			<li><a href="#" onclick="$('#filter').slideToggle(); return false;">Фильтр</a></li>
			<li><a href="<?= $helper->url ?>">Список</a></li>
		</ul>
	</div>

	<div id="filter" style="display: none;">
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
					<td><span id="parallel" <? if(empty($class)) :?> style="display: none;" <? endif; ?>><input type="checkbox" name="parallel" /> Показать в параллели</span></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input id="filterSubmit" type="submit" name="filter" value="Фильтр" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<div id="content-main">
	<? if (empty($list) && !isset($_POST['filter'])) : ?>
		<p>Раздел находится в стадии наполнения</p>
	<? elseif (empty($list) && isset($_POST['filter'])) : ?>
		<p>Данные, удовлетворяющие указанным условиям, отсутствуют</p>
	<? else : ?>
		<table class="list">
			<thead>
			<th>Ученик</th>
			<th>Класс</th>
			<th>Матемфтика</th>
			<th>Рус. яз.</th>
			<th>История</th>
			<th>Англ. Яз.</th>
			<th>Физ-ра</th>
			<th>Рейтинг</th>
			<? if ($user->id) : ?>
				<th>Управление</th>
			<? endif; ?>
			</thead>
			<tbody>
				<? foreach ($list as $item) : ?>
					<tr>
						<td><a href="/?com=students&id=<?= $item->id_student ?>"><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?></a></td>
						<td><?= $helper->getStudent($item->id_student)->class ?></td>
						<td><?= $item->math ?></td>
						<td><?= $item->rus ?></td>
						<td><?= $item->history ?></td>
						<td><?= $item->english ?></td>
						<td><?= $item->physic_cult ?></td>
						<td><?= $item->rating ?></td>
						<? if ($user->id) : ?>
							<td>
								<a href="<?= $url ?>&action=edit&id=<?= $item->id ?>" class="edit" title="Редактировать"></a>
							</td>
						<? endif; ?>
					</tr>
				<? endforeach; ?>
			</tbody>
		</table>
		<p></p>
		<p>0 - Оценка не выставлена</p>
	<? endif; ?>
</div>

<div id="content-bottom">
</div>