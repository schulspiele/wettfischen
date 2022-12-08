const reload_timeout = 1000;

function checkRoomReady() {
    const url = new URL(window.location.href);
    const room = url.searchParams.get("r");
    $.ajax({
        url: "/res/php/student/checkRoomReady.php",
        type: "POST",
        data: { room: room },
        success: function(data) {
            console.log(data);
            if (data == 1) {
                window.location.href = "/student/input/?r=" + room;
            } else {
                window.setTimeout(checkRoomReady, reload_timeout);
            }
        }
    });
}
window.setTimeout(checkRoomReady, reload_timeout);