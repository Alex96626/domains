<template>
	<div v-if="userLogin">
		<div class="products-wrap">
			<send-message :user="userTo" v-on:sendmessagehide="sendMessageBlockShow = false" v-show="sendMessageBlockShow"></send-message>

			<header-top></header-top>
			
			<div v-show="loading">

				<div class="prod-header">
					<div class="prod-options">
						<input type="text" @input="searchProd($event.target.value)" class="searchInput" placeholder="Начните вводить запрос и мы отобразим результаты">

						<div class="switch-layout">
							<label @click="sort('date')">
								<input type="radio" name="sort" class="radio-item" checked>
								<span class="layout-name" >По дате добавления</span>
							</label>
							<label  @click="sort('view')">
								<input type="radio" name="sort" class="radio-item">
								<span class="layout-name">По кол-ву просмотров</span>
							</label>
							
							<label @click="sortOfType('order')">
								<input type="radio" name="type" class="radio-item">
								<span class="layout-name" >Заказы</span>
							</label>
							<label @click="sortOfType('item')">
								<input type="radio" name="type" class="radio-item">
								<span class="layout-name" >Товары</span>
							</label>

							<label @click="layout = 'grid'">
								<input type="radio" name="switch" class="switch radio-item" checked>
								<span class="layout-name">Сетка</span>
							</label>
							<label @click="layout = 'list'">
								<input type="radio" name="switch" class="switch radio-item">
								<span class="layout-name">Список</span>
							</label>
						</div>
					</div>
					<div class="cat-wrap">
						<products-cat v-on:clickcat="catSelect"></products-cat>
					</div>
				</div>
			
				<div class="content">

					
					<!-- <products-list  :categorieslist.sync="categories" v-on:loadinglist="load"></products-list> -->
					<div class="productsList-wrap" v-show="loading">
						<div :class="layout">
							<div v-for="prod, index in getProducts" v-show="prod.show">
								<div>
									<div class="product-wrap">
										<div class="prod-name">{{ prod.name }}</div>
										<div class="productImg-wrap">
											<router-link :to="{ name: 'idProd', params: { id: prod.idLot, lot: prod } }">
											<img :src="prodImg(prod.img)" class="product-img productImg-animation"> 
											</router-link>
										</div>
										<div class='prod-info'>
											<div class="prod-info-div">
												<div>
													<router-link :title="prod.userName" class="userLink" :to="{ name: 'idUser', params: { id: prod.idUser } }">
														<img :src="userAvatar(prod.avatar)" class="userAvatar-img">
													</router-link>
												</div>
												<div class="num-wrap">
													<span class="num"> {{ prod.views }} </span>
													<span class="name-num">просмотры</span>
												</div>
												<div class="num-wrap" @click="sendMessageShow(prod)">
													<img src="http://data-exchange.com/images/arrows.png" class="arrows-img">
													<span class="name-num">обмен</span>
												</div>
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
				</div>
			</div>
			<loading v-if="!loading"></loading>
		</div>
		<footer-app></footer-app>
	</div>
</template>

<script type="text/javascript">

	//components
	import headerTop from "./../components/header.vue";
	import productsCat from "./../components/productsCat.vue";
	import productsList from "./../components/productsList.vue";
	import loading from "./../components/loading.vue";
	import footerApp from "./../components/footer.vue";
	import sendMessage from "./../components/sendMessages.vue";

	let user = JSON.parse(localStorage.getItem("user"));

	export default {
		data: function() {
			return {
				user: user,
				loading: false,
				categories: [],
				products: {},
				sortByViewCountBool: false,
				prodImgUrl: "http://data-exchange.com/images/products/",
				layout: "grid",
				sendMessageBlockShow: false,
				userTo: ""
			}
		},
		computed: {
			userLogin: function() {
				if(this.user != null) {
					return true;
				}
				return false;
			},
			getCategoriesList: function() {
				console.log("computed");

				return this.categories;
			},
			getProducts: function() {
				return this.products;
			}
		},
		methods: {
			sortOfType(type) {
				console.log(type);

				[].forEach.call(this.products, function(item) {
					if(item.type === type) {
						item.show = true;
					}
					else {
						item.show = false;
					}
				});
			},
			sendMessageShow: function(user) {
				console.log(user.idUser);
				this.userTo["userTo"] = user;
				this.sendMessageBlockShow = true;
			},
			sort: function(type) {

				if(type == "date") { //сортировка по дате
					this.products = this.products.sort((a,b) => parseInt(b.idLot) - parseInt(a.idLot));
					return;
				}
				else if(type == "view") {
					this.products = this.products.sort((a,b) => parseInt(b.views) - parseInt(a.views));
					return;
				}
			},
			userAvatar: function(img) {
				const url = "http://data-exchange.com/images/avatars/";
				return `${url}${img}`;
			},
			searchProd: function(req) {

				req = req.trim().toLowerCase();
				let l = req.length; //кол-во символов в запросе

				this.products.forEach(item=> {
					
					let words = item.name.split(" ");
					let result = words.some(word=> { //если хотя бы одно совпадение, то показываем товар
						if(word.substr(0, l).toLowerCase() != req) {
							return false;
						}
						return true;
					});
					
					if(result) {
						item.show = true;
					}
					else {
						item.show = false;
					}
				});
			},
			prodImg: function(img) {
				return `${this.prodImgUrl}${img}`;
			},
			load: function() {
				this.$on("loadinglist");
				console.log("load")
				this.loading = true;
			},
			catSelect: function(categories) {

				this.$on("clickcat");
				this.categories = categories;

				const that = this;
				[].forEach.call(this.products, function(item) {
					if(that.categories[item.idCat-1]) {
						item.show = true;
					}
					else {
						item.show = false;
					}
				});
			}
		},
		created: function() {
			console.log(1);
			if(this.user == null) {
				window.location = "/";
			}

			let xhr = new XMLHttpRequest();

			const url = "http://data-exchange.com/backend/getAllProducts.php";

			xhr.open('POST', url, true);
			xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
			xhr.send();

			const that = this;

			xhr.onreadystatechange = function() {
				if(this.readyState != 4) return;
				if(this.status != 200) {
					console.log("Ошибка! Запрос не удался.");
					return;
				}

				if(this.responseText != "") {
					console.log(111);
					that.products = JSON.parse(this.responseText);
					that.productsSortDate = that.products;
					that.loading = true;

					console.log(that.products[0]);

					//that.$emit("loadinglist");
				}
			}
		},
		components: {
			productsCat,
			headerTop,
			productsList,
			loading,
			footerApp,
			sendMessage
		}
	}

</script>


<style lang="scss">


	.prod-header {
		width: 100%;
		background-color: #3598DC;
		margin-top: -35px;
	}

	.cat-wrap {
		width: 70%;
		margin: 0 auto;
	}

	.switch-layout {

		& {
			margin-left: auto;
		}

		.radio-item {
			display: none;
		}

		.layout-name:hover {
			text-decoration: underline;
		}

		.radio-item:checked + .layout-name {
			color: #FBA026;
		}

		/*.switch:checked + .layout-name:hover {
			text-decoration: none;
		}

		.switch:checked + .layout-name {
			color: #FBA026;
		}*/

		label {
			cursor: pointer;
			color: white;
			padding: 0 7px;
		}
	}

	.userLink {
		display: flex;
		align-items: center;
	}

	.userAvatar-img {
		border: 2px solid #FBA026;
	}

	.userAvatar-img:hover {
		border-color: #3598DC;
	}


	.productsList-wrap .grid > div {
		width: 32%;
	}

	.productsList-wrap .grid {
		& {
			width: 100%;
			margin: 0 auto;
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}

		.description {
			display: none;
		}

		.prod-info {
			display: flex;
			justify-content: space-around;
			flex-direction: row;
			align-items: center;
			padding: 4px 0;
		}

		.prod-info-div {
			display: flex;
			flex-direction: row;
		}

		.userLink {
			padding: 0 10px;
		}

		.product-wrap:hover .prod-info {
			background-color:  #2A80B9;
			color: white;
		}

		.product-wrap:hover .num-wrap {
			color: white;
		}

		.num-wrap {
			color: black;
			font-family: "RobotoLight";
		}

		
	}

	.productsList-wrap .grid .product-wrap {
		width: 100%;

	}

	.productsList-wrap .list {

		& {
			width: 100%;
		}

		.description {
			display: block;
			max-width: 560px;
		}

		.num-wrap {
			color: black;
			font-family: "RobotoLight";
		}
	}

	.productsList-wrap .list .product-wrap {

		& {
			width: 100%;
			flex: 1 1 100%;
			display: flex;
			justify-content: flex-start;
			align-items: center;
			flex-wrap: wrap;
		}

		.prod-name {
			flex: 1 1 100%;
			margin-top: -4px;
		}

		.productImg-wrap {
			width: 25%;
			height: 100%;
			margin-right: 40px;
		}

		.prod-info {
			display: flex;
			flex-direction: row;
		}

		.userAvatar-img {
			display: block;
			margin: 0 auto;
			margin-bottom: 4px;
		}
	
	}


	.content {
		width: 70%;
		margin: 0 auto;
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		margin-top: 35px;
	}

	.prod-options {
		display: flex;
		align-items: center;
		justify-content: space-around;
		box-sizing: border-box;
		background-color: #3598DC;
		width: 70%;
		margin: 15px auto;
		padding: 5px 15px;
	}


	.searchInput {
		width: 50%;
		padding: 5px 10px;
		box-sizing: border-box;
		font-size: 16px;
		border-radius: 10px;
		border: 2px solid #FBA026;
	}


	.productsList-wrap {

		a {
			color: #3598DC;
			text-decoration: none;
		}
		
		a:hover {
			text-decoration: underline;
		}

		.prod-name {
			text-align: center;
		}

	}

	.none {
		display: none;
	}

	@media screen and(max-width: 430px) {
		.switch-layout {
			flex-direction: column;
		}

		.searchInput {
			flex: 1 1 100%;
		}
	}




</style>