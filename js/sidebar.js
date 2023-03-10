document.addEventListener(
  "DOMContentLoaded",
  function () {
    const sidebarItem = document.querySelectorAll(".sidebar__item");
    const hoverList1 = document.getElementById("hover-list1");
    const hoverList2 = document.getElementById("hover-list2");

    sidebarItem[5].addEventListener("mouseover", () => {
      hoverList1.style.display = "block";
    });
    hoverList1.addEventListener("mouseover", () => {
      hoverList1.style.display = "block";
    });
    sidebarItem[5].addEventListener("mouseleave", () => {
      hoverList1.style.display = "none";
    });
    hoverList1.addEventListener("mouseleave", () => {
      hoverList1.style.display = "none";
    });
    // ------------------------------
    sidebarItem[6].addEventListener("mouseover", () => {
      hoverList2.style.display = "block";
    });
    hoverList2.addEventListener("mouseover", () => {
      hoverList2.style.display = "block";
    });
    sidebarItem[6].addEventListener("mouseleave", () => {
      hoverList2.style.display = "none";
    });
    hoverList2.addEventListener("mouseleave", () => {
      hoverList2.style.display = "none";
    });
  },
  false
);

document.addEventListener(
  "DOMContentLoaded",
  function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");
    const main = document.getElementById("main");
    sidebarToggle.addEventListener("click", () => {
      sidebarToggle.classList.toggle("sidebar__togglebtn");
      main.classList.toggle("main__toggle");
      sidebar.classList.toggle("sidebar__toggle");
    });
  },
  false
);
