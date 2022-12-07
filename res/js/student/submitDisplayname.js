submitDisplayname = () => {
    const displayname = document.getElementById("displayname_input").value;
    const url = new URL(window.location.href);
    const room = url.searchParams.get("r");
    const code = url.searchParams.get("c");
    // Send it per ajax 
    // To: /res/php/student/submitDisplayname.php
    // With: displayname, room
    // Return: success
    // If success, then:
    // Elements with class "overlay" display: none
    $.ajax({
        url: "/res/php/student/submitDisplayname.php",
        type: "POST",
        data: {
            displayname: displayname,
            room: room,
            code: code
        },
        success: function(data) {
            if (data == "success") {
                const overlays = document.getElementsByClassName("overlay");
                for (let i = 0; i < overlays.length; i++) {
                    overlays[i].style.display = "none";
                }
            } else {
                console.log("Error: " + data);
            }
        }
    });
}