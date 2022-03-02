import * as module from './module.js';
$(document).ready(function () {
    $('.dropify').dropify();
    var table = $('#users_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: `${module.baseurl()}/users/users-table`,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $('#users-form').submit(function (event) {
        event.preventDefault();
        var formData = new FormData();
        var id = $("#users-id").val();
        var name = $("#users-name").val();
        var email = $("#users-email").val();
        var level = $("#users-level").val();
        var photo = $('#users-photo')[0].files[0];
        var token = $("meta[name='csrf-token']").attr("content");
        formData.append("id", id);
        formData.append("user_level_id", level);
        formData.append("email", email);
        formData.append("photo", photo);
        formData.append("_token", token);
        module.loading_start();
        $.ajax({
            url: `${module.baseurl()}/master-users/post-data`,
            type: "POST",
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            success: function (response, status, xhr) {
                module.loading_stop();
                console.log(response);
                // if (response.status == true) {
                //     module.send_notif({
                //         icon: 'success',
                //         message: response.message
                //     });
                //     setTimeout(() => {
                //         window.location.href = `${module.baseurl()}/dashboard`;
                //     }, 3100);
                // } else {
                //     module.send_notif({
                //         icon: 'error',
                //         message: response.message
                //     });
                // }
            },
            error: function (xhr, status, error) {
                if (xhr.status == 422) {
                    module.send_notif({
                        icon: 'error',
                        message: xhr.responseJSON.errors.photo[0]
                    });
                } else {
                    module.send_notif({
                        icon: 'error',
                        message: xhr.responseJSON.message
                    });
                }
                module.loading_stop();
            }
        });
        return false;
    });
});