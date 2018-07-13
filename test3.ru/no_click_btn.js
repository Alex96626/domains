var no_click = document.getElementById('no-comple');
var top = no_click.style.top;
no_click.onmousemove = function() {
    doIt();

}
function doIt(){
    var x1=0,y1=0;
    x = Math.floor(Math.random()*300);
    y = Math.floor(Math.random()*200);
    while(Math.abs(x1-x)<= 70){
        x= Math.floor(Math.random()*300);
    }
    while(Math.abs(y1-y)<= 50){
        y= Math.floor(Math.random()*200);
    }
    x1=x;
    y1=y;
    no_click.style.left = x + 'px';
    no_click.style.top = y + 'px';
    console.log("left" + no_click.style.left);
    console.log("top" + no_click.style.top);
}