const sidebar = document.querySelector('[data-sidebar]');
const sidebarOverlay = document.querySelector('[data-sidebar-overlay]');
const openSidebarButton = document.querySelector('[data-sidebar-open]');
const closeSidebarButton = document.querySelector('[data-sidebar-close]');

const setSidebarVisibility = (isOpen) => {
    if (!sidebar || !sidebarOverlay) {
        return;
    }

    sidebar.classList.toggle('-translate-x-full', !isOpen);
    sidebarOverlay.classList.toggle('hidden', !isOpen);
    document.body.classList.toggle('overflow-hidden', isOpen && window.innerWidth < 1024);
    openSidebarButton?.setAttribute('aria-expanded', String(isOpen));
};

openSidebarButton?.addEventListener('click', () => setSidebarVisibility(true));
closeSidebarButton?.addEventListener('click', () => setSidebarVisibility(false));
sidebarOverlay?.addEventListener('click', () => setSidebarVisibility(false));

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        setSidebarVisibility(false);
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        setSidebarVisibility(false);
    }
});

document.querySelectorAll('[data-demo-form]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const message = form.querySelector('[data-form-message]');
        if (message) {
            message.classList.remove('hidden');
        }
    });
});

document.querySelectorAll('[data-tabs]').forEach((tabGroup) => {
    const buttons = tabGroup.querySelectorAll('[data-tab]');

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            buttons.forEach((item) => {
                const active = item === button;
                item.classList.toggle('bg-prevanta-600', active);
                item.classList.toggle('text-white', active);
                item.classList.toggle('bg-white', !active);
                item.classList.toggle('text-ink-500', !active);
            });
        });
    });
});
