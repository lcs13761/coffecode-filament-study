let sidebarScrollTop = 0;

function getSidebar() {
    return document.querySelector('.fi-sidebar-nav');
}

// Load saved scroll position on page load
document.addEventListener('DOMContentLoaded', () => {
    const savedScrollTop = localStorage.getItem('sidebar-scroll-position');
    if (savedScrollTop) {
        sidebarScrollTop = parseInt(savedScrollTop, 10);
        restoreScrollPosition();
    }
});

// Save scroll position before navigating
document.addEventListener('click', (e) => {
    const item = e.target.closest('.fi-sidebar-item');
    const sidebar = getSidebar();

    if (item && sidebar) {
        sidebarScrollTop = sidebar.scrollTop;
        localStorage.setItem('sidebar-scroll-position', sidebarScrollTop);
    }
});

// Save scroll position before page unload (reload/close)
window.addEventListener('beforeunload', () => {
    const sidebar = getSidebar();
    if (sidebar) {
        localStorage.setItem('sidebar-scroll-position', sidebar.scrollTop);
    }
});

// Restore scroll position after navigation
document.addEventListener('livewire:navigated', () => {
    restoreScrollPosition();
});

function restoreScrollPosition() {
    const tryRestoreScroll = () => {
        const sidebar = getSidebar();
        if (sidebar && sidebar.scrollTop !== sidebarScrollTop) {
            sidebar.scrollTo({top: sidebarScrollTop, behavior: 'auto'});
            requestAnimationFrame(tryRestoreScroll);
        }
    };

    requestAnimationFrame(tryRestoreScroll);
}
