<template>
	<div class="lot-page">
		<header-top></header-top>

		<loading v-if="loading"></loading>

		<div class="lot-wrap">

			<div class="history-back" @click="historyBack">Назад</div>

			<img :src="prodImg(lot.img)" class="lot-img">
		
			<div class="lot-info">
				<h1>{{ lot.name }}</h1>
				<div class="description">
					Описание:<br>
					{{ lot.text }}
				</div>
				<div v-if="lot.idUser != undefined">
					<div class='prod-info'>
						<div class="prod-info-div">
							<div class='lot-user-info'>
								<router-link :title="lot.userName" :to="{ name: 'idUser', params: { id: lot.idUser } }">
									<img :src="userAvatar(lot.avatar)" class="userAvatar-img">
									{{ lot.userName }}
									{{ lot.lastName }}
								</router-link>
							</div>
							<div class="num-wrap">
								<span class="num"> {{ lot.views }} </span>
								<span class="name-num">просмотры</span>
							</div>
							<div class="num-wrap">
								<img src="http://data-exchange.com/images/arrows.png" class="arrows-img">
								<span class="name-num">обмен</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="other-lots">
			<h3>Другие лоты</h3>
			<div class="productsList-wrap">
				<div class="grid">
					<div v-for="prod, index in products" class="lots-wrap">
						<div>
							<div class="product-wrap">
								<div class="prod-name">{{ prod.name }}</div>
								<div class="productImg-wrap">
									<a :href="linkLot(prod.idLot)">
										<img :src="prodImg(prod.img)" class="product-img productImg-animation">
									</a>
									<!-- <router-link :to="{ name: 'idProd', params: { id: prod.idLot, lot: prod } }">
										<img :src="prodImg(prod.img)" class="product-img productImg-animation"> 
									</router-link> -->
								</div>
								<div class='prod-info'>
									<div class="prod-info-div">
										<div class="num-wrap">
											<span class="num"> {{ prod.views }} </span>
											<span class="name-num">просмотры</span>
										</div>
										<div class="num-wrap">
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
				prodImgUrl: "http://data-exchange.com/images/products/",
				lot: this.$route.params.lot,
				lotId: this.$route.params.id,
				products: []
			}
		},
		components: {
			loading,
			headerTop,
			footerApp
		},
		methods: {
			linkLot: function(id) {
				const url = "http://data-exchange.com/#/lot/";
				return `${url}${id}`;
			},
			historyBack: function() {
				window.history.go(-1);
			},
			prodImg: function(img) {
				return `${this.prodImgUrl}${img}`;
			},
			updateViews: function() {
				let xhr = new XMLHttpRequest();

				const url = "http://data-exchange.com/backend/updateViews.php";

				xhr.open('POST', url, true);
				xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
				xhr.send(JSON.stringify({
					id: this.lotId,
					views: parseInt(this.lot.views) + 1
				}));


				xhr.onreadystatechange = function() {
					if(this.readyState != 4) return;
					if(this.status != 200) {
						console.log("Ошибка! Запрос не удался.");
						return;
					}

					console.log(JSON.parse(this.responseText));
				}
			},
			userAvatar: function(img) {
				const url = "http://data-exchange.com/images/avatars/";
				return `${url}${img}`;
			},
			getLots: function() {
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
						that.products = (JSON.parse(this.responseText)).slice(0, 3);
					}
				}

			}
		},
		created: function() {

			this.getLots();

			if(this.lot != undefined) { //Без запроса
				console.log("Без запроса");
				this.loading = false;

				this.updateViews(); //обновляем кол-во просмотров у лота
			}
			else { //Запрос на сервер
				console.log("Запрос");

				let xhr = new XMLHttpRequest();

				const url = "http://data-exchange.com/backend/getLot.php";

				xhr.open('POST', url, true);
				xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
				xhr.send(JSON.stringify({id: this.lotId}));

				const that = this;

				xhr.onreadystatechange = function() {
					if(this.readyState != 4) return;
					if(this.status != 200) {
						console.log("Ошибка! Запрос не удался.");
						return;
					}

					console.log(JSON.parse(this.responseText));

					that.lot = JSON.parse(this.responseText);
					that.loading = false;

					that.updateViews(); //обновляем кол-во просмотров у лота
				}
			}
		}
	}

</script>


<style type="text/css" lang="scss">


	.arrows-img {
		width: 27px;
		height: 27px;
		border: 2px solid #FBA026;
		border-radius: 10px;
		cursor: pointer;
	}


	.other-lots {
		width: 70%;
		margin: 15px auto;
	}

	.lot-wrap {

		& {
			width: 70%;
			margin: 0 auto;
			display: flex;
		}

		h1,
		h2 {
			text-align: center;
		}

		.lot-img {
			width: 50%;
			height: auto;
			max-height: 250px;
		}

		.lot-info {
			padding: 10px 10px 10px 20px;
			box-sizing: border-box;
		}

		.description {
			min-height: 142px;
			margin-bottom: 10px;
		}

		.history-back {
			padding: 5px 10px;
			box-sizing: border-box;
			color: black;
			background-color: #E6E6E6;
			color: grey;
			height: 250px;
			cursor: pointer;
		}

		.history-back:hover {
			background-color: #A6A6A6;
			color: white;
		}

		.prod-info-div {
			display: flex;
			justify-content: space-around;
			flex-direction: row;
			background-color: #3598DC;
			padding: 5px;
		}

		.lot-user-info a {
			display: flex;
			justify-content: space-around;
			flex-direction: row;
			align-items: center;
			color: white;
		}

		.lot-user-info a {
			color: white;
		}

		.lot-user-info:hover a {
			color: #FBA026;
		}

		.lots-wrap {
			display: flex;
		}

	}


</style>