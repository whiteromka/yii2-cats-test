// После того как все скрипты подгузились на страницу.
// И при клике на html элементе с классом js-btn-disactive
$(document).on('click', '.js-btn-disactive', function(e) {

    e.preventDefault(); // Отменить переход по ссылке
    let userId = $(this).attr('data-user-id'); // Получаем кастомный аттрибут
    let url = '/user-passport/disactive-status-ajax?id=' + userId; // Куда отправим

    //Jquery отправь GET-ом запрос на url и когда сервер ответит сложи ответ в data
    $.get(url).done(data => {
        if (data.success === 1) {
            // 1 найти у того на кого ткнули status: active >>> disactive
            let cssId = "#status-id-" + userId; // #status-id-12
            $(cssId).text('disactive'); // Найди по идентификатору и замени текст

            // 2 найти у того на кого ткнули кнопку "set dicative" и удалить ее
            $(this).remove();
        } else {
            alert(data.error);
        }
    });
});
