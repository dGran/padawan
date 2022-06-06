// Loader
window.addEventListener("load", function() {
    document.getElementById("loader").classList.toggle("loader-off");
    setTimeout(function() { document.getElementById("loader").style.display = "none"; }, 800);
});

// Livewire 419
window.livewire.onError(statusCode => {
    if (statusCode === 419) {
        toastr.options = {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "timeOut": "1000",
        };
        toastr.options.onHidden = function() {
            window.location.href=window.location.href;
        }
        toastr.info('Recargando página por inactividad');
        return false;
    }
});
// END: Livewire 419

// navigation effect
$(".menu-item").on('mouseenter', function(){
    $(".menu-item").not($(this)).css('opacity','0.65')
}).on('mouseleave', function(){
    $(".menu-item").css('opacity','1');
});
$(".menu-item").on('focusin', function(){
    $(".menu-item").not($(this)).css('opacity','0.65')
}).on('focusout', function(){
    $(".menu-item").css('opacity','1');
});
// END: navigation effect

// theme selector
var themeToggleIcon = document.getElementById('theme-toggle-icon');
var themeToggleBtn = document.getElementById('theme-toggle');
if (window.location.pathname == "/") {
    var indexBannerMask = document.getElementById('index-banner-mask');
}

getTheme();

themeToggleBtn.addEventListener('click', function() {
    if (localStorage.getItem('color-theme') === 'light') {
        setTheme('dark');
        localStorage.setItem('color-theme', 'dark');
    } else if (localStorage.getItem('color-theme') === 'dark') {
        setTheme('device');
        localStorage.setItem('color-theme', 'device');
    } else if (localStorage.getItem('color-theme') === 'device') {
        setTheme('light');
        localStorage.setItem('color-theme', 'light');
    }
});

function getTheme() {
    if ('color-theme' in localStorage) {
        switch (localStorage.getItem('color-theme')) {
            case 'dark':
                setTheme('dark');
                break;
            case 'light':
                setTheme('light');
                break;
            case 'device':
                setTheme('device');
                break;
        }
    } else {
        localStorage.setItem('color-theme', 'device');
        setTheme('device');
    }
}

function setTheme(mode) {
    switch (mode) {
        case 'dark':
            themeToggleIcon.classList = '';
            themeToggleIcon.classList.add('icon-moon');
            if (!document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.add('dark');
                if (window.location.pathname == "/") {
                    indexBannerMask.classList.add('dark');
                }
            }
            break;
        case 'light':
            themeToggleIcon.classList = '';
            themeToggleIcon.classList.add('icon-sun');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                if (window.location.pathname == "/") {
                    indexBannerMask.classList.remove('dark');
                }
            }
            break;
        case 'device':
            themeToggleIcon.classList = '';
            themeToggleIcon.classList.add('icon-dark-light');
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                if (!document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.add('dark');
                    if (window.location.pathname == "/") {
                        indexBannerMask.classList.add('dark');
                    }
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    if (window.location.pathname == "/") {
                        indexBannerMask.classList.remove('dark');
                    }
                }
            }
            break;
    }
}
// END: theme selector

// Back to top button
// Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
// END: Back to top button
