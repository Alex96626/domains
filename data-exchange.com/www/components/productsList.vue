<template>
	<div class="productsList-wrap">
	{{ categorieslist }}
	{{ getCategories }}
		<div v-for="prod, index in products" class="product-wrap">
			<div class="prod-name">{{ prod.name }}</div>
			<div class="productImg-wrap">
				<img :src="prodImg(prod.img)" class="product-img productImg-animation">
			</div>
			Добавил:
			<router-link :to="{ name: 'idUser', params: { id: prod.idUser } }">{{prod.userName}} {{prod.lastName}}</router-link>
			Описание:<br>
			{{ prod.text }}
		</div>
	</div>
</template>


<script type="text/javascript">
	export default {
		data: function() {
			return {
				products: {},
				prodImgUrl: "http://data-exchange.com/images/products/"
			}
		},
		props: ["categorieslist"],
		computed: {
			getCategories: function() {
				console.log("getCategories");
				return this.categorieslist;
			}
		},
		mounted: function() {
			console.log("из mounted");
			console.log( this.categorieslist);
		},
		methods: {
			prodImg: function(img) {
				return `${this.prodImgUrl}${img}`;
			}
		},
		created: function() {
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
					that.products = JSON.parse(this.responseText);
					
					console.log(that.products);

					that.$emit("loadinglist");
				}
			}

			
		}
	}
</script>


<style lang="scss">

	.productsList-wrap {

		& {
			width: 100%;
			margin: 0 auto;
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around;
		}

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
</style>