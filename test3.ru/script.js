
    //ajax
var click_butt = document.getElementById('btn-click');
var vibor ;
click_butt.addEventListener("click",function (event) {

    // event.preventDefault();
  /*  var elem = event.target.parentNode;*/
    var elem = event.target ;
    console.log(event.target.parentNode);
    console.log(elem);
    console.log(elem.classList.contains);
    if(elem.classList.contains("button")) {
        console.log((elem.classList.contains("button"  )));
        console.log(elem.id);
        if(elem.id === 'comple'){
            vibor = "Soglasna"
        }
        else if(elem.id === 'no-comple'){
            vibor ="ne soglasna-__-"
        }
        else if(elem.id === 'cinems') {
            vibor = "Kino;"
        } else if(elem.id === 'coffe') {
            vibor = "Kafe;"
        }
        else if(elem.id === 'walk'){
            vibor = "Progylka;"
        } else if(elem.id === 'surprise'){
            vibor = "Curpriz;"
        }
    }
    console.log(vibor);

    var xhr = new  XMLHttpRequest();//объект,позволябщий делать HTTP-запросы к серверу без перезагрузки страницы.
    xhr.open('Post','server.php');//задает основные параметры запроса(метод,адрес запроса)
    xhr.setRequestHeader('Content-type','application/json;charset=utf-8');//устанавливает заголовок (имя запроса,значение)
    xhr.send(JSON.stringify({say : vibor}));//отправляет запрос на сервер(json в строку )

    var that = this;
    var hello;
    xhr.onreadystatechange = function () {
        if(this.readyState !== 4) return;
        if(this.status !== 200){
            console.log("Ошибка.Запрос не удался");
            return;
        }
        console.log(this.responseText);
    };
});


