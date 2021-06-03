const appUrl = "http://127.0.0.1:8000";

$(document).ready(function () {
    $('#header-title').text('List of Directors');
    $("#Add-btn").click(function() {
        ShowAddModals(this);
    });
    $("#btn-add-client").click(function() {
        AddClient(this);
    });
    $('#btn-edit-client').click(function () {
        EditClient(this);
    });
});

$('#u_file').on('change', function () {
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

// Modals for Show Details
function ShowDetails(obj) {
    let actionTitle = 'Details';
    $('#form').attr('method', "");
    $('#form').attr('action', "");
    $("#AddEditModal").on('show.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-title').text(actionTitle);
        $('#pass-txtbox').hide();
        $("#btn-edit-client").hide();
        $("#btn-add-client").hide();
    });
    GetClient(parseInt(obj.attributes.data_id.value));
}

// Modals for Add Data
function ShowAddModals() {
    let actionTitle = 'Add Director';
    $('#form').attr('method', "POST");
    $('#form').attr('action', appUrl + "/Client");
    $('#profile-img').attr('src',"./ProfileImg/DefaultPPimg.jpg");
    ClearInput();
    $("#AddEditModal").on('show.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-title').text(actionTitle);
        $('#pass-txtbox').show();
        $("#btn-add-client").show();
        $("#btn-edit-client").hide();
    });
}

// Modals for Edit Data
function ShowEditModals(obj) {
    let actionTitle = 'Edit Director';
    let obj_id = parseInt(obj.attributes.data_id.value);
    $('#form').attr('method', "PUT");
    $('#form').attr('action', appUrl + "/Client/" + obj_id);
    $("#AddEditModal").on('show.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-title').text(actionTitle);
        $('#pass-txtbox').hide();
        $("#btn-edit-client").show();
        $("#btn-add-client").hide();
    });
    GetClient(obj_id);
}

function ClearInput() {
    $('#u_file').val(null);
    $('#u_username').val('');
    $('#u_password').val('');
    $('#c_name').val('');
    $('#c_remark').val('');
}

// JQuery Validate
function validasi() {
    var isValid = true;
    if($('#u_username').val().trim() == "") {
        $('#u_username').css('border-color', 'Red');
        $('#username-alrt').show();
        isValid = false;
    } else {
        $('#u_username').css('border-color', 'lightgray');
        $('#username-alrt').hide();
    }
    return isValid;
}

function AddClient() {
    var res = validasi();
    if($('#u_password').val().trim() == "") {
        $('#u_password').css('border-color', 'Red');
        $('#password-alrt').show();
        res = false;
    } else {
        $('#u_password').css('border-color', 'lightgray');
        $('#password-alrt').hide();
    }
    if(res == false) return false;

    var formData = new FormData();
    let imgFile = $('#u_file');
    if (imgFile[0].files[0] != null)
        formData.append("u_file", imgFile[0].files[0], imgFile.val());
    
    formData.append("u_username", $('#u_username').val());
    formData.append("u_password", $('#u_password').val());
    formData.append("c_name", $('#c_name').val());
    formData.append("c_remark", $('#c_remark').val());

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: $('#form').attr('method'),
        url: $('#form').attr('action'),
        data: formData,
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
        },
        complete: function () {
            $('#AddEditModal').modal('hide');
            ClearInput();
        }
    });
}

function GetClient(id) {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "GET",
        url: appUrl + "/Client/" + id,
        contentType: "application/json",
        success: function (data) {
            if (data != null) {
                if (data[0].up_filename != null) {
                    let fileExt = data[0].up_filename.split('.').pop();
                    $('#profile-img').attr('src','data:image/'+fileExt+';base64,'+data[0].up_photo+'');
                    $('#profile-img').attr('data-id',data[0].up_id);
                }
                else {
                    $('#profile-img').attr('src',"./ProfileImg/DefaultPPimg.jpg");
                }
                $('#u_username').val(data[0].u_username);
                $('#c_name').val(data[0].c_name);
                $('#c_remark').val(data[0].c_remark);
                $("#AddEditModal").modal('show');
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

function EditClient() {
    var res = validasi();
    if(res == false) return false;

    var formData = new FormData();
    let imgFile = $('#u_file');
    if (imgFile[0].files[0] != null) {
        formData.append("u_file", imgFile[0].files[0], imgFile.val());
        formData.append("up_id", parseInt($('#profile-img').attr('data-id')));
    }
    
    formData.append("u_username", $('#u_username').val());
    formData.append("c_name", $('#c_name').val());
    formData.append("c_remark", $('#c_remark').val());

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        url: $('#form').attr('action') + "?_method=PUT",
        data: formData,
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
        },
        complete: function () {
            $('#AddEditModal').modal('hide');
            ClearInput();
        }
    });
}

function DeleteClient(obj) {
    let obj_id = parseInt(obj.attributes.data_id.value);
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "DELETE",
            url: appUrl + "/Client/" + obj_id,
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