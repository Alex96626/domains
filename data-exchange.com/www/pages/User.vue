<template>
	<div class="user-wrap">

		<header-top></header-top>

		<loading v-if="loading"></loading>

		<!-- <div v-if="haveProducts">
			<div v-for="prod in data.userProducts"  class="product-wrap">
				{{ prod.name }}
				<div class="productImg-wrap">
					<img :src="prodImg(prod.img)" class="product-img">
				</div>
			</div>
		</div> -->

		

		<div class="content">
		<div class="user-info">
			<h2>
				{{ fullName }}
			</h2>
			<div>
				<img :src="userAvatar" class="avatar">
			</div>
			<div class="user-data">
					<span>Крым, Симферополь</span>
					<span>{{ data.user.tel }}</span>
				</div>
		</div><br><br>
			<div class="productsList-wrap">
				<div class="grid">
					<div v-for="prod, index in data.userProducts">
						<div>
							<div class="product-wrap">
								<div class="prod-name">{{ prod.name }}</div>
								<div class="productImg-wrap">
									<router-link :to="{ name: 'idProd', params: { id: prod.idLot, lot: prod } }">
									<img :src="prodImg(prod.img)" class="product-img productImg-animation"> 
									</router-link>
								</div>
								<div class='prod-info'>
									
									<div class="num-wrap">
										<span class="num"> {{ prod.views }} </span>
										<span class="name-num">просмотры</span>
									</div>
									<div class="num-wrap">
										<img src="http://data-exchange.com/images/arrows.png" class="arrows-img">
										<span class="name-num">обмен</span>
									</div>
									
									<div class="description">
										Описание:<br>
										{{ prod.text }}
										{{ prod.idCat }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div v-if="productsNone">
				У пользователя отсутствуют товары
			</div>
		</div>
		<footer-app></footer-app>
	</div>
</template>


<script type="text/javascript">

	//components
	import loading from "./../components/loading.vue";
	import headerTop from "./../components/header.vue";
	import footerApp from "./../components/footer.vue";

	export default {
		data: function() {
			return {
				loading: true,
				data: {
					user: {
						userName: "",
						lastName: ""
					},
					userProducts: {}
				},
				prodImgUrl: "http://data-exchange.com/images/products/",
				haveProducts: false,
				productsNone: false
			}
		},
		components: {
			loading,
			headerTop,
			footerApp
		},
		computed: {
			fullName: function() {
				return `${this.data.user.userName} ${this.data.user.lastName}`;
			},
			userAvatar: function() {
				const url = "http://data-exchange.com/images/avatars/";
				return `${url}${this.data.user.avatar}`;
			}
		},
		methods: {
			prodImg: function(img) {
				return `${this.prodImgUrl}${img}`;
			},
			userAvatar: function(img) {
				const url = "http://data-exchange.com/images/avatars/";
				return `${url}${img}`;
			}
		},
		created: function() {

			let userId = parseInt(this.$route.params.id);

			if(JSON.parse(localStorage.getItem("user")).id == userId) {
				window.location = "http://data-exchange.com/#/profile";
				return;
			}

			console.log(userId);
			
			let xhr = new XMLHttpRequest();

			const url = "http://data-exchange.com/backend/getUserNProducts.php";

			xhr.open('POST', url, true);
			xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
			xhr.send(JSON.stringify({
				id: userId
			}));

			const that = this;

			xhr.onreadystatechange = function() {
				if(this.readyState != 4) return;
				if(this.status != 200) {
					console.log("Ошибка! Запрос не удался.");
					return;
				}

				if(this.responseText != "") {
					that.data = JSON.parse(this.responseText);

					that.loading = false;

					//есть ли у пользователя товары
					if(that.data.userProducts[0].idProduct != null) {
						that.haveProducts = true;
					}
					else { // у пользователя нет товаров
						that.productsNone = true;
					}

					console.log(JSON.parse(this.responseText));
				}
			}

		}
	}

</script>


<style lang="scss">

	.user-name {
		text-align: center;
	}

	.user-data {
		margin-bottom: 10px;
	}


</style>