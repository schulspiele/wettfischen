const room = {
    start: function() {
        $.ajax({
            url: '/res/php/teacher/startRoom.php',
            type: 'POST',
            success: function(data) {
                if (data != "success") console.log("Error starting room");
                if (data == "success") location.assign("/teacher/wait_students/");
            }
        });
    },
    end_round: function(confirmed) {
        if (!confirmed) return;
        $.ajax({
            url: '/res/php/teacher/endRound.php',
            type: 'POST',
            success: function(data) {
                if (data == "error") console.log("Error ending round")
                else if (data == "fail") location.assign("/teacher/game_over/")
                else if (data == "success") location.assign("/teacher/round_end/")
                else console.log("Unknown error ending round");
            }
        });
    },
    restart: function() {
        location.assign("/teacher/end_room/");
    }
}