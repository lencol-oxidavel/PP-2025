document.addEventListener('DOMContentLoaded', () => {
  const logoutLink = document.getElementById('logoutLink');

  if (logoutLink) {
    logoutLink.addEventListener('click', (e) => {
      e.preventDefault();

      if (confirm('Deseja realmente fazer logout?')) {
        window.location.href = './action/logout.php';
      }
    });
  }
});
