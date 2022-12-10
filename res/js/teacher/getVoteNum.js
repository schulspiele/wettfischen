const people_voted = document.getElementById("people_voted");

window.setInterval(function() {
    $.ajax({
        url: "/res/php/teacher/getVoteNum.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
            people_voted.innerText = data;
        }
    });
}, 1000);