<template>
		<!-- после добавления авторизации убрать знак ! (отрицание) -->
		<div v-if="!userLogin"> <!--  v-if="!userLogin" -->
			<header-top></header-top>
			<div class="wrapper">
				<div class="content">
					<h1 class="logo"><span class="x">4</span>business</h1>
					<div class="sections-wrap">
						

						<img src="http://data-exchange.com/images/main.png">
						

						
					</div>

					<h2 class="register-slogan">Для того, чтобы перейти к обмену вещами, зарегистрируйся!</h2>
					
					<div class="forms-wrap">
						<register></register>
						<login></login>
					</div>
				</div>
			</div>
			<footer-app></footer-app>
		</div>
</template>

<script type="text/javascript">

	/* components */
	import header from "./../components/header.vue";
    import login from "./../components/login.vue";
	import register from "./../components/register.vue";
	import footerApp from "./../components/footer.vue";

	let user = JSON.parse(localStorage.getItem("user"));
	console.log(user);

	export default  {
		data: function() {
			return {
				hello: "hello",
				user: user
			}
		},
		computed: {
			userLogin: function() {
				if(this.user != null) {
					return true;
				}
				return false;
			}
		},
		components: {
			headerTop: header,
			login: login,
			register: register,
			footerApp
		},
		created: function() {
			if(this.user != null) {
				window.location = "#/profile";
			}
		}
	};

</script>

<style lang="scss" type="text/css">

	.x {
		color: rgb(251,160,38);
		font-family: "Roboto";
	}

	.content {
		& {

		}

		.register-slogan {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			height: 50px;
			background-color: grey;
			margin-bottom: 15px;
			background-color: rgb(53,152,220);
			color: white;
		}

		.logo {
			font-size: 110px;
			text-align: center;
			display: block;
			margin: 0 auto;
			font-family: "RobotoBold";
			color: rgb(53,152,220);
		}

		.forms-wrap {
			//background-color: rgb(251,160,38);
			display: flex;
			width: 100%;
			justify-content: space-around;
			padding: 15px;
			box-sizing: border-box;
		}

		section {

			& {
				display: flex;
				justify-content: space-around;
				flex-direction: row;
				flex-wrap: wrap;
				margin-bottom: 10px;
			}

			.item {
				display: flex;
				flex-direction: column;
				width: 33.333%;
			}

			img {
				width: 118px;
				height: auto;
				margin: 0 auto;
				display: block;
			}

			h2 {
				flex: 1 1 100%;
				text-align: center;
			}

		}

		.history {

			& {
				display: flex;
				justify-content: space-between;
			}

			.img-wrap {
				display: flex;
				justify-content: space-around;
			}
			
			img {
				width: auto;
			}

			ul {
				list-style: none;
			}

			li {
				margin-bottom: 7px;
			}
		}

	}
</style>