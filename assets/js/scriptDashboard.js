// buat buka tutup aside
document.getElementById('toggle-aside').addEventListener('click', function() {
    const aside = document.querySelector('aside');
    const article = document.querySelector('article');
    const toggleIcon = document.getElementById('toggle-aside');
    aside.classList.toggle('hidden');
    if (aside.classList.contains('hidden')) {
        article.classList.add('expanded');
        article.classList.remove('contracted');
        toggleIcon.classList.remove('bi-x');
        toggleIcon.classList.add('bi-list');
    } else {
        article.classList.add('contracted');
        article.classList.remove('expanded');
        toggleIcon.classList.remove('bi-list');
        toggleIcon.classList.add('bi-x');
    }
});

// function updateJudul(newText) {
//     $('#section-title').text(newText);
// }

// $('.menu-link').click(function(event) {
//     event.preventDefault();
//     $('.menu-link').removeClass('active');
//     $(this).addClass('active');
//     const newText = $(this).find('span').text();
//     updateJudul(newText);
// });

document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".menu-link");

    menuItems.forEach(item => {
        item.addEventListener("click", function() {
            // Remove active class from all menu links
            menuItems.forEach(link => link.classList.remove("active"));

            // Add active class to the clicked menu link
            this.classList.add("active");
        });
    });

    // Optionally: Set active class based on current URL
    const currentUrl = window.location.href;
    menuItems.forEach(item => {
        if (item.href === currentUrl) {
            item.classList.add("active");
        }
    });
});
