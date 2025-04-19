  function showPage(pageId) {
    event.preventDefault(); // Mencegah perilaku default tautan
    // Sembunyikan semua halaman
    const pages = document.querySelectorAll('.page');
    pages.forEach(page => {
      page.style.display = 'none';
    });

    // Tampilkan halaman yang dipilih
    const activePage = document.getElementById(pageId);
    if (activePage) {
      activePage.style.display = 'block';
    }

    // Optional: Tandai menu aktif
    const links = document.querySelectorAll('.menu');
    links.forEach(link => link.classList.remove('active'));
    // links.forEach(link => {
    //   link.classList.remove('active');
    // });
    event.target.classList.add('active');
}
