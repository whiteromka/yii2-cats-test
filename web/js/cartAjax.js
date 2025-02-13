
// После того как все скрипты подгузились на страницу.
// И при клике на html элементе с классом js-btn-disactive
$(document).on('click', '.js-btn-cartAjax', function(e) {

    e.preventDefault(); // Отменить переход по ссылке
    let catId = $(this).attr('data-cat-id'); // Получаем кастомный аттрибут
    let url = '/cart/add-ajax?id=' + catId; // Куда отправим

    //Jquery отправь GET-ом запрос на url и когда сервер ответит сложи ответ в data
    $.get(url).done(data => {
        if (data.success === 1) {
            // Вставить HTML в нужный кубик
            let selector = '#js-cart-ajax-wrap';
            $(selector).html(data.html);
        } else {
            alert(data.error);
        }
    });
});
