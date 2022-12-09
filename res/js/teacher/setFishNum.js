function setFishNum(random, num) {
    if (random) num = Math.floor(Math.random() * 1000) + 10;
    console.log(random, num);
    $.ajax({
        url: "/res/php/teacher/setFishNum.php",
        type: "POST",
        data: {
            fish_num: num
        },
        success: function(data) {
            console.log(data);
        }
    });
}

fishnum_settings_input_input.addEventListener("change", function() {
    setFishNum(false, fishnum_settings_input_input.value);
});