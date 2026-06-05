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
  const visual = card.querySelector(".product-visual.wago");

  if (title?.textContent.trim() === "WAGO Halter") {
    if (link) {
      link.setAttribute("href", "/products/wago-krasnal/");
      link.textContent = "Produktseite ansehen";
    }

    if (visual && !visual.querySelector("img")) {
      visual.innerHTML = '<img src="/assets/products/wago-krasnal/hero-with-wago/orange.jpg" alt="Oranger WAGO 221-413 Halter mit eingesetzter Klemme">';
      visual.style.display = "grid";
      visual.style.placeItems = "center";
    }
  }
});
