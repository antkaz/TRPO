<div id="authorization">
	<? if (!$user->id) : ?>
		<form method="post" action="<?= $url ?>">
			<fieldset>
				<div class="input">
					<p><label for="login">Логин</label></p>
					<input id="login" type="text" name="login" size="20" />
				</div>
				<div class="input">
					<p><label for="password">Пароль</label></p>
					<input id="password" type="password" name="password" size="20" />
				</div>
				<input id="loginSubmit" type="submit" name="loginSubmit" value="Войти" />
			</fieldset>
		</form>
	<? else : ?>
		<form method="POST" action="/">
			<div class="button">
				<input id="logoutSubmit" type="submit" name="logoutSubmit" value="Выйти" />
			</div>
		</form>
	<? endif; ?>
</div>