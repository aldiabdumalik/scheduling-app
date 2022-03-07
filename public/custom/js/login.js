import * as module from './module.js';
$(document).ready(function () {
    $('#login-form').submit(function (e) {
        e.preventDefault();
        let nik = $("#login-id").val(),
            password = $("#login-password").val(),
            url = module.base_url + 'auth',
            method = "POST";
        module.loading_start();
        module.callAjax(url, method, {nik: nik, password: password}).then(response => {
            module.loading_stop();
            $('#login-form').trigger('reset');
            window.localStorage.setItem('nik', nik);
            module.send_notif({
                icon: 'success',
                message: response.message
            }).then((msg) => {
                window.location.href = module.base_url;
            });
        });
    });

    $('#login-id').on('change click keyup input paste', function(){
        $(this).val(function (index, value) {
            return value.replace(/(?!\.)\D/g, "");
        });
    });
});