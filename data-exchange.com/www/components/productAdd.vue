<template>
	<div class="productAdd-wrap" id="productAdd-wrap" @click="productAddHide($event)">
		<div class="productAdd">
			<form class="productAdd-form">
				<label>
					<span>Наименование</span><br>
					<input type="text" v-model="name" minlength="3" maxlength="40">
				</label>
				
				<label>
					<span>Описание</span>
					<textarea v-model="description" maxlength="500"></textarea>
				</label>

				<label>
					<input type="file" accept="image/jpeg,image/png,image/gif" ref="img" @change="productImgChange">
				</label>

				<label>
					<span>Категория</span>
					<select v-model="category">
						<option value="-1">-</option>
						<option v-for="cat in categories" :value="cat.id">{{ cat.name }}</option>
					</select>
				</label>

				<label>
					<span>Тип</span>
					<select name="" id="" v-model="type">
						<option value="0">-</option>
						<option value="order">Заказ</option>
						<option value="item">Товар</option>
					</select>
				</label>

				

				<button type="button" class="button" @click="addNewProduct">Добавить</button>
			</form>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data: function() {
			return {
				name: "",
				description: "",
				category: "",
				productImg: {},
				categories: {},
				type: "",
				user: JSON.parse(localStorage.getItem("user"))
			}
		},
		methods: {
			login: function() {
				console.log("12");
			},
			productAddHide: function(event) {
				if(event.target.id == "productAdd-wrap") {
					this.$emit("productaddhide");
					console.log("child");
				}
			},
			addNewProduct: function() {
				if(this.productImg != "" && this.name != "" && this.description != "" && parseInt(this.category) !== -1) {

					let xhr = new XMLHttpRequest();

					const url = "http://data-exchange.com/backend/productAdd.php";
					let data = new FormData();
					
					//добавляем данные
					data.append("productImg", this.productImg); //изображения
					data.append("data", JSON.stringify({ 
						name: this.name,
						description: this.description,
						idCategory: this.category,
						idUser: this.user.id,
						type: this.type // тип 
					}));


					xhr.open('POST', url);
					xhr.send(data);

					xhr.onreadystatechange = function() {
						if(this.readyState != 4) return;
						if(this.status != 200) {
							console.log("Ошибка! Запрос не удался.");
							return;
						}

						// location.reload();
					}
				}
				else {
					alert("Заполните корректно поля!");
				}


			},
			productImgChange: function() {
				this.productImg =  this.$refs.img.files[0];
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
			}
		}
	}
</script>


<style lang="scss">
	.productAdd-wrap {
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

	.productAdd-form {
		display: flex;
		justify-content: space-around;
		flex-direction: column;
	}

	.productAdd {

		& {
			width: 500px;
			height: 400px;
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
			height: 100px;
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