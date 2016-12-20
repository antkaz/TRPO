<h1>Рейтинг</h1>

<div id="content-top">
	<ul class="line-menu">
		<li><a href="<?= $helper->url ?>">Список</a></li>
	</ul>
</div>
<div id="content-main">
	<? if ($result == 'success') : ?>
		<? Messages::successMsg($helper->success); ?>
	<? else : ?>
		<h2 class="title-center"><?= $helper->getStudent($id)->surname ?> <?= $helper->getStudent($id)->name ?> <?= $helper->getStudent($id)->patronymic ?></h2>
		<? if ($result == 'error') : ?>
			<? Messages::errorMsg($helper->error); ?>
		<? endif; ?>
		<form action="<?= $url ?>" method="POST">
			<table id="form">
				<tr>
					<td class="title"><label for="math">Математика</label></td>
					<td class="input"><input id="math" type="text" name="math" size="30" value="<?= $math ?>" /></td>
					<td><span id="errMath"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="rus">Русский язык</label></td>
					<td class="input"><input id="rus" type="text" name="rus" size="30" value="<?= $rus ?>"/></td>
					<td><span id="errRus"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="history">История</label></td>
					<td class="input"><input id="history" type="text" name="history" size="30" value="<?= $history ?>" /></td>
					<td><span id="errHistory"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="english">Английский язык</label></td>
					<td class="input"><input id="english" type="text" name="english" size="30" value="<?= $english ?>" /></td>
					<td><span id="errEnglish"></span></td>
				</tr>
				<tr>
					<td class="title"><label for="physic_cult">Физическая культура</label></td>
					<td class="input"><input id="physic_cult" type="text" name="physic_cult" size="30" value="<?= $physic_cult ?>" /></td>
					<td><span id="errPhysic"></span></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input id="editRating" type="submit" name="editRating" value="Изменить" /></td>
				</tr>
			</table>
		</form>
	<? endif; ?>
</div>
<div id="content-bottom">
</div>