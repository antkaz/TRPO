<h1>Родители</h1>

<div id="content-top">
	<div id="top-menu">
		<ul class="line-menu">
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
			<p><b>Адрес:</b> <?= $item->address ?></p>
			<p><b>Контактный телефон:</b> <? if (!(empty($item->phoneCode) && empty($item->phoneNumber))) : ?>+7 (<?= $item->phoneCode ?>) <?= $item->phoneNumber ?><? endif; ?></p>
			<p><b>Место работы:</b> <?= $item->work ?></p>
		<? else : ?>
			<table class="list">
				<thead>
				<th>Ф. И. О.</th>
				<? if ($user->id) : ?>
					<th>Управление</th>
				<? endif; ?>
				</thead>
				<tbody>
					<? foreach ($list as $item) : ?>
						<tr>
							<td><a href="<?= $url ?>&id=<?= $item->id ?>"><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?></a></td>
							<? if ($user->id) : ?>
								<td>
									<a href="<?= $url ?>&action=edit&id=<?= $item->id ?>" class="edit" title="Редактировать"></a>
									<a href="<?= $url ?>&action=delete&id=<?= $item->id ?>" class="delete" onclick="return confirm('Удалить запись?');" title="Удалить"></a>
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