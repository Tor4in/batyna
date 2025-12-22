import { clickOn } from "../events/click";
import { load } from "../events/load";

const initTabs = () => {
    clickOn(".js-tab-trigger", async (event) => {
        event.preventDefault();
        
        // Because of 'pointer-events: none' in SCSS, event.target is guaranteed to be the button
        const trigger = event.target; 
        
        // 1. Check if already active
        if (trigger.classList.contains("is-active")) return;
        
        const container = trigger.closest(".doctor-tabs");
        const contentArea = container.querySelector("#doctor-tabs-content");

        // 2. Prevent double clicking while loading
        if (contentArea.classList.contains("is-loading")) return;

        // 3. Visual Switch
        const navItems = container.querySelectorAll(".js-tab-trigger");
        navItems.forEach(el => el.classList.remove("is-active"));
        trigger.classList.add("is-active");

        // 4. Set Loading State
        contentArea.classList.add("is-loading");

        // 5. Data
        const postId = trigger.dataset.id;
        const index = trigger.dataset.index;
        const formData = new FormData();
        formData.append("action", "load_doctor_tab");
        formData.append("post_id", postId);
        formData.append("index", index);

        try {
            // @ts-ignore
            const ajaxUrl = window.params?.ajax_url || '/wp-admin/admin-ajax.php';
            
            const response = await fetch(ajaxUrl, {
                method: "POST",
                body: formData,
            });

            if (!response.ok) throw new Error("Network error");

            const data = await response.json();

            if (data.success) {
                // Immediate update, no timeout
                contentArea.innerHTML = data.data.html;
            } else {
                console.error(data.data.message);
                contentArea.innerHTML = `<p class="error-msg">Помилка завантаження</p>`;
            }
        } catch (error) {
            console.error(error);
            contentArea.innerHTML = `<p class="error-msg">Помилка з'єднання</p>`;
        } finally {
            contentArea.classList.remove("is-loading");
        }
    });
};

// Use your custom load utility
load(initTabs);