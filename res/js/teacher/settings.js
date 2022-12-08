const settings_container = document.getElementById("settings");
const main = document.querySelector("main");
const QAO = document.getElementById("quick_action-overlay");
const start_button = document.getElementById("start_button");
const settings_container_toggle = document.getElementById("settings_toggle");


settings = {
    open: () => {
        settings_container.style.width = "min(30%, 20rem)";
        settings_container.style.display = "block";
        settings_container.style.transform = "translateX(0)";
        main.style.width = "calc(100% - min(30%, 20rem))";
        QAO.style.marginRight = "min(30%, 20rem)";
        start_button.style.marginRight = "min(30%, 20rem)";
        settings_container_toggle.onclick = settings.close;
        settings_container_toggle.classList.add("settings_toggle_active");
    },
    close: () => {
        settings_container.style.width = "0";
        settings_container.style.display = "none";
        settings_container.style.transform = "translateX(-100%)";
        main.style.width = "100%";
        QAO.style.marginRight = "0";
        start_button.style.marginRight = "0";
        settings_container_toggle.onclick = settings.open;
        settings_container_toggle.classList.remove("settings_toggle_active");
    },
    toggle: (element) => {
        console.log(element);
    }
}