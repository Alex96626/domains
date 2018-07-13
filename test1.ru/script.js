
/*var xhr = XMLHttpRequest();//объект,позволябщий делать HTTP-запросы к серверу без перезагрузки страницы.
const url = "http://data-exchange.com/backend/getCategories.php";
xhr.open('Post',url);//задает основные параметры запроса(метод,адрес запроса)
xhr.setRequestHeader('Content-type','application/json;charset=utf-8');//устанавливает заголовок (имя запроса,значение)
xhr.send(JSON.stringify({say : Hello}));//отправляет запрос на сервер(json в строку )

var that = this;

xhr.onreadystatechange = function () {
    if(this.readyState !== 4) return;
    if(this.status !== 200){
        console.log("Ошибка.Запрос не удался");
        return;
    }
    that.categories = JSON.parse(this.responseText);//переводит текст в json вормат
};
*/
    var xhr =  new XMLHttpRequest();//объект,позволябщий делать HTTP-запросы к серверу без перезагрузки страницы.
xhr.open('GET','players.json',true);
xhr.send();

xhr.onreadystatechange = function () {
    if(xhr.readyState !=4)return;
    if(xhr.status != 200 ){
        console.log(xhr.status+ ":"+ xhr.statusText);
       // console.log( xhr.responseText);
       // return;
    }else {
        alert(xhr.responseText);

    }
}

