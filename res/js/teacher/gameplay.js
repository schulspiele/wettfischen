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
        location.assign("/teacher/round_end/");
    },
    next_round: function() {
        location.assign("/teacher/next_round/");
    },
    restart: function() {
        location.assign("/teacher/end_room/");
    }
}