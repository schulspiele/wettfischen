const people_voted = document.getElementById("people_voted");
const people_voted_container = document.getElementById("people_voted_container");

const num_people = people_voted_container.innerText.split("/ ")[1];

window.setInterval(function() {
    $.ajax({
        url: "/res/php/teacher/getVoteNum.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
            people_voted.innerText = data;
            if (data == num_people) {
                people_voted.style.color = "green";
                room.end_round(true);
            }
        }
    });
}, 1000);