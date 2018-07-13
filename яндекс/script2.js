let numbers = prompt('введите целое число');
let counter = 0;//количесво подходящих чисел
let arrNum = [];//массив из возможных чисел
for(let i = 0; i<numbers;i++){
    arrNum.push(i);
}
//поиск степени двойки
for(let i = 0; i<numbers;i++) {
    for(let j = 0; j<numbers;j++) {
        let exponen = Math.pow(2, i)
        // console.log(exponen);

        if (exponen === arrNum[j]) {
            counter++;
        }

    }
}
console.log(counter);
