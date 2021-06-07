function pesanAlert(obj) {
    let color = "";
    let msg = "";
    switch (parseInt(obj.code)) {
        case 1:
            color = "success";
            msg = obj.message;
            position = "center";
            break;
        case 0:
            color = "warning";
            msg = obj.message;
            position = "center";
            break;
        default:
            color = "error";
            msg = "Internal Server Error!";
            position = "center";
            break;
    }
    notif({
        msg: "<strong>" + msg + "</strong>",
        type: color,
        position: "center"
    });
}