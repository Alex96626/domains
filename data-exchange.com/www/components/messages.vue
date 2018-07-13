<template>
	<div v-if="userLogin" class="min-height">

		<loading v-if="loading"></loading>
		<send-message :user="userTo" v-on:sendmessagehide="sendMessageBlockShow = false" v-show="sendMessageBlockShow"></send-message>

		<h3>Сообщения</h3>
		<div class="messages">
			<div class="messages-wrap">
				<h4>Отправленные</h4>
				<div v-for="msg in messages.msgFrom" class="message-wrap">
					<div class="headMsg">
						<router-link :to="{ name: 'idUser', params: { id: msg.userTo.idUser } }" class="userLink">
							<img :src="userAvatar(msg.userTo.avatar)" class="userAvatar-img">
							{{ fullName(msg.userTo.userName, msg.userTo.lastName) }}
						</router-link>
						<span class="dateMsg">{{ msg.msgInfo.date }}</span>
					</div>
					{{ msg.msgInfo.text }}
					<button type="button" @click="sendMessageShow(msg)" class="button">Написать смс</button>
				</div>
			</div>
			<div class="messages-wrap">
				<h4>Полученные</h4>
				<div v-for="msg in messages.msgTo" class="message-wrap">
					<router-link :to="{ name: 'idUser', params: { id: msg.userTo.idUser } }" class="userLink">
						<img :src="userAvatar(msg.userTo.avatar)" class="userAvatar-img">
						{{ fullName(msg.userTo.userName, msg.userTo.lastName) }} 
					</router-link>
					{{ msg.msgInfo.text }}
					{{ msg.msgInfo.date }}

					<button type="button" @click="sendMessageShow(msg)" class="button">Ответить</button>
				</div>
			</div>
		</div>
	</div>
</template>


<script type="text/javascript">

	let user = JSON.parse(localStorage.getItem("user"));

	//components
	import loading from "./loading.vue";
	import sendMessage from "./sendMessages.vue";

	export default {
		data: function() {
			return {
				sendMessageBlockShow: false,
				user: user,
				messages: {
					msgFrom: {},
					msgTo: {},
				},
				loading: false,
				userTo: ""
			}
		},
		components: {
			loading,
			sendMessage
		},
		computed: {
			userLogin: function() {
				if(this.user != null) {
					return true;
				}
				return false;
			}
		},
		methods: {
			sendMessageShow: function(user) {
				this.userTo = user;
				this.sendMessageBlockShow = true;
			},
			fullName: function(name, lastName) {
				return `${name} ${lastName}`;
			},
			userAvatar: function(img) {
				const url = "http://data-exchange.com/images/avatars/";
				return `${url}${img}`;
			}
		},
		created: function() {
			if(this.user == null) {
				window.location = "/";
			}
			else {
				console.log("messages.vue");

				let xhr = new XMLHttpRequest();

				const url = "http://data-exchange.com/backend/getMessagesNUser.php";

				xhr.open('POST', url, true);
				xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
				xhr.send(JSON.stringify({
					id: this.user.id
				}));

				const that = this;

				xhr.onreadystatechange = function() {
					if(this.readyState != 4) return;
					if(this.status != 200) {
						console.log("Ошибка! Запрос не удался.");
						return;
					}

					that.loading = false;

					if(this.responseText != "") {

						let data = JSON.parse(this.responseText);

						that.messages.msgFrom = data.msgFrom;
						that.messages.msgTo = data.msgTo;

						console.log(data);
					}

					that.$emit("loadingmsg");
				}
			}
			
		}
	}
</script>

<style lang="scss">

	.messages .button {
		display: block;
		margin-top: 5px;
	}
	.messages {
		width: 70%;
		margin: 0 auto;
		display: flex;
		justify-content: space-between;
	}

	.messages-wrap {
		width: 45%;
	}

	.message-wrap {
		min-height: 40px;
		padding: 8px 0;
		box-sizing: border-box;
		border-bottom: 1px solid grey;
	}

	.userAvatar-img {
		border-radius: 50%;
		width: 35px;
		height: 35px;
		margin-right: 8px;
	}

	.userLink {
		display: flex;
		align-items: center;
		color: black;
		text-decoration: none;
	}

	.userLink:hover {
		color: #3598DC;
	}

	.headMsg {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.messages-wrap h4 {
		font-size: 22px;
		text-align: center;
	}


</style>