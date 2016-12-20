<h1>Ученики</h1>

<div id="content-top">
	<div id="top-menu">
		<ul class="line-menu">
			<? if (!empty($class) && !empty($list)) : ?>
				<li><a id="deleteClass" href="<?= $helper->url ?>&action=deleteClass&idClass=<?= $class ?>" onclick="return confirm('Удалить класс?');">Удалить класс</a></li>
			<? endif; ?>
			<li><a id="print" href="#" onclick="printDiv('content-main'); return false;">Печать</a></li>
			<? if (is_object($item)) : ?>
				<? if ($user->id) : ?>
					<li><a href="<?= $helper->url ?>&action=edit&id=<?= $item->id ?>">Изменить</a></li>
				<? endif; ?>
			<? else : ?>
				<li><a href="#" onclick="$('#filter').slideToggle(); return false;">Фильтр</a></li>
			<? endif; ?>
			<? if ($user->id) : ?>
				<li><a href="<?= $helper->url ?>&action=add">Добавить</a></li>
			<? endif; ?>
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
					<td><span id="errClass"></span></td>
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
		<? if (is_object($item)) : ?>
			<h2><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?></h2>
			<p><b>Пол:</b> <? if ($item->sex) : ?> Мужской <? else : ?> Женский <? endif; ?></p>
			<p><b>Дата рождения:</b> <?= $item->birth ?></p>
			<p><b>Класс:</b> <?= $item->class ? $item->class : '' ?></p>
			<p><b>Адрес:</b> <?= $item->address ?></p>
			<p><b>Контактный телефон:</b> <? if (!(empty($item->phoneCode) && empty($item->phoneNumber))) : ?>+7 (<?= $item->phoneCode ?>) <?= $item->phoneNumber ?><? endif; ?></p>
			<? if ($item->parentMother) : ?>
				<p><b>Мама:</b>
					<a href="/?com=parents&id=<?= $item->parentMother ?>"><?= $helper->getParent($item->parentMother)->surname ?> <?= $helper->getParent($item->parentMother)->name ?> <?= $helper->getParent($item->parentMother)->patronymic ?></a>
				</p>
			<? endif; ?>
			<? if ($item->parentFather) : ?>
				<p><b>Папа:</b>
					<a href="/?com=parents&id=<?= $item->parentFather ?>"><?= $helper->getParent($item->parentFather)->surname ?> <?= $helper->getParent($item->parentFather)->name ?> <?= $helper->getParent($item->parentFather)->patronymic ?></a>
				</p>
			<? endif; ?>
			<h3>Оценки</h3>
			<p><b>Математика:</b> <?= $helper->getRating($item->id)->math; ?></p>
			<p><b>Русский язык:</b> <?= $helper->getRating($item->id)->rus; ?></p>
			<p><b>История:</b> <?= $helper->getRating($item->id)->history; ?></p>
			<p><b>Английский язык:</b> <?= $helper->getRating($item->id)->english; ?></p>
			<p><b>Физическая культура:</b> <?= $helper->getRating($item->id)->physic_cult; ?></p>
			<p><b>Средний балл:</b> <?= $helper->getRating($item->id)->rating; ?></p>
		<? else : ?>
			<table class="list">
				<thead>
				<th>Ф. И. О.</th>
				<th>Класс</th>
				<? if ($user->id) : ?>
					<th>Управление</th>
				<? endif; ?>
				</thead>
				<tbody>
					<? foreach ($list as $item) : ?>
						<tr>
							<td><a href="<?= $url ?>&id=<?= $item->id ?>"><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?></a></td>
							<td><?= $item->class ? $item->class : '' ?></td>
							<? if ($user->id) : ?>
								<td>
									<a href="<?= $url ?>&action=edit&id=<?= $item->id ?>" class="edit" title="Редактировать"></a>
									<a href="<?= $url ?>&action=delete&id=<?= $item->id ?>" class="delete" onclick="return confirm('Удалить ученика?');" title="Удалить"></a>
								</td>
							<? endif; ?>
						</tr>
					<? endforeach; ?>
				</tbody>
			</table>
		<? endif; ?>
	<? endif; ?>
</div>

<div id="content-bottom">
</div>