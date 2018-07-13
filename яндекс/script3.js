let num_signals = +prompt('введите длину массива');//количество элементов в массиве
// // console.log(num_signals)
let num_numbers = prompt('введите целые числа');//элементы массива
// let num_numbers = ['7', '8', '6', '5', '1', '2', '3', '4']
// // console.log(typeof num_numbers)
let arr_numbers = num_numbers.split(' ');
console.log(arr_numbers);
let counter = 0;//кол - во пар одинаковых чисел
for(let i = 0; i<=num_signals-1;i++) {
         if(arr_numbers[i] === arr_numbers[i+1]){

             counter++;
         }
     }
console.log(num_signals -counter);
