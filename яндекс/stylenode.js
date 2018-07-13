const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question('введите количество сигналов ', (num_signals) => {
    rl.question('введите целые числа ', (num_numbers) => {
    rl.close();
});
});
  let arr_numbers = num_numbers.split(' ');

let arr = [];
for(let i = 0;i<=num_signals-1;i++){
    if(arr.length >= 5) {
        // console.log(typeof +arr[0] + arr[0] + 'arr[0]')
        // console.log( typeof  +arr[1] + 'arr[1]')
        // console.log(arr_numbers[i] + 'arr_number[i-1]')

        while (+arr[0] < +arr_numbers[0]) {
            // delete  arr_numbers[i];
            arr_numbers.splice(0,1);
            // alert('hello')


        }

    }
    arr.push(arr_numbers[0]);


    // delete arr_numbers[i];



    arr.sort(function (a,b) {
        return b - a;
    });
    if(arr.length > 5) {
        if (+arr[0] > +arr_numbers[0]) {
            arr.splice(0, 1)
        }
    }
    arr_numbers.splice(0,1)
    // console.log('массив исходных данных' + arr_numbers)
    if(arr[5] === undefined){
        arr.splice(5,1)
    }
    alert(arr)

}