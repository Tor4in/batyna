import { clickOn } from "../events/click";

/**
 * Handle AJAX Load More and Collapse for Blog Archive
 */
const initBlogLoadMore = () => {
    
    clickOn('.js-load-more-blog', async (event) => {
        event.preventDefault();
        event.stopPropagation();

        const button = event.target.closest('.js-load-more-blog');
        if (!button || button.classList.contains('loading')) return;

        const grid = document.querySelector('.js-blog-grid');
        const textElement = button.querySelector('.btn__text');
        
        const currentPage = parseInt(button.getAttribute('data-paged')) || 1;
        const maxPages = parseInt(button.getAttribute('data-max')) || 1;
        const nonce = button.getAttribute('data-nonce');
        
        const textLoad = button.getAttribute('data-text-load');
        const textCollapse = button.getAttribute('data-text-collapse');

        // Collapse/Expand mode (all content loaded)
        if (button.classList.contains('is-all-loaded')) {
            const ajaxItems = grid.querySelectorAll('.js-ajax-item');
            
            if (button.classList.contains('is-collapsed')) {
                // Expand
                ajaxItems.forEach(item => item.style.display = '');
                textElement.innerText = textCollapse;
                button.classList.remove('is-collapsed');
            } else {
                // Collapse
                ajaxItems.forEach(item => item.style.display = 'none');
                textElement.innerText = textLoad;
                button.classList.add('is-collapsed');
                
                grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            return;
        }

        // AJAX loading mode
        button.classList.add('loading');
        textElement.innerText = 'Завантаження...';

        const nextPage = currentPage + 1;
        const formData = new FormData();
        formData.append('action', 'load_blog_posts');
        formData.append('nonce', nonce);
        formData.append('paged', nextPage);

        try {
            const response = await fetch(params.ajax_url, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success && data.data.html) {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.data.html;
                
                const items = tempDiv.children;
                while (items.length > 0) {
                    items[0].classList.add('js-ajax-item');
                    grid.appendChild(items[0]);
                }

                button.setAttribute('data-paged', nextPage);

                // Check if all pages loaded
                if (nextPage >= maxPages) {
                    button.classList.add('is-all-loaded');
                    textElement.innerText = textCollapse;
                } else {
                    textElement.innerText = textLoad;
                }
            }
        } catch (error) {
            console.error('AJAX Load error:', error);
            textElement.innerText = textLoad;
        } finally {
            button.classList.remove('loading');
        }
    });
};

document.addEventListener('DOMContentLoaded', initBlogLoadMore);
