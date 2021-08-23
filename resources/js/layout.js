// theme selector
const theme_selection = document.querySelector("#theme-selection");
const theme_selection_label = document.querySelector("#theme-selection-label");
const theme_selection_icon = document.querySelector("#theme-selection-icon");
const html = document.querySelector("html");

const toogleTheme = function () {
    if (localStorage.theme === 'dark') {
        theme_selection.value = "dark";
    }
    if (localStorage.theme === 'light') {
        theme_selection.value = "light";
    }
    if (!('theme' in localStorage)) {
        theme_selection.value = "device";
    }

    if (theme_selection.value == "dark") {
        localStorage.removeItem('theme');
        set_theme();
    }
    if (theme_selection.value == "light") {
        localStorage.setItem('theme', 'dark');
        set_theme();
    }
    if (theme_selection.value == "device") {
        localStorage.setItem('theme', 'light');
        set_theme();
    }
}

theme_selection.addEventListener("click", toogleTheme);

function set_theme() {
    if (localStorage.theme === 'dark') {
        html.classList.add("dark");
        theme_selection_icon.classList.remove("icon-sun");
        theme_selection_icon.classList.remove("icon-dark-light");
        theme_selection_icon.classList.add("icon-moon");
        theme_selection_label.setAttribute('title', 'Cambiar a tema del sistema');
    } else if (localStorage.theme === 'light') {
        html.classList.remove("dark");
        theme_selection_icon.classList.remove("icon-moon");
        theme_selection_icon.classList.remove("icon-dark-light");
        theme_selection_icon.classList.add("icon-sun");
        theme_selection_label.setAttribute('title', 'Cambiar a modo oscuro');
    } else {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            html.classList.add("dark");
        } else {
            html.classList.remove("dark");
        }
        theme_selection_icon.classList.remove("icon-moon");
        theme_selection_icon.classList.remove("icon-sun");
        theme_selection_icon.classList.add("icon-dark-light");
        theme_selection_label.setAttribute('title', 'Cambiar a modo claro');
    }
}

set_theme();
// END: theme selector

// navigation effect
$(".menu-item").on('mouseenter', function(){
    $(".menu-item").find('a').not($(this).find('a')).css('opacity','0.65')
}).on('mouseleave', function(){
    $(".menu-item").find('a').css('opacity','1');
});
$(".menu-item").on('focus', function(){
    $(".menu-item").find('a').not($(this).find('a')).css('opacity','0.65')
}).on('mouseleave', function(){
    $(".menu-item").find('a').css('opacity','1');
});
// END: navigation effect