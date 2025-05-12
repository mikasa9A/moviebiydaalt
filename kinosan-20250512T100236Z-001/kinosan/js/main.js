// Mobile navigation toggle
document.getElementById('menuToggle').addEventListener('click', function() {
  const navList = document.querySelector('nav ul');
  navList.classList.toggle('active');
});

// Auto-scroll for the news slider (if present)
const slider = document.querySelector('.slider');
if (slider) {
  let scrollAmount = 0;
  function autoScroll() {
    scrollAmount += 1;
    if (scrollAmount >= slider.scrollWidth - slider.clientWidth) {
      scrollAmount = 0;
    }
    slider.scrollTo({ left: scrollAmount, behavior: 'smooth' });
  }
  setInterval(autoScroll, 50);
}

// Search form handling (demo functionality)
const searchForm = document.getElementById('searchForm');
if (searchForm) {
  searchForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const query = searchForm.query.value.trim();
    if (query) {
      // In a full implementation, you might perform a search or redirect.
      alert('Хайлт: ' + query);
    }
  });
}
