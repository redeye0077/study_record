document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("menuBtn");
  const menu = document.getElementById("mobileMenu");
  const header = document.getElementById("header");

  if (btn && menu) {
    btn.addEventListener("click", () => {
      const expanded = btn.getAttribute("aria-expanded") === "true";
      btn.setAttribute("aria-expanded", String(!expanded));
      menu.classList.toggle("hidden");

      // ハンバーガーとバツ印の切替
      btn.textContent = expanded ? "☰" : "✕";

      if (menu.classList.contains("hidden")) {
        header.classList.remove("no-border"); // 線を戻す
      } else {
        header.classList.add("no-border");    // 線を消す
      }
    });
  }
});
