
// После того как все скрипты подгузились на страницу.
// И при клике на html элементе с классом js-btn-disactive
$(document).on('click', '.js-btn-disactive', function(e) {

    e.preventDefault(); // Отменить переход по ссылке
    let userId = $(this).attr('data-user-id'); // Получаем кастомный аттрибут
    let url = '/user-passport-demo/disactive-status-ajax?id=' + userId; // Куда отправим

    //Jquery отправь GET-ом запрос на url и когда сервер ответит сложи ответ в data
    $.get(url).done(data => {
        if (data.success === 1) {
            // Вставить HTML в нужный кубик
            let selector =  '.js-wrap-item-' + userId;
            $(selector).html(data.html);
        } else {
            alert(data.error);
        }
    });
});
