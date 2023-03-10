document.addEventListener(
  "DOMContentLoaded",
  function () {
    const hamburger = document.querySelector(".hamburger");
    const hamburger__open = document.querySelector(".hamburger__open");

    hamburger.addEventListener("click", () => {
      hamburger__open.classList.toggle("active");
      hamburger.classList.toggle("active");
    });

    // ----------------------アコーディオン-----------------------

    const acc_ttl = Array.from(document.querySelectorAll(".accordion__ttl"));

    for (let i = 0; i < acc_ttl.length; i++) {
      let ttl = acc_ttl[i];
      let content = ttl.nextElementSibling;
      ttl.addEventListener("click", () => {
        ttl.classList.toggle("is-active");
        if (content.style.height) {
          content.style.height = null;
        } else {
          content.style.height = content.scrollHeight + "px";
        }
      });
    }
  },
  false
);
