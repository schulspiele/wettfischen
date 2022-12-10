let showFishNum = false;

function getFishNum() {
    $.ajax({
        url: "/res/php/teacher/getFishNum.php",
        type: "GET",
        data: {},
        success: function(data) {
            document.getElementById("fishnum").innerText = data;
        }
    });
}

document.getElementById("container_fishnum").addEventListener("click", function() {
    showFishNum = !showFishNum;
    if (showFishNum) {
        getFishNum();
        fishNumLoop = setInterval(getFishNum, 1000);
    } else {
        clearInterval(fishNumLoop);
        document.getElementById("fishnum").innerText = "???";
    }
});