$(document).ready(function() {
	$('#login').keyup(function() {
		var val = $('#login').val();
		if(val != 0)
		{
			if(isValidLogin(val))
			{
				$("#login").css({
					"border-color": "#DEECEF"
				});
			} else {
				$("#login").css({
					"border-color": "#F00"
				});
			}
		} else {
			$("#login").css({
				"border-color": "#DEECEF"
			});

		}
	});

		$('#password').keyup(function() {
		var val = $('#password').val();
		if(val != 0)
		{
			if(isValidPassword(val))
			{
				$("#password").css({
					"border-color": "#DEECEF"
				});
			} else {
				$("#password").css({
					"border-color": "#F00"
				});
			}
		} else {
			$("#password").css({
				"border-color": "#DEECEF"
			});

		}
	});

	//фамилия
	$('#surname').keyup(function() {
		var val = $('#surname').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidName(val))
			{
				$("#surname").css({
					"border-color": "#DEECEF"
				});
				$("#errSurname").html('');
			} else {
				$("#surname").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errSurname").html(msg);
			}
		} else {
			$("#surname").css({
				"border-color": "#DEECEF"
			});
			$("#errSurname").html('');

		}
	});

	//имя
	$('#name').keyup(function() {
		var val = $('#name').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidName(val))
			{
				$("#name").css({
					"border-color": "#DEECEF"
				});
				$("#errName").html('');
			} else {
				$("#name").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errName").html(msg);
			}
		} else {
			$("#name").css({
				"border-color": "#DEECEF"
			});
			$("#errName").html('');
		}
	});

	//отчество
	$('#patronymic').keyup(function() {
		var val = $('#patronymic').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidName(val))
			{
				$("#patronymic").css({
					"border-color": "#DEECEF"
				});
				$("#errPatronymic").html('');
			} else {
				$("#patronymic").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errPatronymic").html(msg);
			}
		} else {
			$("#patronymic").css({
				"border-color": "#DEECEF"
			});
			$("#errPatronymic").html('');
		}
	});

	//адрес
	$('#address').keyup(function() {
		var val = $('#address').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidAddress(val))
			{
				$("#address").css({
					"border-color": "#DEECEF"
				});
				$("#errAddress").html('');
			} else {
				$("#address").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errAddress").html(msg);
			}
		} else {
			$("#address").css({
				"border-color": "#DEECEF"
			});
			$("#errAddress").html('');
		}
	});

	//телефонный код
	$('#phone-code').keyup(function() {
		var val = $('#phone-code').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidPhoneCode(val))
			{
				$("#phone-code").css({
					"border-color": "#DEECEF"
				});
				$("#errPhone").html('');
			} else {
				$("#phone-code").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errPhone").html(msg);
			}
		} else {
			$("#phone-code").css({
				"border-color": "#DEECEF"
			});
			$("#errPhone").html('');
		}
	});

	//телефонный номер
	$('#phone-number').keyup(function() {
		var val = $('#phone-number').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidPhoneNumber(val))
			{
				$("#phone-number").css({
					"border-color": "#DEECEF"
				});
				$("#errPhone").html('');
			} else {
				$("#phone-number").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errPhone").html(msg);
			}
		} else {
			$("#phone-number").css({
				"border-color": "#DEECEF"
			});
			$("#errPhone").html('');
		}
	});

	//ОЦЕНКИ
	$('#math').keyup(function() {
		var val = $('#math').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidRating(val))
			{
				$("#math").css({
					"border-color": "#DEECEF"
				});
				$("#errMath").html('');
			} else {
				$("#math").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errMath").html(msg);
			}
		} else {
			$("#math").css({
				"border-color": "#DEECEF"
			});
			$("#errMath").html('');
		}
	});

	$('#rus').keyup(function() {
		var val = $('#rus').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidRating(val))
			{
				$("#rus").css({
					"border-color": "#DEECEF"
				});
				$("#errRus").html('');
			} else {
				$("#rus").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errRus").html(msg);
			}
		} else {
			$("#rus").css({
				"border-color": "#DEECEF"
			});
			$("#errRus").html('');
		}
	});

	$('#history').keyup(function() {
		var val = $('#history').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidRating(val))
			{
				$("#history").css({
					"border-color": "#DEECEF"
				});
				$("#errHistory").html('');
			} else {
				$("#history").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errHistory").html(msg);
			}
		} else {
			$("#history").css({
				"border-color": "#DEECEF"
			});
			$("#errHistory").html('');
		}
	});

	$('#english').keyup(function() {
		var val = $('#english').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidRating(val))
			{
				$("#english").css({
					"border-color": "#DEECEF"
				});
				$("#errEnglish").html('');
			} else {
				$("#english").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errEnglish").html(msg);
			}
		} else {
			$("#english").css({
				"border-color": "#DEECEF"
			});
			$("#errEnglish").html('');
		}
	});

	$('#physic_cult').keyup(function() {
		var val = $('#physic_cult').val();
		var msg = '';
		if(val != 0)
		{
			if(isValidRating(val))
			{
				$("#physic_cult").css({
					"border-color": "#DEECEF"
				});
				$("#errPhysic").html('');
			} else {
				$("#physic_cult").css({
					"border-color": "#F00"
				});
				msg = 'Недопустимые символы';
				$("#errPhysic").html(msg);
			}
		} else {
			$("#physic_cult").css({
				"border-color": "#DEECEF"
			});
			$("#errPhysic").html('');
		}
	});
});

function isValidName(Name) {
	var pattern = /^[a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$/;
	return pattern.test(Name);
}

function isValidAddress(Name) {
	var pattern = /^[a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9\.\,\-\/_ ]+$/;
	return pattern.test(Name);
}

function isValidPhoneCode(Name) {
	var pattern = /^\d+$/;
	return pattern.test(Name);
}

function isValidPhoneNumber(Name) {
	var pattern = /^\d+$/;
	return pattern.test(Name);
}

function isValidRating(Name) {
	var pattern = /^[0-5]?$/;
	return pattern.test(Name);
}

function isValidLogin(Name) {
	var pattern = /^\w{3,30}$/;
	return pattern.test(Name);
}

function isValidPassword(Name) {
	var pattern = /^\w{6,}$/;
	return pattern.test(Name);
}