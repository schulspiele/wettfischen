let students = [];
let new_students = [];
let reload_timeout = 2500;

const player_list = document.getElementById("player_list-container");
const start_room_button = document.getElementById("start_button");

function pasteStudents() {
    new_students.forEach(student => {
        const student_div = document.createElement("div");
        student_div.classList.add("player_list-item");
        student_div.innerText = student;
        player_list.appendChild(student_div);
    });
    students = students.concat(new_students);
    new_students = [];
    window.setTimeout(loadStudents, reload_timeout);
}

function checkEnoughStudents() {
    if (students.length < 2) {
        start_room_button.style.display = "none";
    } else {
        start_room_button.style.display = "block";
    }
}

function loadStudents() {
    const url = new URL(window.location.href);
    const room = url.searchParams.get("r");
    // Send it per ajax 
    // To: /res/php/teacher/loadStudents.php
    // With: room
    // Return: success
    // Success: restart 1s timeout to self-load function
    $.ajax({
        url: "/res/php/teacher/loadStudents.php",
        type: "POST",
        data: {},
        success: function(data) {
            if (data == "error") console.log("Error loading students");
            if (data != "") {
                const student_list = JSON.parse(data);
                // Add students to new_students array IF they are not already in the students array
                student_list.forEach(student => {
                    if (!students.includes(student)) new_students.push(student);
                });
                pasteStudents();
                checkEnoughStudents();
            } else {
                window.setTimeout(loadStudents, reload_timeout);
            }
        }
    });
}
window.setTimeout(loadStudents, reload_timeout);