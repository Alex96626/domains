<template>
	<form class="login-wrap form">
		<h2>Авторизация</h2>
		<label>
			<span>Email</span>
			<input type="email" v-model="email" placeholder="Ваш Email">
		</label>
		<label>
			<span>Пароль</span>
			<input type="password" v-model="password" placeholder="Пароль">
		</label>

		<button type="button" class="button" @click="login">Войти</button>
	</form>
</template>



<script type="text/javascript">
	export default {
		data: function() {
			return {
				email: "",
				password: ""
			}
		},
		methods: {
			login: function() {

				let xhr = new XMLHttpRequest();

				/*let headers = new Headers();

				headers.append('Content-Type', 'application/json');
				headers.append('Accept', 'application/json');

				headers.append('Access-Control-Allow-Origin', 'http://localhost:9000');
				headers.append('Access-Control-Allow-Credentials', 'true');*/

				const url = "http://data-exchange.com/backend/login.php";
				let userData = JSON.stringify({
					email: this.email,
					password: this.password
				});

				xhr.open('POST', url, true);
				xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
				xhr.send(userData);

				xhr.onreadystatechange = function() {
					if(this.readyState != 4) return;
					if(this.status != 200) {
						console.log("Ошибка! Запрос не удался.");
						return;
					}

					console.log(this.responseText);

					let user = JSON.parse(this.responseText);
					console.log(user);

					if(user != null) { //авторизация успешная
						let userData = {
							id: user.id_user,
							name: user.name,
							lastName: user.last_name,
							email: user.email,
							avatar: user.avatar
						};
						localStorage.setItem("user", JSON.stringify(userData)); //запись в хранилище
						console.log( JSON.parse(localStorage.getItem("user")));
					
						location.reload(); //перезагружаем странциу
						console.log("reload");
					}
					else {
						alert("Неправильный логин или пароль!");
					}
				}
			}
		}
	}
</script>


<style lang="scss">
	

</style>