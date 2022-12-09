const settings_container = document.getElementById("settings");
const main = document.querySelector("main");
const QAO = document.getElementById("quick_action-overlay");
const start_button = document.getElementById("start_button");
const settings_container_toggle = document.getElementById("settings_toggle");
const game_id_display = document.getElementById("game_id-display");
const game_pass_details = document.getElementById("game_pass_details");
const game_details_container = document.getElementById("game_details_container");
const game_qrcode = document.getElementById("game_qrcode");
const fishnum_settings_toggle = document.getElementById("fishnum_settings_toggle");
const fishnum_settings_input = document.getElementById("fishnum_settings_input");
const fishnum_settings_input_input = document.getElementById("fishnum_settings_input_input");


settings = {
    open: () => {
        settings_container.style.width = "min(30%, 20rem)";
        settings_container.style.display = "block";
        settings_container.style.transform = "translateX(0)";
        main.style.width = "calc(100% - min(30%, 20rem))";
        QAO.style.marginRight = "min(30%, 20rem)";
        start_button.style.marginRight = "min(30%, 20rem)";
        settings_container_toggle.onclick = settings.close;
        settings_container_toggle.classList.add("settings_toggle_active");
    },
    close: () => {
        settings_container.style.width = "0";
        settings_container.style.display = "none";
        settings_container.style.transform = "translateX(-100%)";
        main.style.width = "100%";
        QAO.style.marginRight = "0";
        start_button.style.marginRight = "0";
        settings_container_toggle.onclick = settings.open;
        settings_container_toggle.classList.remove("settings_toggle_active");
    },
    toggle_active: (element) => {
        if (element.classList.contains("settings_active")) {
            element.classList.remove("settings_active");
            element.classList.add("settings_inactive");
        } else {
            element.classList.add("settings_active");
            element.classList.remove("settings_inactive");
        }
    },
    toggle: (element, setting) => {
        switch (setting) {
            case "show_roomcode":
                settings.toggle_active(element);
                if (settings.vars.show_roomcode) {
                    game_id_display.innerText = "????";
                    settings.vars.show_roomcode = false;
                } else {
                    game_id_display.innerText = settings.vars.roomcode;
                    settings.vars.show_roomcode = true;
                }
                break;
            case "activate_roompasscode":
                settings.toggle_active(element);
                if (settings.vars.activate_roompasscode) {
                    game_pass_details.style.display = "none";
                    settings.vars.activate_roompasscode = false;
                    gen_qrcode(false);
                } else {
                    game_pass_details.style.display = "grid";
                    settings.vars.activate_roompasscode = true;
                    gen_qrcode(true);
                }
                $.ajax({
                    url: "/res/php/teacher/setRoomPasscode.php",
                    type: "POST",
                    data: { require_pass: settings.vars.activate_roompasscode },
                    success: function(data) {
                        console.log(data);
                    }
                });
                break;
            case "show_room-qr":
                settings.toggle_active(element);
                if (settings.vars.show_room_qr) {
                    game_qrcode.style.display = "none";
                    settings.vars.show_room_qr = false;
                } else {
                    game_qrcode.style.display = "block";
                    settings.vars.show_room_qr = true;
                }
                break;
            case "random_fishnum":
                settings.toggle_active(element);
                if (settings.vars.random_fishnum) {
                    fishnum_settings_input.style.display = "block";
                    fishnum_settings_toggle.innerHTML = "Genau";
                    setFishNum(false, fishnum_settings_input_input.value);
                    settings.vars.random_fishnum = false;
                } else {
                    fishnum_settings_input.style.display = "none";
                    fishnum_settings_toggle.innerHTML = "Zufällig";
                    setFishNum(true);
                    settings.vars.random_fishnum = true;
                }
                break;
            default:
                console.log(element, setting);
                break;
        }
    },
    vars: {
        roomcode: "1234",
        show_roomcode: true,
        activate_roompasscode: false,
        show_room_qr: true,
        random_fishnum: true,
        fishnum: 15
    }
}

settings.vars.roomcode = game_id_display.innerText;