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
