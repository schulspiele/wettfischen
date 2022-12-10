const number_display = document.getElementById("number_display");
const numpad_keys = document.getElementsByClassName("numpad_key");

let number = "";
let room = new URLSearchParams(window.location.search).get("r");

for (let i = 0; i < numpad_keys.length; i++) {
    numpad_keys[i].addEventListener("click", function() {
        if (numpad_keys[i].innerHTML.length != 1) {
            if (numpad_keys[i].innerHTML.includes("xmark")) {
                number = number.slice(0, -1);
            } else if (numpad_keys[i].innerHTML.includes("check")) $.ajax({
                url: "/res/php/student/submitFishing.php",
                type: "POST",
                data: {
                    number: number
                },
                success: function(data) {
                    if (data == "success") {
                        location.assign("/student/wait_teacher/?r=" + room);
                    } else {
                        console.log(data);
                    }
                }
            });
        } else if (number.length < 10) {
            number += numpad_keys[i].innerText;
        }
        number_display.innerText = number;
    });
}