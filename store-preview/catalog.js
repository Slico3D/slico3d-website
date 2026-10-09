/* SLICO3D Store Preview - public WooCommerce Store API catalog.
   No API keys. No checkout. Only published catalog items are exposed by Store API. */
(() => {
  const root = document.getElementById("woo-products");
  const status = document.getElementById("woo-status");
  if (!root || !status) return;
  const endpoint = "/shop/wp-json/wc/store/v1/products?per_page=24";
  const text = (v) => String(v ?? "");
  function el(tag, className, value) {
    const node = document.createElement(tag);
    if (className) node.className = className;
    if (value !== undefined) node.textContent = text(value);
    return node;
  }
  function price(product) {
    const p = product.prices;
    if (!p || !/^\\d+$/.test(text(p.price))) return "Preis auf Anfrage";
    const minor = Number.isInteger(p.currency_minor_unit) ? p.currency_minor_unit : 2;
    const amount = Number(p.price) / (10 ** minor);
    if (!Number.isFinite(amount)) return "Preis auf Anfrage";
    try {
      return new Intl.NumberFormat("de-DE", { style:"currency", currency: p.currency_code || "EUR" }).format(amount);
    } catch { return amount.toFixed(2) + " €"; }
  }
  function render(product) {
    const card = el("article", "card");
    const visual = el("div", "illustration woo-visual");
    const photo = product.images?.[0];
    if (photo?.src && /^https:\/\//.test(photo.src)) {
      const img = document.createElement("img");
      img.src = photo.src;
      img.alt = text(photo.alt || product.name);
      img.loading = "lazy";
      img.decoding = "async";
      visual.append(img);
    } else visual.append(el("div", "model"));
    const body = el("div", "body");
    const category = product.categories?.[0]?.name || "SLICO3D";
    body.append(el("span", "tag", category), el("h3", "", product.name || "Produkt"));
    const description = el("p", "", "Weitere Informationen und Varianten folgen.");
    if (product.short_description) {
      const tmp = document.createElement("div");
      tmp.innerHTML = product.short_description;
      description.textContent = (tmp.textContent || "").trim().slice(0, 200);
    }
    body.append(description, el("strong", "woo-price", price(product)));
    const note = el("span", "disabled", "Bestellung noch nicht verfügbar");
    body.append(note);
    card.append(visual, body);
    return card;
  }
  const controller = new AbortController();
  const timeout = setTimeout(() => controller.abort(), 10000);
  fetch(endpoint, {signal: controller.signal, credentials:"omit", headers:{Accept:"application/json"}})
    .then(async response => {
      if (!response.ok) throw new Error("Store API HTTP " + response.status);
      return response.json();
    })
    .then(products => {
      if (!Array.isArray(products)) throw new Error("Unexpected catalog data");
      if (!products.length) {
        status.textContent = "Noch keine veröffentlichten Produkte im Katalog. Das Sortiment wird vorbereitet.";
        return;
      }
      const fragment = document.createDocumentFragment();
      products.filter(p => p && typeof p === "object").forEach(p => fragment.append(render(p)));
      root.replaceChildren(fragment);
      status.textContent = products.length + " Produkte aus WooCommerce geladen · Verkauf im Vorschau-Modus deaktiviert.";
    })
    .catch(() => {
      status.textContent = "Der Produktkatalog ist momentan nicht erreichbar. Bitte später erneut versuchen.";
    })
    .finally(() => clearTimeout(timeout));
})();
