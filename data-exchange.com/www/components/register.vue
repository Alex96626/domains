<template>
	<form class="register-wrap form">
		<h2>Регистрация</h2>
		<label>
			<span>Имя</span>
			<input type="text" v-model="name" placeholder="Ваше имя">
		</label>
		<label>
			<span>Фамилия</span>
			<input type="text" v-model="lastName" placeholder="Ваша фамилия">
		</label>
		<label>
			<span>Email</span>
			<input type="email" v-model="email" placeholder="Ваш Email">
		</label>
		<label>
			<span>Пароль</span>
			<input type="password" v-model="password" placeholder="Пароль">
		</label>
		<label>
			<span>Повторите пароль</span>
			<input type="password" v-model="passwordCopy" placeholder="Повтор пароля">
		</label>

		<button type="submit" class="button" @click="register($event)">Зарегистрироваться</button>
	</form>
</template>


<script type="text/javascript">

	export default  {
		data: function() {
			return {
				name: "",
				lastName: "",
				email: "",
				password: "",
				passwordCopy: ""
			}
		},
		computed: {
			passwordTrue: function() {
				if(this.password == this.passwordCopy && this.password.length != 0) {
					return true;
				}
				return false;
			}
		},
		methods: {
			register: function(e) {
				e.preventDefault();

				if(this.name != "" && this.lastName != "" && this.password != "") { //валидация
					if(this.passwordTrue == true){ //проверка на совпадение паролей
						let xhr = new XMLHttpRequest();

						const registerURL = "http://data-exchange.com/backend/register.php";

						let userData = JSON.stringify({
							name: this.name,
							lastName: this.lastName,
							password: this.password,
							email: this.email
						});

						xhr.open('POST', registerURL, true);
						xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
						xhr.send(userData);

						xhr.onreadystatechange = function() {
							if(this.readyState != 4) return;
							if(this.status != 200) {
								console.log("Ошибка! Запрос не удался.");
								return;
							}

							let res = JSON.parse(this.responseText); //данные с сервера

							 //проверка на уникальность email
							if(!res.find) { //если email свободен
								if(res.register) {
									console.log("Регистрация прошла успешно!");
									//localStorage.setItem("user", userData);
									location.reload();
								}
							}
							else {
								console.log("Этот email уже занят!");
							}
						}
					}
					else {
						alert("Пароли не совпадают!");
					}

				}
				else {
					alert("Заполните все поля!");
				}

				
			}
		}
	};

</script>

<style lang="scss" type="text/css">
	
</style>