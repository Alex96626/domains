<template>
	<div class="sendMessage-wrap" id="sendMessage-wrap" @click="sendMessageHide($event)">
		<div class="sendMessage">
			<form class="productAdd-form">

				<span>Кому:</span>
				<router-link title="user.userTo.idUser" :to="{ name: 'idUser', params: { id: user.userTo.idUser } }" class="userLink">
					<img :src="userAvatar(user.userTo.avatar)" class="userAvatar-img" >
					{{ fullName(user.userTo.userName, user.userTo.lastName) }}
				</router-link>

				<label>
					<span>Текст сообщения</span>
					<textarea v-model="msg"></textarea>
				</label>


				<button type="button" class="button" @click="sendMessage">Отправить</button>
			</form>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data: function() {
			return {
				msg: ""
				//user: JSON.parse(localStorage.getItem("user"))
			}
		},
		props: ["user"],
		methods: {
			sendMessageHide: function() {
				if(event.target.id == "sendMessage-wrap") {
					this.$emit("sendmessagehide");
					console.log("child");
				}
			},
			userAvatar: function(img) {
				const url = "http://data-exchange.com/images/avatars/";
				return `${url}${img}`;
			},
			fullName: function(name, lastName) {
				return (`${name} ${lastName}`).trim();
			},
			sendMessage: function() {

				console.log("id " +  this.user.userTo.idUser);

				if(this.msg != "") {

					console.log( JSON.parse(localStorage.getItem("user")).id );
					let xhr = new XMLHttpRequest();

					const url = "http://data-exchange.com/backend/sendMessage.php";
					xhr.open('POST', url);
					xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
					xhr.send(JSON.stringify({
						fromUser: JSON.parse(localStorage.getItem("user")).id,
						toUser: this.user.userTo.idUser,
						msg: this.msg
					}));

					xhr.onreadystatechange = function() {
						if(this.readyState != 4) return;
						if(this.status != 200) {
							console.log("Ошибка! Запрос не удался.");
							return;
						}

						console.log(this.responseText);

						if(JSON.parse(this.responseText)) {
							alert("Сообщение отправлено.");
						}
						else {
							alert("Произошла обишка!");
						}
					}
				}
				else {
					alert("Введите текст сообщения!");
				}
			}
		},
		created: function() {
			console.log("sendMessage");
			console.log(this.user);
		}
	}
</script>


<style lang="scss">
	.sendMessage-wrap {
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background-color: rgba(23,24,20,0.5);
	}

	.sendMessage-wrap form {
		display: flex;
		justify-content: space-around;
		flex-direction: column;
	}

	.sendMessage {

		& {
			width: 500px;
			padding: 15px;
			box-sizing: border-box;
			background-color: white;
		}

		textarea,
		label,
		input,
		select {
			font-size: 16px;
		}

		textarea {
			width: 100%;
			height: 120px;
			resize: none;
			padding: 5px;
			box-sizing: border-box;
		}

		input {
			padding: 5px;
			box-sizing: border-box;
		}

		label {
			margin-bottom: 10px;
		}
	}

</style>