<h1>АСУ школы</h1>

<div id="content-main">
	<div class="item column">
		<? if (!empty($list)) : ?>
			<h2>Отличники школы</h2>
			<ul>
				<? foreach ($list as $item) : ?>
					<li><a href="/?com=students&id=<?= $item->id_student ?>"><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?> (<?= $item->class ?> Класс)</a></li>
				<? endforeach; ?>
			</ul>
		<? endif; ?>
	</div>

	<div class="item column">
		<? if (!empty($listFail)) : ?>
			<h2>Ученики с плохими оценками</h2>
			<ul>
				<? foreach ($listFail as $item) : ?>
					<li><a href="/?com=students&id=<?= $item->id_student ?>"><?= $item->surname ?> <?= $item->name ?> <?= $item->patronymic ?> (<?= $item->class ?> Класс)</a></li>
				<? endforeach; ?>
			</ul>
		<? endif; ?>
	</div>
</div>

<div id="content-bottom">
</div>