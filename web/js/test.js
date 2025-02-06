// var name; // Объявление переменной
// let name; // Объявление переменной
// name = 'Anna'; name = "Anna"; // Присвоение данных в переменную

// МАССИВЫ
// let nums = [1, 2, 3];
// let chars = ['a', 'b' ,'cde'];

// FOR
let chars = ['a', 'b', 'c'];
for (let i = 0; i < chars.length; i++) {
    let current = chars[i];
    console.log(current);
}

// WHILE
let names = ['Anna', 'Bob'];
let i = 0;
let countArray = names.length;
while (i < countArray) {
    let currentName = names[i];
    console.log(currentName);
    i++;
}

// FOR IN
// let someString = 'abcde';
// for (let i in someString) { // Тут i это как бы ключ в массиве. А someString как бы массив, хотя по факту это строка
//     console.log(someString[i]);
// }

// Функции
// function sum(a, b) {
//     return a + b;
// }
// let sumRes = sum(1 ,10);

// Объекты
// let person = {
//     name: "John",
//     age: 30,
//     isAdmin: true
// }

// Объекты с методами
// let man = {
//     name: "John",
//     age: 30,
//     isAdmin: true,
//     sayAboutMe: function() {
//         return 'My name is ' + this.name + '.I am ' + this.age + ' years old';
//     },
//     checkIsAdmin: function() {
//         return this.isAdmin ? 'Yes' : 'No';
//     }
// }
// console.log(man.sayAboutMe());
// console.log(man.checkIsAdmin());

// FOR IN в объектах
// let student = { name: 'Маша', class: 7, age: 12 }
// for (let key in student) {
//     console.log(key + ' - ' + student[key]);
// }

// Jquery ==============
// $(document).ready(function() { // Jquery обертка. Когда страница полностью загрузилась начинаем исполнять ваш код
//     // тут ваш код
//     console.log('Весь html подгружен!')
// });

// В переменной selector объект Jquery который поймал в себя html с аттрибутом id = "useruniversalsearch-name"
// let selector = $('#useruniversalsearch-name');
// console.log(selector);
// selector.val('Roooooman!!!!')

// В переменной selector объект Jquery который поймал в себя все html эллементы с аттрибутом class = "form-control"
// let selectors = $('.form-control');
// console.log(selectors);
// selectors.remove(); // Удалить все пойманные элементы

// let h1 = $('h1');
// console.log(h1);
// h1.css('color', 'red');

// $('.user-passport-item').hover(
//     function() {
//         $(this).css({
//             'box-shadow': '0 0 15px blue' // эффект тени при наведении
//         });
//     },
//     function() {
//         $(this).css({
//             'box-shadow': 'none' // сброс эффекта тени
//         });
//     }
// );

// $('.user-passport-item').click(function() {
//     $(this).find('h3').after('<p>это вставлено из Javascript</p>');
// });


