<template>

	 <div v-if="userLogin">
		<div class="profile-wrap">
			<header-top></header-top>

			<div class="user-info">
				<h2>
					{{ user.name }}
					{{ user.lastName }}
				</h2>
				<div>
					<img :src="userAvatar" class="avatar">
				</div>
				<div class="user-data">
					<span>Крым, Симферополь</span>
					<span>+7 (978) 024 65 98</span>
					<button type="button" @click="productAddShow" class="button addProdBtn">Добавить товар/заказ</button>
				</div>
				<!-- <form class="user-data">
					<label>
						<span>Email</span>
						<input type="text" v-model="user.email" disabled>
					</label>

					<label>
						<input type="file" accept="image/jpeg,image/png,image/gif" ref="ava" @change="">
					</label>

					<button type="button" class="button">Изменить аватар</button>
				</form> -->
			</div>

			<product-add v-on:productaddhide="productAddBlockHide" v-show="productAddBlockShow"></product-add>

			<div v-show="loading">
				<h3>Мои</h3>
				<div class="products-wrap">
					<div v-if="productsShow" class="products-list">
						<h2>Товары</h2>
						<div v-for="prod in products"  v-if="prod.type === 'item'" class="product-wrap">
							
								<div class="prod-name">{{ prod.name }}</div>
								<div class="productImg-wrap">
									<img :src="prodImg(prod.img)" class="product-img productImg-animation">
								</div>
								<span>{{ prod.text }}</span>
								<button @click="deleteProd($event.target, prod.idProduct)">Удалить</button>
							
						</div>

						<h2>Заказы</h2>
						<div v-for="prod in products" v-if="prod.type === 'order'" class="product-wrap">
							<div class="prod-name">{{ prod.name }}</div>
							<div class="productImg-wrap">
								<img :src="prodImg(prod.img)" class="product-img productImg-animation">
							</div>
							<span>{{ prod.text }}</span>
							<button @click="deleteProd($event.target, prod.idProduct)">Удалить</button>			
						</div>
					</div>
					<div v-else class="min-height">
						<center>У вас еще нет товаров</center>
					</div>
				</div>
				<messages v-on:loadingmsg="load"></messages>
			</div>
			<loading v-if="!loading"></loading>
		</div>
		<footer-app></footer-app>
	</div>
</template>



<script type="text/javascript">

	/* components */

	import headerTop from "./../components/header.vue";
	import productAdd from "./../components/productAdd.vue";
	import messages from "./../components/messages.vue";
	import loading from "./../components/loading.vue";
	import footerApp from "./../components/footer.vue";	

	export default {
		data: function() {
			return {
				productAddBlockShow: false,
				prodImgUrl: "http://data-exchange.com/images/products/",
				user: JSON.parse(localStorage.getItem("user")),
				products: {},
				loading: true
			}
		},
		computed: {
			productsShow: function() {
				if(this.products.length == undefined) { //проверка на наличие товаров у пользователя
					return false;
				}
				return true;
			},
			userLogin: function() {
				if(this.user != null) {
					return true;
				}
				return false;
			},
			userAvatar: function() {
				const url = "http://data-exchange.com/images/avatars/";
				return `${url}${this.user.avatar}`;
			}
		},
		components: {
			headerTop,
			productAdd,
			messages,
			loading,
			footerApp
		},
		methods: {
			productAddShow: function() {
				this.productAddBlockShow = true;
			},
			productAddBlockHide: function() {
				console.log("parent");

				this.$on("productaddhide");
				this.productAddBlockShow = false;
			},
			prodImg: function(img) {
				const prodImgUrl = "http://data-exchange.com/images/products/";
				return `${prodImgUrl}${img}`;
			},
			load: function() {
				console.log(3333);
				 this.$on("loadingmsg");
				console.log("load")
				this.loading = true;
			},
			deleteProd: function(e, idProd) {


				const res = confirm("Вы действительно хотите удалить товар?");
				

				if(res) { //если пользователь согласен на удаление товара
					console.log(idProd);

					let xhr = new XMLHttpRequest();

					const url = "http://data-exchange.com/backend/deleteProd.php";
					let userData = JSON.stringify(this.user);

					xhr.open('POST', url, true);
					xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
					xhr.send(JSON.stringify({
						idProd: idProd
					}));

					xhr.onreadystatechange = function() {
						if(this.readyState != 4) return;
						if(this.status != 200) {
							console.log("Ошибка! Запрос не удался.");
							return;
						}

						if(this.responseText) {
							e.parentNode.style.display = "none";
							alert("Товар успешно удален!");
						}
						else {
							alert("Что-то пошло не так, попробуйте еще раз.");
						}

						console.log(this.responseText);
					}
				}
			}
		},
		created: function() {

			console.log(4444);

			if(this.user == null) {
				window.location = "/";
			}
			else {

				let xhr = new XMLHttpRequest();

				const url = "http://data-exchange.com/backend/getProducts.php";
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

					if(this.responseText != "") {
						that.products = JSON.parse(this.responseText);

						console.log(that.products );
					}
				}
			}
		}
	}
</script>


<style lang="scss">

	.min-height {
		min-height: 100px;
	}

	.user-wrap,
	.profile-wrap {
		& {
			
		}

		h2,
		h3 {
			text-align: center;
			font-size: 20px;
			font-weight: normal;
			width: 70%;
			margin: 0 auto;
			padding: 5px;
		}

		h2 {
			font-size: 26px;
			font-weight: 600;
			font-family: "RobotoBold";

		}

		h3 {
			background-color: #3598DC;
			color: white;
			font-family: "RobotoBold";
		}

		.user-info {
			width: 70%;
			margin: 0 auto;
			display: flex;
			justify-content: flex-start;
			flex-direction: column;
			align-items: center;
		}

		.user-data {
			width: 80%;
			display: flex;
			flex-direction: column;
			justify-content: flex-start;
			text-align: center;
		}

		.user-data span {
			font-size: 20px;
		}

		.addProdBtn {
			width: 35%;
			margin: 10px auto;
			height: 50px;
			background: #FF4F4F;
			font-size: 16px;
		}

	}

	.avatar {
		max-width: 100%;
		width: 200px;
		height: 200px;
		border-radius: 50%;
	}

</style>