const input = document.getElementById("roomcode_input");
const button = document.getElementById("roomcode_submit");
button.style.visibility = "hidden";
if (input) input.addEventListener("input", function() {
    const value = input.value;
    if (value.length < 4) button.style.visibility = "hidden";
    if (value.length > 16) button.style.visibility = "hidden";
    if (4 <= value.length && value.length <= 16) button.style.visibility = "visible";
});