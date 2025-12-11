import { load } from '../events/load.js'; // перевір шлях
import { clickOn } from '../events/click.js'; // перевір шлях
load(() => {
    // FAQ Accordion Logic
    clickOn('.js-faq-trigger', (event) => {
        const header = event.target.closest('.js-faq-trigger');
        const item = header.closest('.js-faq-item');
        const content = item.querySelector('.accordeon');

        // Toggle current
        if (content.hasAttribute('open')) {
            content.removeAttribute('open');
            item.classList.remove('is-active');
        } else {
            // Optional: Close others (uncomment if needed)
            // document.querySelectorAll('.js-faq-item').forEach(el => {
            //     el.classList.remove('is-active');
            //     el.querySelector('.accordeon')?.removeAttribute('open');
            // });

            content.setAttribute('open', '');
            item.classList.add('is-active');
        }
    });
});