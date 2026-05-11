        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Enhanced sidebar toggle functionality with smooth animations
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    // Restore previous sidebar state
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        document.body.classList.add('sidebar-collapsed');
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault();
            document.body.classList.toggle('sidebar-collapsed');
            localStorage.setItem(
                'sidebarCollapsed',
                document.body.classList.contains('sidebar-collapsed')
            );
        });
    }

    // Close sidebar when clicking navigation links on mobile
    if (window.innerWidth < 992) {
        const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (!link.getAttribute('href').includes('logout')) {
                    document.body.classList.add('sidebar-collapsed');
                    localStorage.setItem('sidebarCollapsed', 'true');
                }
            });
        });
    }

    // Reset sidebar on window resize
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            if (window.innerWidth >= 992) {
                document.body.classList.remove('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        }, 250);
    });
</script>
<script>
function toggleReportsMenu(event) {
    event.preventDefault();

    const submenu = document.getElementById('reportsSubmenu');
    const arrow = document.getElementById('reportsArrow');

    if (submenu) submenu.classList.toggle('show');
    if (arrow) arrow.classList.toggle('rotate');
}
</script>
</body>
</html>