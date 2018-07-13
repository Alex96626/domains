var no_click = document.getElementById('no_click');
var start_position = 0;
var top = no_click.style.top;

no_click.onmousemove = function() {
    doIt();
}
function doIt(){
    var x1=0,y1=0;
    var height = document.documentElement.clientHeight;
    var height_scrol = document.documentElement.scrollHeight;
    x = Math.floor(Math.random()*800);
    y = Math.floor(Math.random()*600);
    while(Math.abs(x1-x)<= 70){
        x= Math.floor(Math.random()*800);
    }
    while(Math.abs(y1-y)<= 50){
        y= Math.floor(Math.random()*600);
    }
    x1=x;
    y1=y;
    no_click.style.left = x + 'px';
    no_click.style.top = y + 'px';
    console.log("left" + no_click.style.left);
    console.log("top" + no_click.style.top);
    console.log("шырина" + height);
}
