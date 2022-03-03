import * as module from './module.js';
$(document).ready(function () {
    let dt = $('#employee_table').DataTable({
        processing: true,
        serverSide: true,
        lengthChange: false,
        ajax: {
            method: "POST",
            url: module.base_url + 'employee/datatable',
            headers: {'X-CSRF-TOKEN': module.header_token},
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nik', name: 'nik' },
            { data: 'name', name: 'name' },
            { data: 'whatsapp', name: 'whatsapp' },
            { data: '_color', name: '_color' },
            // { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        dom: "<'row'<'col-sm-12 col-md-6' <'trash-view'>><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        initComplete: function() {
            $("div.trash-view").html('<button type="button" id="trash-table" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Trash Table</button>');
        }
    });

    
    const colors = () => {
        return new Promise((resolve, reject) => {
            module.callAjax(module.base_url + 'employee/get_colors', 'GET').then(response => {
                $('#color').html('<option value="">Select color</option>');
                $.each(response.content, function (idx, $data) {
                    $('#color').append($('<option>', { 
                        value: $data.code,
                        text: $data.code
                    })); 

                    $(`#color option[value="${$data.code}"]`).css({background: $data.code, color: 'white'});
                });
                resolve(response);
            });
        });
    }

    colors();

    $('#color').change(function(){
        var color = $("option:selected", this).val();
        console.log(color);
        $("#color").css({background: color, color: 'white'});
    });

    $('#nik').on('change click keyup input paste', function(){
        $(this).val(function (index, value) {
            return value.replace(/(?!\.)\D/g, "");
        });
    });
    $('#whatsapp').on('change click keyup input paste', function(){
        $(this).val(function (index, value) {
            return value.replace(/(?!\.)\D/g, "");
        });
    });

    let touchtime = 0;
    $('#employee_table tbody').on('click', 'tr', function () {
        if (touchtime == 0) {
            touchtime = new Date().getTime();
        } else {
            if (((new Date().getTime()) - touchtime) < 800) {
                var data = dt.row( this ).data();
                if (data != undefined) {
                    $('#color').append($('<option>', { 
                        value: data.color,
                        text: data.color
                    })); 

                    $('#nik').val(data.nik);
                    $('#nik').prop('readonly', true);

                    $('#name').val(data.name);
                    $('#whatsapp').val(data.whatsapp);
                    $('#color').val(data.color);

                    $("#color").css({background: data.color, color: 'white'});
                    $('#submit').text('Update');
                    module.isHidden('#delete', false);
                }
                touchtime = 0;
            } else {
                touchtime = new Date().getTime();
            }
        }
    });

    const resetForm = () => {
        $('#form-employee').trigger('reset');
        $('#form-employee input').prop('readonly', false);
        colors();
        $('#color').removeAttr('style');
        $('#submit').text('Save');
        module.isHidden('#delete', true);
    }

    $('#cancel').click(function() {
        resetForm()
    });
    
    $('#form-employee').submit(function (e) {
        e.preventDefault();
        module.loading_start();

        let url = module.base_url + 'employee/' + $('#nik').val() + '/detail',
            method = "GET",
            data = {
                nik: $('#nik').val(),
                name: $('#name').val(),
                whatsapp: $('#whatsapp').val(),
                color: $('#color').val()
            }

        module.callAjax(url, method).then(response => {
            if (parseInt(response.message) == 1) {
                method = "PUT"
                url = module.base_url + `employee/${data.nik}/update`
            }else{
                method = "POST"
                url = module.base_url + `employee/save`
            }
            module.callAjax(url, method, data).then(response => {
                module.loading_stop();
                resetForm();
                dt.ajax.reload();
                module.send_notif({
                    icon: 'success',
                    message: response.message
                });
            });
        });
    });

    $('#delete').click(function () {
        let nik = $('#nik').val();
        if (nik == "") {
            module.send_notif({
                icon: 'warning',
                message: 'Data not found!'
            });
        }else{
            module.loading_start();
            let url = module.base_url + 'employee/' + $('#nik').val() + '/delete',
                method = "DELETE"
            module.callAjax(url, method).then(response => {
                module.loading_stop();
                resetForm();
                dt.ajax.reload();
                module.send_notif({
                    icon: 'success',
                    message: response.message
                });
            });
        }
    });

    $(document).click('#trash-table', function () {
        
    });
});