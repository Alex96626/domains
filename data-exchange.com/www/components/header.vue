<template>
	<div class="headerTop-wrap">
		<router-link to="/" class="logo">
			<span class="x">4</span>business
		</router-link>
		<router-link to="/products" class="products">Все лоты</router-link>

		<div class="num-wrap">
			<span class="num"> {{ numOfUsers }} </span>
			<span class="name-num">пользователей</span>
		</div>
		<div class="num-wrap">
			<span class="num"> {{ numOflots }} </span>
			<span class="name-num">товаров</span>
		</div>
		<div class="num-wrap">
			<span class="num"> {{ numOfOrders }} </span>
			<span class="name-num">заказов</span>
		</div>

		<div v-if="user" class="user-nav">
			<router-link to="/profile">Профиль</router-link>
			<span class="logout" type="button" @click="logout">Выйти</span>
		</div>
	</div>
</template>


<script type="text/javascript">


	export default {
		data: function() {
			return {
				user: JSON.parse(localStorage.getItem("user")),
				numOflots: 0,
				numOfUsers: 0,
				numOfOrders: 0
			}
		},
		methods: {
			logout: function() {
				localStorage.removeItem("user");
				location.reload();
			}
		},
		created: function() {
			let xhr = new XMLHttpRequest();

			const url = "http://data-exchange.com/backend/nums.php";
			let userData = JSON.stringify(this.user);

			xhr.open('POST', url, true);
			xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
			xhr.send(userData);

			const that = this;

			xhr.onreadystatechange = function() {
				if(this.readyState != 4) return;
				if(this.status != 200) {
					console.log("Ошибка! Запрос не удался.");
					return;
				}

				let res = JSON.parse(this.responseText);
				that.numOfUsers = parseInt(res.users );
				that.numOflots = parseInt(res.lots);
				that.numOfOrders = parseInt(res.orders);
				console.log(JSON.parse(this.responseText));
			}
		}
	};

</script>

<style lang="scss">
	.num-wrap {
		padding: 0 10px;
		color: white;
		text-align: center;
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.num {
		padding: 2px 10px;
		border-radius: 10px;
		border: 2px solid #FBA026;
	}

	.name-num {
		font-size: 12px;
		font-family: "RobotoBold";
	}

	.headerTop-wrap {

		& {
			width: 100%;
			height: 50px;
			display: flex;
			align-items: center;
			background-color: #3598DC;
			margin-bottom: 35px;
		}

		
		.logo {
			min-width: 170px;
			font-family: "RobotoBold";
		}

		.products {
			width: 80%;
			font-family: "RobotoBold";
		}

		.user-nav {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100%;
			font-family: "RobotoBold" !important;
		}

		a,
		.logout {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100%;
			padding: 0 10px;
			color: white;
			min-width: 85px;
			text-decoration: none;
		}

		a:hover,
		.logout:hover  {
			background-color: #2A80B9;
			cursor: pointer;
			color: #FBA026;
		}
	}

	@media screen and(max-width: 430px) {
		.headerTop-wrap {
			justify-content: space-around;
		}

		.user-nav {
			justify-content: flex-start;
		}

		.headerTop-wrap .products{
			width: auto;
		}

		.headerTop-wrap .num-wrap {
			display: none;
		}
		
	}

	@media only screen and (max-width: 650px){ 
		.headerTop-wrap .logo {
			display: none;
		}
	}
</style>