// 編集ページのみ適応のjs
document.addEventListener(
  "DOMContentLoaded",
  function () {
    const inputAll = document.querySelectorAll("input");
    Array.from(inputAll).map((input) => {
      input.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
          event.preventDefault();
        }
      });
    });
  },
  false
);