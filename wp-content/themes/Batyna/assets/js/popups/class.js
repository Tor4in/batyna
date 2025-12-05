function getProp(element, property, default_value = "") {
  return getComputedStyle(element).getPropertyValue(property) || default_value;
}

export class Popup {
  constructor(selector = "", settings = {}) {
    if (!selector) return;
    this.selector = selector;
    this.element = document.querySelector(selector);

    if (this.element) {
      const closeButtonSelector = settings.closeButton || ".close-button";
      this.closeButton = this.element.querySelector(closeButtonSelector);
    } else {
      return console.error("Popup not found:", selector);
    }

    this.canAction = true;

    // Button Selectors
    this.openButtonsSelector = settings.openButtons || "";
    this.toggleButtonsSelector = settings.toggleButtons || "";

    this.openButtons = [];
    this.toggleButtons = [];

    this.closeOnResize = settings.closeOnResize || false;
    this.on = settings.on || {};
    this.resizeTimer = null;
    this.animations = {};

    this.init();
  }

  init() {
    // 1. Close Button (inside popup)
    if (this.closeButton) {
      this.closeButton.addEventListener("click", this.close.bind(this));
    }

    // 2. Close on Backdrop Click
    this.element.addEventListener("click", (e) => {
      if (e.target == this.element) {
        this.close();
      }
    });

    // 3. Open Buttons
    if (this.openButtonsSelector) {
      this.openButtons = Array.from(
        document.querySelectorAll(this.openButtonsSelector)
      );
      this.openButtons.forEach((button) => {
        button.addEventListener("click", this.open.bind(this));
      });
    }

    // 4. Toggle Buttons
    if (this.toggleButtonsSelector) {
      this.toggleButtons = Array.from(
        document.querySelectorAll(this.toggleButtonsSelector)
      );
      this.toggleButtons.forEach((button) => {
        button.addEventListener("click", this.toggle.bind(this));
      });
    }

    // 5. Close on Resize
    if (this.closeOnResize) {
      window.addEventListener("resize", () => {
        if (!this.element.hasAttribute("open")) return;
        clearTimeout(this.resizeTimer);
        this.resizeTimer = setTimeout(() => {
          this.close();
        }, 200);
      });
    }

    // Parse Animation Durations from CSS variables
    let openDuration = getProp(this.element, "--_open", 600);
    if (typeof openDuration === "string") {
      if (openDuration.endsWith("ms")) {
        openDuration = parseFloat(openDuration.slice(0, -2));
      } else if (openDuration.endsWith("s")) {
        openDuration = parseFloat(openDuration.slice(0, -1)) * 1000;
      } else {
        openDuration = 500;
      }
    }
    this.animations.open = openDuration;

    let closeDuration = getProp(this.element, "--_close", 600);
    if (typeof closeDuration === "string") {
      if (closeDuration.endsWith("ms")) {
        closeDuration = parseFloat(closeDuration.slice(0, -2));
      } else if (closeDuration.endsWith("s")) {
        closeDuration = parseFloat(closeDuration.slice(0, -1)) * 1000;
      }
    }
    this.animations.close = closeDuration;

    // Trigger Init Callback
    if (typeof this.on.init === "function") {
      this.on.init.call(this);
    }
  }

  open() {
    if (!this.canAction) return;
    if (this.element.hasAttribute("open")) return;

    this.canAction = false;
    this.element.removeAttribute("close");
    this.element.setAttribute("open", "");

    setTimeout(() => {
      this.canAction = true;
    }, this.animations.open);

    if (typeof this.on.open === "function") {
      this.on.open.call(this);
    }
  }

  close() {
    if (!this.canAction) return;
    if (!this.element.hasAttribute("open")) return;

    this.canAction = false;
    this.element.setAttribute("close", "");
    this.element.removeAttribute("open");

    setTimeout(() => {
      this.canAction = true;
    }, this.animations.close || this.animations.open);

    if (typeof this.on.close === "function") {
      this.on.close.call(this);
    }
  }

  toggle() {
    if (!this.canAction) return;

    this.element.hasAttribute("open") ? this.close() : this.open();

    if (typeof this.on.toggle === "function") {
      this.on.toggle.call(this);
    }
  }
}
