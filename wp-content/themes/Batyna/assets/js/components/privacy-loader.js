import { load } from "../events/load";

const initPrivacyLoad = () => {
  document.addEventListener("click", async (event) => {
    const button = event.target.closest(".js-privacy-load");
    if (!button) return;

    event.preventDefault();

    if (button.classList.contains("is-loading")) return;

    const contentContainer = document.getElementById("privacy-content");
    if (!contentContainer) {
      console.error("Content container #privacy-content not found");
      return;
    }

    button.classList.add("is-loading");
    contentContainer.classList.add("is-loading");

    const textSpan = button.querySelector(".btn-privacy-load__text");
    const originalText = textSpan ? textSpan.innerText : "";
    if (textSpan) textSpan.innerText = "Завантаження...";

    const postId = button.dataset.id;
    const formData = new FormData();
    formData.append("action", "load_privacy_policy");
    formData.append("post_id", postId);

    try {
      // @ts-ignore
      let ajaxUrl = window.params?.ajax_url || "/wp-admin/admin-ajax.php";

      const response = await fetch(ajaxUrl, {
        method: "POST",
        body: formData,
      });

      if (!response.ok) throw new Error(`Network error: ${response.status}`);

      const data = await response.json();

      if (data.success) {
        contentContainer.innerHTML = data.data.html;
        button.remove();
        contentContainer.classList.remove("is-loading");
      } else {
        throw new Error(data.data?.message || "Unknown server error");
      }
    } catch (error) {
      console.error("AJAX Error:", error);
      if (textSpan) textSpan.innerText = originalText || "Помилка";
      button.classList.remove("is-loading");
      contentContainer.classList.remove("is-loading");
    }
  });
};

load(initPrivacyLoad);