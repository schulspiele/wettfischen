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
    }
}