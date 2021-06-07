const appUrl = "http://127.0.0.1:8000";

$(document).ready(function () {
    if (window.location.href == (appUrl+"/Staff/create")) {
        $('#header-title').text('Add Staff');
        StaffCategorySelectList();
        HideSelect();
    }
    if (window.location.href.includes("edit")) {
        $('#header-title').text('Edit Staff');
        StaffCategorySelectList(parseInt($('#stf_sc_id').attr('data_id')));
        HideSelect(
            parseInt($('#stf_sc_id').attr('data_id')),
            parseInt($('#stf_fks_id').attr('data_id')),
            parseInt($('#stf_ps_id').attr('data_id'))
        );
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
    // console.log(this.value);
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

function HideSelect(sc_id = 0, fks_selected = 0, ps_selected = 0) {
    switch (sc_id) {
        case 1:
            FakultasSelectList(fks_selected);
            $('#select-ps').hide();
            $('#select-mk').hide();
            break;
        case 2:
            FakultasSelectList(fks_selected);
            ProdiSelectList(fks_selected, ps_selected);
            $('#select-mk').hide();
            break;
        default:
            $('#select-fks').hide();
            $('#select-ps').hide();
            $('#select-mk').hide();
            break;
    }
}
// <<

// Index Page
function StaffCategoryTable() {
    let table = $('#sc-table');
    if (typeof(Storage) !== "undefined" && localStorage.getItem("sc") !== null) {
        let data = JSON.parse(localStorage.getItem("sc"));
        renderScRowHtml(table, data);
    }
    else {
        $.ajax({
            type: "GET",
            url: appUrl + "/StaffCategory",
            contentType: "application/json",
            dataType: "json",
            data: null,
            success: function (data) {
                if (data != null) {
                    renderScRowHtml(table, data);
                    if (typeof(Storage) !== "undefined") localStorage.setItem("sc", JSON.stringify(data));
                }
                else {
                    $('#icon-rotate').hide();
                    $('#process-message').text('There is no data');
                    pesanAlert(data);
                }
            },
            error: function () {
                $('#icon-rotate').hide();
                $('#process-message').text('There is no data');
                notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
            }
        });
    }
}

function ShowDetails(obj) {
    GetStaff(parseInt(obj.attributes.data_id.value));
}

function GetStaff(id) {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "GET",
        url: appUrl + "/Staff/" + id,
        contentType: "application/json",
        success: function (data) {
            if (data.code != null) {
                pesanAlert(data);
            }
            else {
                if (data[0].up_filename != null) {
                    let fileExt = data[0].up_filename.split('.').pop();
                    $('#profile-img').attr('src','data:image/'+fileExt+';base64,'+data[0].up_photo+'');
                }
                else $('#profile-img').attr('src',"./ProfileImg/DefaultPPimg.jpg");

                $('#u_username').val(data[0].u_username);
                $('#stf_sc_name').val(data[0].sc_name);

                if (data[0].fks_name != null) {
                    $('#select-fks').show();
                    $('#stf_fks_name').val(data[0].fks_name);
                }
                else $('#select-fks').hide();

                if (data[0].ps_name != null) {
                    $('#select-ps').show();
                    $('#stf_ps_name').val(data[0].ps_name);
                }
                else $('#select-ps').hide();
                
                if (data[0].mk_name != null) {
                    $('#select-mk').show();
                    $('#stf_mk_name').val(data[0].mk_name);
                }
                else $('#select-mk').hide();
                
                $('#stf_fullname').val(data[0].stf_fullname);
                $('#stf_num_stat').val(data[0].stf_num_stat);
                $('.lecture-num').attr('name', data[0].stf_num_stat);
                $('.lecture-num').attr('id', data[0].stf_num_stat);
                $('#'+data[0].stf_num_stat).val(data[0][data[0].stf_num_stat]);
                $('#stf_education').val(data[0].stf_education);
                $('#stf_experience').val(data[0].stf_experience);
                $('#stf_address').val(data[0].stf_address);
                $('#stf_province').val(data[0].stf_province);
                $('#stf_city').val(data[0].stf_city);
                $('#stf_birthplace').val(data[0].stf_birthplace);
                $('#stf_birthdate').val(data[0].stf_birthdate);
                $('#stf_gender').val(data[0].stf_gender);
                $('#stf_religion').val(data[0].stf_religion);
                $('#stf_education').val(data[0].stf_education);
                $('#stf_email').val(data[0].stf_email);
                $('#stf_contact').val(data[0].stf_contact);
                $('#stf_state').val(data[0].stf_state);
                $('#stf_status').val(data[0].stf_status);
                $('#DetailModal').modal('show');
            }
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        }
    });
}

// Crate Page
function setNumberType(obj) {
    let input = $('.lecture-num');
    input.attr('name', obj.value);
    input.attr('id', obj.value);
    input.attr('placeholder', "Staff " + obj.options[obj.selectedIndex].text + " Number");
}

function setNumberPlaceholder() {
    $('.lecture-num').attr('placeholder','Lecturer ' + $('#stf_num_stat option:selected').text() + ' Number');
}

function StaffCategorySelectList(selected = 0) {
    let comboBox = $('#stf_sc_id');
    if (typeof(Storage) !== "undefined" && localStorage.getItem("sc") !== null) {
        let data = JSON.parse(localStorage.getItem("sc"));
        renderScOptionHtml(comboBox, data, selected);
    }
    else {
        $.ajax({
            type: "GET",
            url: appUrl + "/StaffCategory",
            contentType: "application/json",
            dataType: "json",
            data: null,
            success: function (data) {
                renderScOptionHtml(comboBox, data, selected);
            },
            error: function () {
                notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
            }
        });
    }
}

function FakultasSelectList(selected = 0) {
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
            if (selected !== 0) comboBox.val(selected);
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        },
        complete: function () {
            $('#select-fks').show();
        }
    });
}

function ProdiSelectList(fks_id, selected = 0) {
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
            if (selected !== 0) comboBox.val(selected);
        },
        error: function () {
            notif({msg: "<b>Connection Error!</b>", type: "error", position: "center"});
        },
        complete: function () {
            $('#select-ps').show();
        }
    });
}

function MatkulSelectList(mk_ps_id, selected = 0) {
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
                if (selected !== 0) comboBox.val(selected);
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

function renderScRowHtml(table, data) {
    let rowHtml = '';
    $(table).children('tbody').empty();
    for (let i = 0; i < data.length; i++) {
        let number = i+1;
        rowHtml =
        '<tr>' +
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

function renderScOptionHtml(select, data, selected = 0) {
    let opsi = '';
    select.empty();
    select.append('<option selected value="null">Select Category</option>');
    for (let i = 0; i < data.length; i++) {
        opsi = '<option value="'+data[i].sc_id+'" title="'+data[i].sc_desc+'">'+data[i].sc_name+'</option>';
        select.append(opsi);
    }
    if (selected !== 0) select.val(selected);
}