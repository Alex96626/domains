let num_signals = +prompt('введите количество сигналов')//количество сигналов
let num_numbers = prompt('введите целые числа')
 console.log( num_numbers)
let arr_numbers = num_numbers.split(' ');
let arr = [];
for(let i = 0;i<=num_signals-1;i++){
        if(arr.length >= 5) {
             while (+arr[0] < +arr_numbers[0]) {
                  // delete  arr_numbers[i];
                    arr_numbers.splice(0,1);
                 // alert('hello')
             }
        }
    arr.push(arr_numbers[0]);
    arr.sort(function (a,b) {
                return b - a;
    });
    if(arr.length > 5) {
        if (+arr[0] > +arr_numbers[0]) {
            arr.splice(0, 1)
        }
    }
    arr_numbers.splice(0,1)
    if(arr[5] === undefined){
        arr.splice(5,1)
    }
console.log(arr)
}
