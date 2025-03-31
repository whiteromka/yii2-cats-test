// После того как все скрипты подгузились на страницу.
// И при клике на html элементе
$(document).on('click', '.js-btn-register-ajax', function(e) {

    e.preventDefault(); // Отменить переход по ссылке
    let url = '/user-register/register-ajax-logic'; // Куда отправим

    let data = $('#user-form').serializeArray(); // что отправляем
    //Jquery отправь POST-ом данные data на url и когда сервер ответит, сложи ответ в res
    $.post(url, data).done(res => {
        if (res.success == 1) {
            let selector = '.js-success-message';
            $(selector).html(res.html); // Вставить HTML
            $('.js-form').remove();
        } else {
            alert(res.error);
        }
    });
});
