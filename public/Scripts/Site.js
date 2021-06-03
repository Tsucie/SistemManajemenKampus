$(document).ready(function () {
    $('#header-title').text('List of Rectors');
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

function setNumberType(obj) {
    let input = $('.lecture-num');
    input.attr('name', obj.value);
    input.attr('id', obj.value);
    input.attr('placeholder', $('#s_remark').val() + " " + obj.options[obj.selectedIndex].text + " Number");
}

function setNumberPlaceholder() {
    $('.lecture-num').attr('placeholder',$('#s_remark').val() + ' ' + $('#s_num_stat option:selected').text() + ' Number');
}