$(document).ready(function () {
    $('#header-title').text('List of Directors');
    $("#Add-btn").click(function() {
        ShowAddModals(this);
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

// Modals for Add Data
function ShowAddModals() {
    actionTitle = 'Add Director';
    $('#form').attr('method', "POST");
    $('#form').attr('action', "");
    $('#profile-img').attr('src',"./ProfileImg/DefaultPPimg.jpg");
    $('#u_file').val(null);
    $('#u_username').val('');
    $('#u_password').val('');
    $('#c_name').val('');
    $('#c_remark').val('');
    $("#AddEditModal").on('show.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-title').text(actionTitle);
        $('#pass-txtbox').show();
        $("#btn-add-client").show();
        $("#btn-edit-client").hide();
    });
}

// Modals for Edit Data
function ShowEditModals() {
    actionTitle = 'Edit Director';
    $("#AddEditModal").on('show.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-title').text(actionTitle);
        $('#pass-txtbox').hide();
        $("#btn-edit-client").show();
        $("#btn-add-client").hide();
    });
}