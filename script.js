const menuToggle = document.querySelector(".menu-toggle");
const siteNav = document.querySelector(".site-nav");

if (menuToggle && siteNav) {
  menuToggle.addEventListener("click", () => {
    const isOpen = siteNav.classList.toggle("is-open");
    menuToggle.setAttribute("aria-expanded", String(isOpen));
    document.body.classList.toggle("menu-open", isOpen);
  });

  siteNav.addEventListener("click", (event) => {
    if (event.target instanceof HTMLAnchorElement) {
      siteNav.classList.remove("is-open");
      menuToggle.setAttribute("aria-expanded", "false");
      document.body.classList.remove("menu-open");
    }
  });
}

const footerLinks = [
  ["Impressum", "/impressum.html"],
  ["Datenschutz", "/datenschutz.html"],
  ["Kontakt", "/#kontakt"],
  ["Instagram", "https://www.instagram.com/slico.3d/"],
  ["eBay Shop", "https://www.ebay.de/usr/slico3d"],
];

const footerNav = document.querySelector(".site-footer nav");
if (footerNav) {
  footerNav.innerHTML = footerLinks
    .map(([label, href]) => `<a href="${href}">${label}</a>`)
    .join("");
}

document.querySelectorAll('a[href="https://www.instagram.com/slico3d/"]').forEach((link) => {
  link.setAttribute("href", "https://www.instagram.com/slico.3d/");
});

document.querySelectorAll('img[src$="assets/branding/Logotyp.png"]').forEach((logo) => {
  logo.setAttribute("src", logo.getAttribute("src").replace("Logotyp.png", "Logotyp.svg"));
  logo.style.background = "transparent";
});

document.querySelectorAll(".product-card").forEach((card) => {
  const title = card.querySelector("h3");
  const link = card.querySelector(".text-link");

  if (title?.textContent.trim() === "WAGO Halter" && link) {
    link.setAttribute("href", "/products/wago-221-413-halter.html");
    link.textContent = "Produktseite ansehen";
  }
});
