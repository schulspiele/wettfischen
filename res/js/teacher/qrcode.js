const root_url = document.getElementById("server_host_url").innerText;
const roomcode = document.getElementById("game_id-display").innerText;
const roompass = document.getElementById("game_pass-display").innerText;
const game_qrcode_container = document.getElementById("game_qrcode");

let url;

function gen_qrcode(with_passcode) {
    if (with_passcode) url = "https://" + root_url + "/student/room/?r=" + roomcode + "&c=" + roompass;
    else url = "https://" + root_url + "/student/room/?r=" + roomcode;

    if (game_qrcode_container.innerHTML) game_qrcode_container.innerHTML = "";

    new QRCode("game_qrcode", {
        text: url,
        width: 512,
        height: 512,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.L,
    });
}

gen_qrcode(false);