const appUrl = "http://127.0.0.1:8000";

$(document).ready(function () {
    if (window.location.href == (appUrl+"/Staff/create")) {
        $('#header-title').text('Add Staff');
        StaffCategorySelectList();
        $('#select-fks').hide();
        $('#select-ps').hide();
        $('#select-mk').hide();
    }
    else {
        $('#header-title').text('Staff Management');
        StaffCategoryTable();
    }
});

$('#image').on('change', function () {
    readUrl(this, '#profile-img');
});

function readUrl(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(selector).attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Responsive Select Box >>
$('#stf_sc_id').on('change', function () {
    console.log(this.value);
    if (this.value == 1 || this.value == 2 || this.value == 3) {
        FakultasSelectList();
        if (this.value == 2 || this.value == 3) {
            $('#select-ps').show();
            if (this.value == 3) $('#select-mk').show();
            else $('#select-mk').hide();
        }
        else {
            $('#select-ps').hide();
            $('#select-mk').hide();
        }
    }
    else {
        $('#select-fks').hide();
        $('#select-ps').hide();
        $('#select-mk').hide();
    }
});

$("#stf_fks_id").on('change', function () {
    if ($('#stf_sc_id').val() == 2 || $('#stf_sc_id').val() == 3) {
        ProdiSelectList(parseInt(this.value));
    }
});

$("#stf_ps_id").on('change', function () {
    if ($('#stf_sc_id').val() == 3) {
        MatkulSelectList(parseInt(this.value));
    }
});
// <<

function StaffCategoryTable() {
    let table = $('#sc-table');
    $.ajax({
        type: "GET",
        url: appUrl + "/StaffCategory",
        contentType: "application/json",
        dataType: "json",
        data: null,
        success: function (data) {
            if (data != null) {
                $(table).children('tbody').empty();
                var rowHtml = '';
                for (let i = 0; i < data.length; i++) {
                    let number = i+1;
                    rowHtml = '<tr>' +
                                '<th scope="row">' +
                                  '<div class="media align-items-center">' +
                                    '<a class="mr-3 text-bold text-white" style="link-style: none !important;">' + number + '</a>' +
                                    '<div class="media-body">' +
                                      '<span class="name mb-0 text-sm">' + data[i].sc_name + '</span>' +
                                    '</div>' +
                                  '</div>'+
                                '</th>'+
                                '<td class="desc">' + data[i].sc_desc + '</td>' +
                              '</tr>';
                    $(table).append(rowHtml);
                }
            }
            else {
                $('#no-data').show();
            }
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
            $('#no-data').show();
        },
        complete: function () {
            $('#icon-rotate').hide();
        }
    });
}

function setNumberType(obj) {
    let input = $('.lecture-num');
    input.attr('name', obj.value);
    input.attr('id', obj.value);
    input.attr('placeholder', "Lecturer " + obj.options[obj.selectedIndex].text + " Number");
}

function setNumberPlaceholder() {
    $('.lecture-num').attr('placeholder','Lecturer ' + $('#stf_num_stat option:selected').text() + ' Number');
}

function StaffCategorySelectList() {
    let comboBox = $('#stf_sc_id');
    $.ajax({
        type: "GET",
        url: appUrl + "/StaffCategory",
        contentType: "application/json",
        dataType: "json",
        data: null,
        success: function (data) {
            comboBox.empty();
            comboBox.append('<option selected value="null">Select Category</option>');
            let opsi = '';
            for (let i = 0; i < data.length; i++) {
                opsi = '<option value="'+data[i].sc_id+'" title="'+data[i].sc_desc+'">'+data[i].sc_name+'</option>';
                comboBox.append(opsi);
            }
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        }
    });
}

function FakultasSelectList() {
    let comboBox = $('#stf_fks_id');
    $.ajax({
        type: "GET",
        url: appUrl + "/Fakultas/GetAll",
        contentType: "application/json",
        dataType: "json",
        data: null,
        success: function (data) {
            comboBox.empty();
            comboBox.append('<option selected value="null">Select Faculty</option>');
            let opsi = '';
            for (let i = 0; i < data.length; i++) {
                opsi = '<option value="'+data[i].fks_id+'" title="'+data[i].fks_desc+'">'+data[i].fks_name+'</option>';
                comboBox.append(opsi);
            }
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        },
        complete: function () {
            $('#select-fks').show();
        }
    });
}

function ProdiSelectList(fks_id) {
    let comboBox = $('#stf_ps_id');
    $.ajax({
        type: "GET",
        url: appUrl + "/Prodi/GetList/" + fks_id,
        contentType: "application/json",
        dataType: "json",
        data: null,
        success: function (data) {
            comboBox.empty();
            comboBox.append('<option selected value="null">Select Research</option>');
            let opsi = '';
            for (let i = 0; i < data.length; i++) {
                opsi = '<option value="'+data[i].ps_id+'" title="'+data[i].ps_desc+'">'+data[i].ps_name+'</option>';
                comboBox.append(opsi);
            }
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        },
        complete: function () {
            $('#select-ps').show();
        }
    });
}

function MatkulSelectList(mk_ps_id) {
    let comboBox = $('#stf_mk_id');
    $.ajax({
        type: "GET",
        url: appUrl + "/Matkul/GetList/" + mk_ps_id,
        contentType: "application/json",
        dataType: "json",
        data: null,
        success: function (data) {
            comboBox.empty();
            if (data.length > 0) {
                let opsi = '';
                for (let i = 0; i < data.length; i++) {
                    opsi = '<option value="'+data[i].mk_id+'" title="'+data[i].mk_desc+'">'+data[i].mk_name+'</option>';
                    comboBox.append(opsi);
                }
            }
            else {
                comboBox.append('<option selected value="null">No Course in this Research</option>');
            }
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        },
        complete: function () {
            $('#select-mk').show();
        }
    });
}

function DeleteStaff(obj) {
    let obj_id = parseInt(obj.attributes.data_id.value);
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "DELETE",
            url: appUrl + "/Staff/" + obj_id,
            data: null,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.code == 1) {
                    pesanAlert(data);
                    setTimeout(function () { window.location.reload() }, 2000);
                }
                else {
                    pesanAlert(data);
                }
            },
            error: function () {
                notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
            }
        });
    }
}