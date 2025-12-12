/**
 * Contact Form UI Handler
 * Handles view switching between form and success message
 */
document.addEventListener("DOMContentLoaded", () => {
  const rightBlock = document.getElementById("contacts-right-block");
  if (!rightBlock) return;

  const formView = rightBlock.querySelector(".js-form-view");
  const successView = rightBlock.querySelector(".js-success-view");

  const RESET_DELAY = 5000;

  document.addEventListener("reintegrationFormSubmitted", ({ detail }) => {
    const { form, data } = detail;

    // Check if form belongs to this block
    if (!formView.contains(form)) return;

    if (data.success) {
      // Clear form
      form.reset();

      // Switch views
      if (formView && successView) {
        formView.style.display = "none";
        successView.style.display = "block";

        // Reset after delay
        setTimeout(() => {
          successView.style.display = "none";
          formView.style.display = "block";

          // Restore button state
          const btn = form.querySelector('button[type="submit"]');
          if (btn) {
            btn.disabled = false;
            btn.value = btn.getAttribute("data-original-text") || "Надіслати";
            if (btn.tagName === "BUTTON") {
              btn.innerHTML = "Надіслати";
            }
          }
        }, RESET_DELAY);
      }
    } else {
      console.log("Form submission failed: ", data);
    }
  });
});
