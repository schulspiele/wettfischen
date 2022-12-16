const reload_timeout = 1000;

function checkInputReady() {
    const url = new URL(window.location.href);
    const room = url.searchParams.get("r");
    $.ajax({
        url: "/res/php/student/checkInputReady.php",
        type: "POST",
        data: { room: room },
        success: function(data) {
            console.log(data);
            if (data == 1) window.location.href = "/student/input/?r=" + room;
            else if (data == 2) window.location.href = "/" + room;
            else window.setTimeout(checkInputReady, reload_timeout);
        }
    });
}
window.setTimeout(checkInputReady, reload_timeout);