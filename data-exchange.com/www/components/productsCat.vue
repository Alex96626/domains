<template>
	<div class="productsCat-wrap">
		<ul>
			<li v-for="cat in categories">
				<label @click="clickCat($event.target.value)" :title="cat.id">
					<input type="checkbox" name="cat" :value="cat.id" class="checkbox">
					<span class="cat-name">{{ cat.name }}</span>
				</label>
			</li>
		</ul>
	</div>
</template>

<script type="text/javascript">
	
	export default  {
		data: function() {
			return {
				categories: {},
				catSelected: []
			}
		},
		methods: {
			clickCat: function(e) {
				let catId = parseInt(e);
				catId--;


				if( !isNaN(catId) ) {
					if(this.catSelected[catId] == undefined) {
						this.catSelected[catId] = false;
					}
					this.catSelected[catId] = !this.catSelected[catId];

					console.log(this.catSelected);
		
					this.$emit("clickcat", this.catSelected);
				}
			}
		},
		created: function() {
			let xhr = new XMLHttpRequest();

			const url = "http://data-exchange.com/backend/getCategories.php";
			xhr.open('POST', url);
			xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //для json
			xhr.send(JSON.stringify({name: "selim"}));

			let that = this;

			xhr.onreadystatechange = function() {
				if(this.readyState != 4) return;
				if(this.status != 200) {
					console.log("Ошибка! Запрос не удался.");
					return;
				}
				that.categories = JSON.parse(this.responseText);

				//that.catSelected = that.categories;
			}
		}
	}

</script>


<style lang="scss">
	.productsCat-wrap {
		& {
			width: 100%;
			margin: 0 auto 10px auto;
			background-color: #3598DC;
			color: white;
		}

		ul {
			list-style: none;
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;

		}

		li {
			margin-bottom: 7px;
			font-size: 18px;
			display: block;
			width: 25%;
		}

		.checkbox {
			display: none;
		}

		.cat-name:before {
			content: "- ";
		}

		.checkbox:checked + .cat-name {
			color: #FBA026;
		}

		.checkbox:checked + .cat-name:before {
			content: "+ ";
		}

		.checkbox:hover + .cat-name {
			color: #FBA026;
		}

		label {
			display: block;
			cursor: pointer;
			padding: 0 5px;

		}
	}

	@media only screen and (max-width: 950px){
		.productsCat-wrap {
			width: 100%;
		}
	}

	@media only screen and (max-width: 650px){
		.productsCat-wrap {
			width: 70%;
		}

		.productsCat-wrap li {
			width: 50%;
		}
	}

	@media only screen and (max-width: 480px){
		.productsCat-wrap li {
			width: 100%;
		}
	}

</style>