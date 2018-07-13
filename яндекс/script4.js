let numbers = prompt('введите 5 числе(1-n,2..3-первый диапозон,4..5-второй диапозон)');
let array_Numbers = numbers.split(' ');
console.log(array_Numbers);
let arr_first  = [];// массив из первого диапозона чисел
let arr_second  = [];// массив из второго диапозона чисел
for(let i = array_Numbers[1];i<=array_Numbers[2];i++){
    arr_first.push(i)
}
for(let i = array_Numbers[3];i<=array_Numbers[4];i++){
    arr_second.push(i)
}
console.log(arr_first);
console.log(arr_second);
let arrLast = [];
for(let i = 0; i<=arr_first.length;i++) {
     for (let j = 0; j <= arr_second.length; j++) {
         if(+arr_first[i] + +arr_second[j] === +array_Numbers[0]){

             arrLast.push(arr_first[i],arr_second[j])

         }


        }
     }
     if(arrLast.length<=0){
        console.log("-1")

     }else {
         console.log(arrLast);
         let last = arrLast[0];
         let a = 1;//индекц второго подходящего числа в массиве
         if (arrLast.length > 2) {
             for (let i = 2; i <= arrLast.length - 1; i += 2) {
                 if (last < arrLast[i]) {

                 } else {
                     last = arrLast[i];
                     a += 2;
                 }
             }
         }
         console.log(last + " " + arrLast[a]);
     }



