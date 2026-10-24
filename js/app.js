(() => {
  "use strict";

  /* ================= Icons ================= */
  const svg = (body, opts = "") =>
    `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" ${opts}>${body}</svg>`;
  const solid = (body) => `<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">${body}</svg>`;

  const ICONS = {
    search: svg('<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>'),
    phone: svg('<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/>'),
    cart: svg('<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/>'),
    heart: svg('<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1 1.1L12 21l7.8-7.5 1-1.1a5.5 5.5 0 0 0 0-7.8z"/>'),
    eye: svg('<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'),
    menu: svg('<path d="M3 6h18M3 12h18M3 18h18"/>'),
    close: svg('<path d="M18 6 6 18M6 6l12 12"/>'),
    grid: svg('<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>'),
    "chevron-down": svg('<path d="m6 9 6 6 6-6"/>'),
    "chevron-left": svg('<path d="m15 18-6-6 6-6"/>', 'stroke-width="3"'),
    "chevron-right": svg('<path d="m9 18 6-6-6-6"/>', 'stroke-width="3"'),
    "arrow-up": svg('<path d="M12 19V5M5 12l7-7 7 7"/>'),
    home: svg('<path d="m3 10 9-7 9 7v10a2 2 0 0 1-2 2h-4v-7H9v7H5a2 2 0 0 1-2-2z"/>'),
    bag: svg('<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/>'),
    truck: svg('<path d="M1 3h15v13H1zM16 8h4l3 3v5h-7z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>'),
    shield: svg('<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>'),
    return: svg('<path d="M9 14 4 9l5-5"/><path d="M4 9h11a5 5 0 0 1 0 10h-3"/>'),
    tag: svg('<path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="7" cy="7" r="1.5"/>'),
    badge: svg('<circle cx="12" cy="8" r="6"/><path d="M15.5 13.5 17 22l-5-3-5 3 1.5-8.5"/>'),
    check: svg('<path d="M22 11.1V12a10 10 0 1 1-5.9-9.1"/><path d="M22 4 12 14l-3-3"/>'),
    "check-big": svg('<path d="M20 6 9 17l-5-5"/>', 'stroke-width="3"'),
    trash: svg('<path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>'),
    chat: svg('<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>'),
    plus: svg('<path d="M12 5v14M5 12h14"/>'),
    cod: svg('<rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/>'),
    star: solid('<path d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>'),
    facebook: solid('<path d="M14 13.5h2.5l1-4H14v-2c0-1 .5-2 2-2h1.5V2.1A20 20 0 0 0 14.8 2C12.1 2 10 3.7 10 6.7v2.8H7v4h3V22h4z"/>'),
    twitter: solid('<path d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.3-8.3L2 3h6.4l4.4 5.8zm-1.1 16.2h1.7L7.4 4.7H5.6z"/>'),
    instagram: svg('<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>'),
    youtube: solid('<path d="M23 7.2a3 3 0 0 0-2.1-2.1C19 4.6 12 4.6 12 4.6s-7 0-8.9.5A3 3 0 0 0 1 7.2 31 31 0 0 0 .5 12 31 31 0 0 0 1 16.8a3 3 0 0 0 2.1 2.1c1.9.5 8.9.5 8.9.5s7 0 8.9-.5a3 3 0 0 0 2.1-2.1 31 31 0 0 0 .5-4.8 31 31 0 0 0-.5-4.8zM9.8 15V9l5.7 3z"/>'),
    whatsapp: solid('<path d="M17.5 14.4c-.3-.1-1.8-.9-2-1s-.5-.1-.7.1-.8 1-.9 1.2-.3.2-.6.1a8 8 0 0 1-2.4-1.5 9 9 0 0 1-1.6-2c-.2-.3 0-.5.1-.6l.4-.5.3-.5v-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6a1.1 1.1 0 0 0-.8.4 3.4 3.4 0 0 0-1 2.5 5.9 5.9 0 0 0 1.2 3.1 13.5 13.5 0 0 0 5.2 4.6c3 1.2 3 .8 3.6.7a3 3 0 0 0 2-1.4 2.4 2.4 0 0 0 .2-1.4c-.1-.1-.3-.2-.6-.3zM12 21.8a9.9 9.9 0 0 1-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4a9.8 9.8 0 1 1 8.3 4.6zm0-21.6A11.8 11.8 0 0 0 1.8 17.9L.1 24l6.3-1.6A11.8 11.8 0 1 0 12 .2z"/>'),
    messenger: solid('<path d="M12 2C6.4 2 2 6.1 2 11.7c0 2.9 1.2 5.5 3.1 7.2.2.2.3.4.3.6l.1 1.8c0 .6.6 1 1.2.7l2-.9c.2-.1.4-.1.6 0 .9.2 1.8.4 2.7.4 5.6 0 10-4.1 10-9.7S17.6 2 12 2zm6 7.5-2.9 4.6c-.5.7-1.4.9-2.1.4l-2.3-1.7a.6.6 0 0 0-.7 0l-3.1 2.4c-.4.3-1-.2-.7-.6L9 10c.5-.7 1.4-.9 2.1-.4l2.3 1.7c.2.2.5.2.7 0l3.1-2.4c.4-.3 1 .2.8.6z"/>'),
    sofa: svg('<path d="M20 9V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v2"/><path d="M2 11a2 2 0 0 1 4 0v2h12v-2a2 2 0 0 1 4 0v6H2zM4 17v2M20 17v2"/>'),
    plug: svg('<path d="M12 22v-5M9 8V2M15 8V2M18 8v5a6 6 0 0 1-12 0V8z"/>'),
    sparkle: svg('<path d="M12 3v4M12 17v4M3 12h4M17 12h4M5.6 5.6l2.8 2.8M15.6 15.6l2.8 2.8M5.6 18.4l2.8-2.8M15.6 8.4l2.8-2.8"/>'),
    watch: svg('<circle cx="12" cy="12" r="6"/><path d="M12 10v2l1 1M16.5 7.5 16 2H8l-.5 5.5M7.5 16.5 8 22h8l.5-5.5"/>'),
    wrench: svg('<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.8-3.8a6 6 0 0 1-7.9 7.9l-6.9 6.9a2.1 2.1 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.9-7.9z"/>'),
    food: svg('<path d="M3 11h18a9 9 0 0 1-18 0zM12 2v4M8 3v3M16 3v3"/>'),
    kitchen: svg('<path d="M3 2v7a3 3 0 0 0 6 0V2M6 2v20M21 15V2a5 5 0 0 0-5 5v6a2 2 0 0 0 2 2h3zm0 0v7"/>'),
    shirt: svg('<path d="M20.4 6.6 16 3a4 4 0 0 1-8 0L3.6 6.6a1 1 0 0 0-.3 1.2l1.5 3a1 1 0 0 0 1.2.5L8 10.6V21h8V10.6l2 .7a1 1 0 0 0 1.2-.5l1.5-3a1 1 0 0 0-.3-1.2z"/>'),
    dress: svg('<path d="M9 2v4l-1 3 -4 13h16L16 9l-1-3V2M9 6h6"/>'),
    kid: svg('<circle cx="12" cy="6" r="3"/><path d="M12 9v7M8 12h8M12 16l-3 6M12 16l3 6"/>'),
    all: svg('<path d="M4 6h16M4 12h16M4 18h10"/>'),
    pin: svg('<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>'),
    mail: svg('<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/>'),
    clock: svg('<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>'),
    send: svg('<path d="m22 2-7 20-4-9-9-4z"/><path d="M22 2 11 13"/>'),
    users: svg('<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/>'),
    leaf: svg('<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.5 19 2c1 2 2 4.2 2 8 0 5.5-4.8 10-10 10z"/><path d="M2 21c0-3 1.9-5.4 5.1-6"/>'),
    "arrow-right": svg('<path d="M5 12h14M12 5l7 7-7 7"/>'),
    "arrow-left": svg('<path d="M19 12H5M12 19l-7-7 7-7"/>'),
    share: svg('<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/>'),
    box: svg('<path d="M21 8 12 3 3 8v8l9 5 9-5z"/><path d="m3 8 9 5 9-5M12 13v8"/>'),
  };

  const hydrateIcons = (root = document) => {
    root.querySelectorAll("[data-icon]").forEach((el) => {
      if (!el.firstElementChild) el.innerHTML = ICONS[el.dataset.icon] || "";
    });
  };

  /* ================= Helpers ================= */
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];
  const money = (n) => `৳${Number(n).toLocaleString("en-US")}`;
  const setHTML = (sel, html) => {
    const el = $(sel);
    if (el) el.innerHTML = html;
  };
  const isHome = () => !!$("[data-sections]");
  const goHome = (params) => {
    const qs = new URLSearchParams(params).toString();
    const base = window.BUYBARI_CATALOG ? "/" : "index.html";
    location.href = `${base}${qs ? `?${qs}` : ""}#products`;
  };
  const csrf = () => document.querySelector('meta[name="csrf-token"]')?.content || "";
  const postJSON = async (url, body) => {
    const res = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-CSRF-TOKEN": csrf(),
      },
      body: JSON.stringify(body),
    });
    const data = await res.json().catch(() => ({}));
    return { ok: res.ok, status: res.status, data };
  };
  const esc = (s) =>
    String(s).replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[c]);
  const byId = (id) => PRODUCTS.find((p) => p.id === id);
  const productUrl = (id) =>
    window.BUYBARI_CATALOG ? `/product/${encodeURIComponent(id)}` : `product.html?id=${encodeURIComponent(id)}`;
  const unitPrice = (p, extra = {}) => {
    if (!p) return 0;
    const variants = Array.isArray(p.variants) ? p.variants : [];
    if (extra.variant_sku) {
      const found = variants.find((v) => String(v.sku || "") === String(extra.variant_sku));
      if (found && Number(found.price) > 0) return Number(found.price);
    }
    if (extra.size) {
      const found = variants.find(
        (v) =>
          String(v.size || "") === String(extra.size) &&
          (!extra.color || !v.color || String(v.color) === String(extra.color))
      );
      if (found && Number(found.price) > 0) return Number(found.price);
    }
    return Number(p.price);
  };
  const sizeOptionsFor = (p) => {
    if (!p) return [];
    if (Array.isArray(p.sizeOptions) && p.sizeOptions.length) return p.sizeOptions;
    const fromVariants = [
      ...new Set((Array.isArray(p.variants) ? p.variants : []).map((v) => v.size).filter(Boolean)),
    ];
    return fromVariants;
  };
  const productNeedsSize = (p) => !!p && (p.needsSize || sizeOptionsFor(p).length > 0);
  const lineKey = (l) => `${l.id}|${l.variant_sku || ""}|${l.size || ""}|${l.color || ""}`;
  const matchVariantPick = (p, color = "", size = "") => {
    const variants = Array.isArray(p?.variants) ? p.variants : [];
    const match =
      variants.find(
        (v) =>
          (!size || String(v.size || "") === String(size)) &&
          (!color || !v.color || String(v.color) === String(color))
      ) ||
      variants.find((v) => size && String(v.size || "") === String(size)) ||
      {};
    return {
      color: match.color || color || "",
      size: match.size || size || "",
      variant_sku: match.sku || "",
      price: Number(match.price) > 0 ? Number(match.price) : Number(p?.price || 0),
    };
  };
  const optionSelectHTML = (label, name, values, required = false) =>
    values.length
      ? `<label class="pdp__option">${label}${required ? " *" : ""}<select data-variant="${name}"${
          required ? " required" : ""
        }><option value="">Choose ${label.toLowerCase()}</option>${values
          .map((v) => `<option value="${esc(v)}">${esc(v)}</option>`)
          .join("")}</select></label>`
      : "";
  const sizeColorHTML = (p) => {
    const variants = Array.isArray(p.variants) ? p.variants : [];
    const colors = [...new Set(variants.map((v) => v.color).filter(Boolean))];
    const sizes = sizeOptionsFor(p);
    if (!colors.length && !sizes.length) return "";
    return `<div class="pdp__options">${optionSelectHTML("Color", "color", colors)}${optionSelectHTML(
      "Size",
      "size",
      sizes,
      productNeedsSize(p)
    )}</div>`;
  };
  const readVariantPick = (root, p) => {
    const color = root.querySelector('[data-variant="color"]')?.value || "";
    const size = root.querySelector('[data-variant="size"]')?.value || "";
    return matchVariantPick(p, color, size);
  };
  const requireSizeOrToast = (p, pick) => {
    if (productNeedsSize(p) && !String(pick.size || "").trim()) {
      toast("Please choose a size", "close");
      return false;
    }
    return true;
  };
  const off = (p) => (p.oldPrice ? Math.round(((p.oldPrice - p.price) / p.oldPrice) * 100) : 0);
  const store = {
    get: (k, d) => {
      try { return JSON.parse(localStorage.getItem(k)) ?? d; } catch { return d; }
    },
    set: (k, v) => localStorage.setItem(k, JSON.stringify(v)),
  };
  const isMobile = () => window.matchMedia("(max-width: 768px)").matches;

  /* ================= Toast ================= */
  const toast = (msg, icon = "check-big") => {
    const el = document.createElement("div");
    el.className = "toast";
    el.innerHTML = `<span data-icon="${icon}"></span><span>${esc(msg)}</span>`;
    hydrateIcons(el);
    $("[data-toasts]").appendChild(el);
    setTimeout(() => {
      el.classList.add("is-leaving");
      el.addEventListener("animationend", () => el.remove(), { once: true });
    }, 2400);
  };

  /* ================= Panels (drawers + modal) ================= */
  const overlay = $("[data-overlay]");
  const modal = $("[data-modal]");
  let openPanel = null;

  const closePanels = () => {
    $$(".drawer.is-open").forEach((d) => d.classList.remove("is-open"));
    overlay.classList.remove("is-open");
    modal.hidden = true;
    document.body.classList.remove("is-locked");
    openPanel = null;
  };

  const openDrawer = (el) => {
    closePanels();
    el.classList.add("is-open");
    overlay.classList.add("is-open");
    document.body.classList.add("is-locked");
    openPanel = el;
  };

  const openModal = (html) => {
    closePanels();
    $("[data-modal-content]").innerHTML = html;
    hydrateIcons(modal);
    modal.hidden = false;
    document.body.classList.add("is-locked");
    openPanel = modal;
    modal.querySelector(".modal__box").scrollTop = 0;
  };

  overlay.addEventListener("click", closePanels);
  modal.addEventListener("click", (e) => {
    if (e.target === modal) closePanels();
  });
  document.addEventListener("click", (e) => {
    if (e.target.closest("[data-close]")) closePanels();
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && openPanel) closePanels();
  });

  /* ================= Categories ================= */
  const countIn = (cat) => PRODUCTS.filter((p) => p.category === cat).length;
  const catButton = (c, cls = "cat-link") =>
    `<button class="${cls}" data-category="${esc(c.name)}"><span data-icon="${c.icon}"></span><span>${esc(c.name)}</span>${
      cls === "cat-link" ? `<span class="count">${countIn(c.name) || ""}</span>` : ""
    }</button>`;

  const renderCategories = () => {
    setHTML(
      "[data-quick-cats]",
      CATEGORIES.slice(0, 6)
        .map((c) => `<li><a href="#" data-category="${esc(c.name)}">${esc(c.name)}</a></li>`)
        .join("")
    );
    const list = CATEGORIES.map((c) => `<li>${catButton(c)}</li>`).join("");
    setHTML("[data-cat-menu]", list);
    setHTML("[data-sidebar-cats]", list);
    setHTML("[data-drawer-cats]", list);
    setHTML(
      "[data-chips]",
      `<button class="chip is-active" data-category=""><span data-icon="all"></span>All Products</button>` +
        CATEGORIES.map((c) => catButton(c, "chip")).join("")
    );
  };

  const catToggle = $("[data-cat-toggle]");
  const catMenu = $("[data-cat-menu]");
  catToggle.addEventListener("click", (e) => {
    e.stopPropagation();
    const open = catMenu.classList.toggle("is-open");
    catToggle.setAttribute("aria-expanded", open);
  });
  document.addEventListener("click", (e) => {
    if (!e.target.closest(".cat-dropdown")) {
      catMenu.classList.remove("is-open");
      catToggle.setAttribute("aria-expanded", "false");
    }
  });

  /* ================= Product sections ================= */
  const state = {
    category: "",
    query: "",
    visible: {},
  };
  const PAGE = () => (isMobile() ? 6 : 8);

  const stars = (n, reviews) =>
    `<div class="stars" aria-label="${n} out of 5 stars">${ICONS.star.repeat(n)}${ICONS.star
      .replace("<svg", '<svg class="is-empty"')
      .repeat(5 - n)}${reviews ? `<span class="stars__count">(${reviews})</span>` : ""}</div>`;

  const wishlist = new Set(store.get("buybari-wishlist", []));

  const cardHTML = (p, i) => `
    <article class="card" style="animation-delay:${(i % 10) * 40}ms">
      <a href="${productUrl(p.id)}" class="card__media" data-view="${p.id}" aria-label="${esc(p.name)}">
        <img src="${p.image}" alt="${esc(p.name)}" loading="lazy" decoding="async" width="300" height="300" />
      </a>
      <div class="card__badges">
        <span class="badge badge--${p.badge}">${p.badge}</span>
        ${off(p) ? `<span class="badge badge--off">-${off(p)}%</span>` : ""}
      </div>
      <div class="card__actions">
        <button class="card__action ${wishlist.has(p.id) ? "is-active" : ""}" data-wish="${p.id}" aria-label="Add to wishlist"><span data-icon="heart"></span></button>
        <button class="card__action card__action--view" data-view="${p.id}" aria-label="Quick view"><span data-icon="eye"></span></button>
      </div>
      <div class="card__body">
        <span class="card__cat">${esc(p.category)}</span>
        <h4 class="card__title" title="${esc(p.name)}"><a href="${productUrl(p.id)}" data-view="${p.id}">${esc(p.name)}</a></h4>
        ${stars(p.rating, p.reviews)}
        <div class="price">
          <span class="price__now">${money(p.price)}</span>
          ${p.oldPrice ? `<span class="price__old">${money(p.oldPrice)}</span>` : ""}
        </div>
        <div class="card__cta">
          <button class="btn btn--primary" data-order="${p.id}">Order Now</button>
          <button class="btn btn--outline" data-add="${p.id}" aria-label="Add to cart"><span data-icon="cart"></span></button>
        </div>
      </div>
    </article>`;

  const filtered = (sectionId) => {
    const q = state.query.toLowerCase();
    return PRODUCTS.filter(
      (p) =>
        p.section === sectionId &&
        (!state.category || p.category === state.category) &&
        (!q || p.name.toLowerCase().includes(q) || p.category.toLowerCase().includes(q))
    );
  };

  const endOfDay = () => {
    const d = new Date();
    d.setHours(23, 59, 59, 999);
    return d;
  };

  const renderSections = () => {
    const wrap = $("[data-sections]");
    if (!wrap) return;
    const filtering = state.category || state.query;
    let total = 0;

    wrap.innerHTML = SECTIONS.map((s) => {
      const items = filtered(s.id);
      total += items.length;
      if (filtering && !items.length) return "";
      const limit = state.visible[s.id] || PAGE();
      const shown = items.slice(0, limit);
      return `
        <section class="section" id="${s.id}">
          <div class="section__head">
            <h3 class="section__title">${s.title}.</h3>
            ${
              s.id === "discount"
                ? `<div class="section__meta"><div class="countdown" data-countdown>Ends in <b data-h>00</b>:<b data-m>00</b>:<b data-s>00</b></div></div>`
                : ""
            }
          </div>
          <div class="grid">${shown.map(cardHTML).join("")}</div>
          ${
            items.length > limit
              ? `<div class="section__more"><button class="btn btn--outline btn--lg" data-more="${s.id}">Load more (${items.length - limit})</button></div>`
              : ""
          }
        </section>`;
    }).join("");

    if (filtering && !total) {
      wrap.innerHTML = `<div class="section"><div class="section__empty">No products found${
        state.query ? ` for "<strong>${esc(state.query)}</strong>"` : ""
      }. <button class="btn btn--outline" data-clear-filters style="margin-left:8px">Show all products</button></div></div>`;
    }

    hydrateIcons(wrap);
    revealImages(wrap);
    tickCountdown();
  };

  function revealImages(root) {
    $$(".card__media img", root).forEach((img) => {
      const done = () => {
        img.classList.add("is-loaded");
        img.parentElement.classList.add("is-loaded");
      };
      if (img.complete && img.naturalWidth) done();
      else {
        img.addEventListener("load", done, { once: true });
        img.addEventListener("error", done, { once: true });
      }
    });
  }

  const tickCountdown = () => {
    const el = $("[data-countdown]");
    if (!el) return;
    const diff = Math.max(0, endOfDay() - new Date());
    const pad = (n) => String(n).padStart(2, "0");
    $("[data-h]", el).textContent = pad(Math.floor(diff / 3.6e6));
    $("[data-m]", el).textContent = pad(Math.floor((diff % 3.6e6) / 6e4));
    $("[data-s]", el).textContent = pad(Math.floor((diff % 6e4) / 1000));
  };
  setInterval(tickCountdown, 1000);

  const setCategory = (cat, scroll = true) => {
    if (!isHome()) return goHome(cat ? { cat } : {});
    state.category = cat;
    state.visible = {};
    $$("[data-category]").forEach((el) => el.classList.toggle("is-active", el.dataset.category === cat));
    renderSections();
    if (scroll) $(".chips-wrap").scrollIntoView({ behavior: "smooth", block: "start" });
  };

  document.addEventListener("click", (e) => {
    const cat = e.target.closest("[data-category]");
    if (cat) {
      e.preventDefault();
      closePanels();
      catMenu.classList.remove("is-open");
      state.query = "";
      $$("[data-search-input]").forEach((i) => (i.value = ""));
      setCategory(cat.dataset.category);
      return;
    }
    const more = e.target.closest("[data-more]");
    if (more) {
      const id = more.dataset.more;
      state.visible[id] = (state.visible[id] || PAGE()) + PAGE();
      const y = window.scrollY;
      renderSections();
      window.scrollTo({ top: y });
      return;
    }
    if (e.target.closest("[data-clear-filters]")) {
      state.query = "";
      $$("[data-search-input]").forEach((i) => (i.value = ""));
      setCategory("");
    }
  });

  /* ================= Slider ================= */
  const initSlider = () => {
    const root = $("[data-slider]");
    if (!root) return;
    const track = $("[data-slider-track]");
    const dots = $("[data-slider-dots]");
    let index = 0;
    let timer;

    track.innerHTML = SLIDES.map((s, i) => {
      const img = `<img src="${s.image}" alt="${esc(s.alt || "")}" ${i ? 'loading="lazy"' : 'fetchpriority="high"'} draggable="false" />`;
      if (s.plain) {
        const tag = s.href ? "a" : "div";
        const href = s.href ? ` href="${esc(s.href)}"` : "";
        return `<${tag} class="slider__slide slider__slide--plain${i === 0 ? " is-active" : ""}"${href}>${img}</${tag}>`;
      }
      return `
        <div class="slider__slide${i === 0 ? " is-active" : ""}">
          ${img}
          <div class="slider__content">
            <span class="slider__eyebrow">${s.eyebrow || ""}</span>
            <h2 class="slider__title">${s.title || ""}</h2>
            <p class="slider__text">${s.text || ""}</p>
            <button class="btn btn--primary btn--lg slider__cta" data-category="${esc(s.category || "")}">${s.cta || "Shop now"} <span data-icon="arrow-right"></span></button>
          </div>
        </div>`;
    }).join("");
    hydrateIcons(track);
    dots.innerHTML = SLIDES.map((_, i) => `<button class="slider__dot" data-dot="${i}" aria-label="Go to slide ${i + 1}"></button>`).join("");

    const go = (i) => {
      index = (i + SLIDES.length) % SLIDES.length;
      track.style.transform = `translateX(${-index * 100}%)`;
      $$(".slider__dot", dots).forEach((d, j) => d.classList.toggle("is-active", j === index));
      $$(".slider__slide", track).forEach((s, j) => s.classList.toggle("is-active", j === index));
    };
    const play = () => {
      clearInterval(timer);
      timer = setInterval(() => go(index + 1), 5000);
    };
    const stop = () => clearInterval(timer);

    $("[data-slider-prev]").addEventListener("click", () => { go(index - 1); play(); });
    $("[data-slider-next]").addEventListener("click", () => { go(index + 1); play(); });
    dots.addEventListener("click", (e) => {
      const d = e.target.closest("[data-dot]");
      if (d) { go(+d.dataset.dot); play(); }
    });
    root.addEventListener("mouseenter", stop);
    root.addEventListener("mouseleave", play);
    document.addEventListener("visibilitychange", () => (document.hidden ? stop() : play()));

    let startX = 0;
    let dx = 0;
    let dragging = false;
    root.addEventListener("pointerdown", (e) => {
      if (e.target.closest("button") || e.pointerType === "mouse" && e.button !== 0) return;
      dragging = true;
      startX = e.clientX;
      dx = 0;
      track.classList.add("is-dragging");
      stop();
    });
    window.addEventListener("pointermove", (e) => {
      if (!dragging) return;
      dx = e.clientX - startX;
      track.style.transform = `translateX(calc(${-index * 100}% + ${dx}px))`;
    });
    window.addEventListener("pointerup", () => {
      if (!dragging) return;
      dragging = false;
      track.classList.remove("is-dragging");
      if (Math.abs(dx) > root.offsetWidth * 0.15) go(index + (dx < 0 ? 1 : -1));
      else go(index);
      play();
    });

    go(0);
    play();
  };

  /* ================= Search ================= */
  const initSearch = () => {
    $$("[data-search]").forEach((form) => {
      const input = $("[data-search-input]", form);
      const box = $("[data-search-results]", form);
      let focused = -1;

      const highlight = (name, q) => {
        const i = name.toLowerCase().indexOf(q.toLowerCase());
        if (i < 0) return esc(name);
        return esc(name.slice(0, i)) + "<mark>" + esc(name.slice(i, i + q.length)) + "</mark>" + esc(name.slice(i + q.length));
      };

      const show = () => {
        const q = input.value.trim();
        focused = -1;
        if (q.length < 2) { box.hidden = true; return; }
        const hits = PRODUCTS.filter((p) => p.name.toLowerCase().includes(q.toLowerCase())).slice(0, 8);
        box.innerHTML = hits.length
          ? hits
              .map(
                (p) => `<button type="button" class="search__result" data-view="${p.id}">
                  <img src="${p.image}" alt="" loading="lazy" />
                  <span><span class="search__result-name">${highlight(p.name, q)}</span><span class="search__result-price">${money(p.price)}</span></span>
                </button>`
              )
              .join("")
          : `<div class="search__empty">No products match "${esc(q)}"</div>`;
        box.hidden = false;
      };

      let debounce;
      input.addEventListener("input", () => {
        clearTimeout(debounce);
        debounce = setTimeout(show, 120);
      });
      input.addEventListener("focus", show);
      input.addEventListener("keydown", (e) => {
        const items = $$(".search__result", box);
        if (!items.length || box.hidden) return;
        if (e.key === "ArrowDown" || e.key === "ArrowUp") {
          e.preventDefault();
          focused = (focused + (e.key === "ArrowDown" ? 1 : -1) + items.length) % items.length;
          items.forEach((it, i) => it.classList.toggle("is-focused", i === focused));
          items[focused].scrollIntoView({ block: "nearest" });
        } else if (e.key === "Enter" && focused >= 0) {
          e.preventDefault();
          items[focused].click();
        } else if (e.key === "Escape") {
          box.hidden = true;
        }
      });
      document.addEventListener("click", (e) => {
        if (!form.contains(e.target)) box.hidden = true;
      });
      box.addEventListener("click", () => (box.hidden = true));

      form.addEventListener("submit", (e) => {
        e.preventDefault();
        box.hidden = true;
        const q = input.value.trim();
        if (!isHome()) return goHome(q ? { q } : {});
        state.query = q;
        $$("[data-search-input]").forEach((i) => (i.value = q));
        setCategory("", true);
      });
    });
  };

  /* ================= Cart ================= */
  let cart = store.get("buybari-cart", []);

  const cartCount = () => cart.reduce((n, l) => n + l.qty, 0);
  const cartSubtotal = (lines = cart) => lines.reduce((n, l) => n + unitPrice(byId(l.id), l) * l.qty, 0);

  const bump = (el) => {
    el.classList.remove("bump");
    void el.offsetWidth;
    el.classList.add("bump");
  };

  const renderCart = () => {
    cart = cart.filter((l) => byId(l.id));
    store.set("buybari-cart", cart);
    const count = cartCount();
    $$("[data-cart-count]").forEach((b) => {
      b.textContent = count;
      b.hidden = !count;
    });
    $$("[data-cart-total]").forEach((el) => (el.textContent = money(cartSubtotal())));
    $("[data-cart-items-label]").textContent = count ? `(${count} item${count > 1 ? "s" : ""})` : "";
    $("[data-cart-subtotal]").textContent = money(cartSubtotal());
    $("[data-cart-foot]").hidden = !count;

    const body = $("[data-cart-body]");
    body.innerHTML = count
      ? cart
          .map((l) => {
            const p = byId(l.id);
            const variant = [l.color, l.size].filter(Boolean).join(" / ");
            const key = lineKey(l);
            return `<div class="cart-line">
              <img src="${p.image}" alt="" />
              <div>
                <p class="cart-line__name">${esc(p.name)}${variant ? `<br><small class="muted">${esc(variant)}</small>` : ""}</p>
                <p class="cart-line__price">${money(unitPrice(p, l) * l.qty)}</p>
                <div class="qty">
                  <button data-qty-key="${esc(key)}" data-delta="-1" aria-label="Decrease">−</button>
                  <span>${l.qty}</span>
                  <button data-qty-key="${esc(key)}" data-delta="1" aria-label="Increase">+</button>
                </div>
              </div>
              <button class="cart-line__remove icon-btn" data-remove-key="${esc(key)}" aria-label="Remove"><span data-icon="trash"></span></button>
            </div>`;
          })
          .join("")
      : `<div class="empty-state"><span data-icon="cart"></span><p>Your cart is empty.</p><button class="btn btn--primary" data-close>Continue shopping</button></div>`;
    hydrateIcons(body);
  };

  const addToCart = (id, qty = 1, silent = false, extra = {}) => {
    const p = byId(id);
    if (!p) return;
    const pick = {
      color: extra.color || "",
      size: extra.size || "",
      variant_sku: extra.variant_sku || "",
    };
    if (!requireSizeOrToast(p, pick)) return false;
    const next = { id, qty, ...pick };
    const line = cart.find((l) => lineKey(l) === lineKey(next));
    if (line) line.qty += qty;
    else cart.push(next);
    renderCart();
    $$("[data-cart-count]").forEach(bump);
    if (!silent) toast("Added to cart");
    return true;
  };

  document.addEventListener("click", (e) => {
    const add = e.target.closest("[data-add]");
    if (add) {
      const p = byId(add.dataset.add);
      if (productNeedsSize(p)) return openQuickView(p.id);
      return addToCart(add.dataset.add);
    }

    const q = e.target.closest("[data-qty-key]");
    if (q) {
      const line = cart.find((l) => lineKey(l) === q.dataset.qtyKey);
      if (line) {
        line.qty = Math.max(1, line.qty + Number(q.dataset.delta));
        renderCart();
      }
      return;
    }
    const rm = e.target.closest("[data-remove-key]");
    if (rm) {
      cart = cart.filter((l) => lineKey(l) !== rm.dataset.removeKey);
      renderCart();
      return;
    }
    if (e.target.closest("[data-open-cart]")) return openDrawer($("[data-cart]"));
    if (e.target.closest("[data-open-menu]")) return openDrawer($("[data-menu]"));
    if (e.target.closest("[data-open-wishlist]")) {
      renderWishlist();
      return openDrawer($("[data-wishlist]"));
    }
    if (e.target.closest("[data-checkout]")) {
      const missing = cart.find((l) => productNeedsSize(byId(l.id)) && !String(l.size || "").trim());
      if (missing) {
        toast("Choose a size for " + (byId(missing.id)?.name || "an item"), "close");
        return openQuickView(missing.id);
      }
      return openCheckout(cart.map((l) => ({ ...l })), true);
    }
  });

  /* ================= Wishlist ================= */
  const renderWishlistCount = () => {
    store.set("buybari-wishlist", [...wishlist]);
    $$("[data-wishlist-count]").forEach((b) => {
      b.textContent = wishlist.size;
      b.hidden = !wishlist.size;
    });
  };

  const renderWishlist = () => {
    const body = $("[data-wishlist-body]");
    const items = [...wishlist].map(byId).filter(Boolean);
    body.innerHTML = items.length
      ? items
          .map(
            (p) => `<div class="cart-line">
              <img src="${p.image}" alt="" />
              <div>
                <p class="cart-line__name">${esc(p.name)}</p>
                <p class="cart-line__price">${money(p.price)}</p>
                <button class="btn btn--outline" style="margin-top:6px;padding:4px 10px;font-size:12px" data-add="${p.id}">Add to cart</button>
              </div>
              <button class="cart-line__remove icon-btn" data-wish="${p.id}" aria-label="Remove"><span data-icon="trash"></span></button>
            </div>`
          )
          .join("")
      : `<div class="empty-state"><span data-icon="heart"></span><p>No saved items yet.</p></div>`;
    hydrateIcons(body);
  };

  document.addEventListener("click", (e) => {
    const w = e.target.closest("[data-wish]");
    if (!w) return;
    const id = w.dataset.wish;
    const added = !wishlist.has(id);
    added ? wishlist.add(id) : wishlist.delete(id);
    $$(`.card__action[data-wish="${id}"], .pdp__tool[data-wish="${id}"]`).forEach((b) => b.classList.toggle("is-active", added));
    renderWishlistCount();
    if ($("[data-wishlist]").classList.contains("is-open")) renderWishlist();
    toast(added ? "Saved to wishlist" : "Removed from wishlist", "heart");
  });

  /* ================= Quick view ================= */
  const openQuickView = (id) => {
    const p = byId(id);
    if (!p) return;
    openModal(`
      <div class="quick" data-qv-root data-qv-id="${esc(p.id)}">
        <div class="quick__media"><img src="${p.image}" alt="${esc(p.name)}" /></div>
        <div class="quick__info">
          <span class="quick__cat">${esc(p.category)}</span>
          <h2 class="quick__title" id="modal-title">${esc(p.name)}</h2>
          ${stars(p.rating, p.reviews)}
          <div class="price">
            <span class="price__now" data-qv-price>${money(p.price)}</span>
            ${p.oldPrice ? `<span class="price__old">${money(p.oldPrice)}</span><span class="quick__save">Save ${money(p.oldPrice - p.price)}</span>` : ""}
          </div>
          <p class="quick__desc">${esc(p.description)}</p>
          ${sizeColorHTML(p)}
          <ul class="quick__perks">
            <li><span data-icon="truck"></span> Delivery inside Dhaka ${money(STORE.deliveryInsideDhaka)}, outside ${money(STORE.deliveryOutsideDhaka)}</li>
            <li><span data-icon="cod"></span> Cash on delivery available</li>
            <li><span data-icon="return"></span> Free &amp; easy return</li>
            <li><span data-icon="badge"></span> 100% authentic product</li>
          </ul>
          <div class="quick__row">
            <div class="qty" data-qv-qty>
              <button type="button" data-qv-delta="-1" aria-label="Decrease">−</button>
              <span data-qv-value>1</span>
              <button type="button" data-qv-delta="1" aria-label="Increase">+</button>
            </div>
            <button class="btn btn--outline" data-qv-add="${p.id}"><span data-icon="cart"></span> Add to cart</button>
          </div>
          <button class="btn btn--primary btn--lg btn--block" data-qv-order="${p.id}">Order Now</button>
          <div class="quick__links">
            <a class="quick__more" href="${productUrl(p.id)}">View full details <span data-icon="arrow-right"></span></a>
            <a class="quick__call" href="tel:${STORE.phoneLink}"><span data-icon="phone"></span> ${STORE.phone}</a>
          </div>
        </div>
      </div>`);
  };

  modal.addEventListener("change", (e) => {
    if (!e.target.closest("[data-variant]")) return;
    const root = e.target.closest("[data-qv-root]");
    if (!root) return;
    const p = byId(root.dataset.qvId);
    if (!p) return;
    const priceEl = $("[data-qv-price]", root);
    if (priceEl) priceEl.textContent = money(readVariantPick(root, p).price);
  });

  modal.addEventListener("click", (e) => {
    const d = e.target.closest("[data-qv-delta]");
    const val = $("[data-qv-value]", modal);
    if (d && val) {
      val.textContent = Math.max(1, Number(val.textContent) + Number(d.dataset.qvDelta));
      return;
    }
    const root = e.target.closest("[data-qv-root]") || $("[data-qv-root]", modal);
    const add = e.target.closest("[data-qv-add]");
    if (add) {
      const p = byId(add.dataset.qvAdd);
      const pick = root && p ? readVariantPick(root, p) : {};
      if (addToCart(add.dataset.qvAdd, Number(val?.textContent || 1), false, pick)) closePanels();
      return;
    }
    const order = e.target.closest("[data-qv-order]");
    if (order) {
      const p = byId(order.dataset.qvOrder);
      const pick = root && p ? readVariantPick(root, p) : {};
      if (!requireSizeOrToast(p, pick)) return;
      openCheckout([{ id: order.dataset.qvOrder, qty: Number(val?.textContent || 1), ...pick }]);
    }
  });

  document.addEventListener("click", (e) => {
    const v = e.target.closest("[data-view]");
    if (v) {
      if (e.ctrlKey || e.metaKey || e.shiftKey) return;
      e.preventDefault();
      if (isMobile()) location.href = productUrl(v.dataset.view);
      else openQuickView(v.dataset.view);
      return;
    }
    const o = e.target.closest("[data-order]");
    if (o) {
      const p = byId(o.dataset.order);
      if (productNeedsSize(p)) return openQuickView(p.id);
      openCheckout([{ id: o.dataset.order, qty: 1 }]);
    }
  });

  /* ================= Checkout ================= */
  let checkoutLines = [];
  let checkoutFromCart = false;

  const summaryHTML = (zone) => {
    const sub = cartSubtotal(checkoutLines);
    const ship = zone === "outside" ? STORE.deliveryOutsideDhaka : STORE.deliveryInsideDhaka;
    return `
      <h3>Order Summary</h3>
      ${checkoutLines
        .map((l) => {
          const p = byId(l.id);
          const variant = [l.color, l.size].filter(Boolean).join(" / ");
          return `<div class="summary-line"><img src="${p.image}" alt="" /><div><p>${esc(p.name)}</p><small class="muted">${l.qty} × ${money(unitPrice(p, l))}${variant ? ` · ${esc(variant)}` : ""}</small></div><strong>${money(unitPrice(p, l) * l.qty)}</strong></div>`;
        })
        .join("")}
      <div class="summary-row" style="margin-top:8px"><span>Subtotal</span><span>${money(sub)}</span></div>
      <div class="summary-row"><span>Delivery charge</span><span>${money(ship)}</span></div>
      <div class="summary-row summary-row--total"><span>Total</span><span>${money(sub + ship)}</span></div>`;
  };

  const openCheckout = (lines, fromCart = false) => {
    checkoutLines = lines.filter((l) => byId(l.id));
    checkoutFromCart = fromCart;
    if (!checkoutLines.length) return;
    const missingSize = checkoutLines.find((l) => productNeedsSize(byId(l.id)) && !String(l.size || "").trim());
    if (missingSize) {
      toast("Please choose a size for " + (byId(missingSize.id)?.name || "this product"), "close");
      return openQuickView(missingSize.id);
    }
    openModal(`
      <div class="checkout">
        <form class="checkout__form" data-checkout-form novalidate>
          <h2 id="modal-title">Place your order</h2>
          <p>Fill in your details and we'll call you to confirm. Pay cash on delivery.</p>
          <div class="field">
            <label for="co-name">Full name *</label>
            <input id="co-name" name="name" placeholder="Your name" autocomplete="name" required />
          </div>
          <div class="field">
            <label for="co-phone">Phone number *</label>
            <input id="co-phone" name="phone" type="tel" placeholder="01XXXXXXXXX" autocomplete="tel" inputmode="numeric" required />
          </div>
          <div class="field">
            <label for="co-address">Full address *</label>
            <textarea id="co-address" name="address" rows="2" placeholder="House, road, area, district" autocomplete="street-address" required></textarea>
          </div>
          <div class="field">
            <label>Delivery area</label>
            <div class="radio-group">
              <label class="radio"><input type="radio" name="zone" value="inside" checked /> Inside Dhaka <b>${STORE.deliveryInsideDhaka}৳</b></label>
              <label class="radio"><input type="radio" name="zone" value="outside" /> Outside Dhaka <b>${STORE.deliveryOutsideDhaka}৳</b></label>
            </div>
          </div>
          <button type="submit" class="btn btn--primary btn--lg btn--block">Confirm Order</button>
        </form>
        <div class="checkout__summary" data-summary>${summaryHTML("inside")}</div>
      </div>`);

    const form = $("[data-checkout-form]", modal);
    form.addEventListener("change", (e) => {
      if (e.target.name === "zone") $("[data-summary]", modal).innerHTML = summaryHTML(e.target.value);
    });
    form.addEventListener("input", (e) => {
      const field = e.target.closest(".field");
      if (field?.classList.contains("has-error")) validate(form, e.target.name);
    });
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      if (!validate(form)) return;
      const data = Object.fromEntries(new FormData(form));
      let orderNo = "BB" + Date.now().toString().slice(-7);
      if (csrf()) {
        const result = await postJSON("/checkout", { ...data, lines: checkoutLines });
        if (!result.ok) {
          const errors = result.data.errors || {};
          Object.entries(errors).forEach(([name, msgs]) => {
            const input = form.elements[name];
            const field = input?.closest(".field");
            if (!field) return;
            field.classList.add("has-error");
            field.querySelector(".field__error")?.remove();
            field.insertAdjacentHTML("beforeend", `<span class="field__error">${esc(msgs[0])}</span>`);
          });
          if (!Object.keys(errors).length) toast(result.data.message || "Could not place the order. Please try again.", "close");
          return;
        }
        orderNo = result.data.order_no || orderNo;
      } else {
        const orders = store.get("buybari-orders", []);
        orders.push({ orderNo, ...data, lines: checkoutLines, at: new Date().toISOString() });
        store.set("buybari-orders", orders);
      }
      if (checkoutFromCart) {
        cart = [];
        renderCart();
      }
      $("[data-modal-content]").innerHTML = `
        <div class="success">
          <div class="success__icon">${ICONS["check-big"]}</div>
          <h2>Thank you, ${esc(data.name.split(" ")[0])}!</h2>
          <p>Your order <strong>#${esc(orderNo)}</strong> has been placed. Our team will call you at <strong>${esc(data.phone)}</strong> shortly to confirm.</p>
          <button class="btn btn--primary btn--lg" data-close>Continue shopping</button>
        </div>`;
    });
    setTimeout(() => $("#co-name", modal)?.focus(), 50);
  };

  const RULES = {
    name: (v) => (v.trim().length >= 2 ? "" : "Please enter your name"),
    phone: (v) => (/^(?:\+?88)?01[3-9]\d{8}$/.test(v.replace(/[\s-]/g, "")) ? "" : "Enter a valid Bangladeshi mobile number"),
    address: (v) => (v.trim().length >= 8 ? "" : "Please enter your full address"),
  };

  const CONTACT_RULES = {
    name: RULES.name,
    phone: RULES.phone,
    email: (v) => (!v.trim() || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()) ? "" : "Enter a valid email address"),
    message: (v) => (v.trim().length >= 10 ? "" : "Please write at least 10 characters"),
  };

  const validate = (form, only, rules = RULES) => {
    let ok = true;
    Object.entries(rules).forEach(([name, rule]) => {
      if (only && only !== name) return;
      const input = form.elements[name];
      const field = input.closest(".field");
      const msg = rule(input.value);
      field.classList.toggle("has-error", !!msg);
      field.querySelector(".field__error")?.remove();
      if (msg) {
        field.insertAdjacentHTML("beforeend", `<span class="field__error">${msg}</span>`);
        if (ok && !only) input.focus();
        ok = false;
      }
    });
    return ok;
  };

  /* ================= Sticky nav, back-to-top, speed dial ================= */
  const initChrome = () => {
    const navbar = $("[data-navbar]");
    const toTop = $("[data-to-top]");
    const onScroll = () => {
      const y = window.scrollY;
      navbar.classList.toggle("is-stuck", navbar.getBoundingClientRect().top <= 0 && y > 0);
      toTop.classList.toggle("is-visible", y > 600);
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
    toTop.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }));

    const dial = $("[data-speed-dial]");
    const fab = $("[data-speed-toggle]");
    fab.addEventListener("click", (e) => {
      e.stopPropagation();
      const open = dial.classList.toggle("is-open");
      fab.setAttribute("aria-expanded", open);
    });
    document.addEventListener("click", (e) => {
      if (!dial.contains(e.target)) {
        dial.classList.remove("is-open");
        fab.setAttribute("aria-expanded", "false");
      }
    });

    let wasMobile = isMobile();
    window.addEventListener("resize", () => {
      if (isMobile() !== wasMobile) {
        wasMobile = isMobile();
        state.visible = {};
        renderSections();
      }
    });
  };

  /* ================= Contact form ================= */
  const initContactForm = () => {
    const form = $("[data-contact-form]");
    if (!form) return;
    form.addEventListener("input", (e) => {
      if (e.target.closest(".field")?.classList.contains("has-error")) validate(form, e.target.name, CONTACT_RULES);
    });
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      if (!validate(form, null, CONTACT_RULES)) return;
      const data = Object.fromEntries(new FormData(form));
      if (csrf()) {
        const result = await postJSON("/contact", data);
        if (!result.ok) {
          toast(result.data.message || "Could not send your message. Please try again.", "close");
          return;
        }
      } else {
        const messages = store.get("buybari-messages", []);
        messages.push({ ...data, at: new Date().toISOString() });
        store.set("buybari-messages", messages);
      }
      form.outerHTML = `
        <div class="success success--inline">
          <div class="success__icon">${ICONS["check-big"]}</div>
          <h2>Message sent!</h2>
          <p>Thanks ${esc(data.name.split(" ")[0])}, we've received your message and will get back to you within 24 hours.</p>
        </div>`;
    });
  };

  /* ================= Product page ================= */
  const initProductPage = () => {
    const root = $("[data-product-page]");
    if (!root) return;
    const p = byId(window.BUYBARI_PRODUCT_ID || new URLSearchParams(location.search).get("id"));

    if (!p) {
      document.title = `Product not found | ${STORE.name}`;
      root.innerHTML = `
        <div class="pdp-empty">
          <span data-icon="box"></span>
          <h1>Product not found</h1>
          <p>This product may have been removed or the link is incorrect.</p>
          <a href="index.html#products" class="btn btn--primary btn--lg">Browse all products</a>
        </div>`;
      hydrateIcons(root);
      return;
    }

    document.title = `${p.name} | ${STORE.name}`;
    $('meta[name="description"]')?.setAttribute("content", `${p.name} at ${money(p.price)}. ${p.description}`);

    const variants = Array.isArray(p.variants) ? p.variants : [];
    const variantHTML = sizeColorHTML(p);
    const code = `BB-${p.id.toUpperCase()}`;
    const save = p.oldPrice ? p.oldPrice - p.price : 0;
    const related = [
      ...PRODUCTS.filter((x) => x.category === p.category && x.id !== p.id),
      ...PRODUCTS.filter((x) => x.category !== p.category && x.section === p.section),
    ].slice(0, 4);

    root.innerHTML = `
      <div class="pdp__top">
        <button class="pdp__back" data-back aria-label="Go back"><span data-icon="arrow-left"></span></button>
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="index.html">Home</a><span>/</span>
          <a href="#" data-category="${esc(p.category)}">${esc(p.category)}</a><span>/</span>
          <span>${esc(p.name)}</span>
        </nav>
      </div>

      <section class="pdp__main">
        <div class="pdp__gallery">
          <div class="pdp__image" data-zoom>
            <img src="${p.image}" alt="${esc(p.name)}" fetchpriority="high" />
            <div class="card__badges">
              <span class="badge badge--${p.badge}">${p.badge}</span>
              ${off(p) ? `<span class="badge badge--off">-${off(p)}%</span>` : ""}
            </div>
            <div class="pdp__tools">
              <button class="pdp__tool ${wishlist.has(p.id) ? "is-active" : ""}" data-wish="${p.id}" aria-label="Add to wishlist"><span data-icon="heart"></span></button>
              <button class="pdp__tool" data-share aria-label="Share product"><span data-icon="share"></span></button>
            </div>
          </div>
        </div>

        <div class="pdp__info">
          <a href="#" class="pdp__cat" data-category="${esc(p.category)}">${esc(p.category)}</a>
          <h1 class="pdp__title">${esc(p.name)}</h1>
          <div class="pdp__meta">
            ${stars(p.rating, p.reviews)}
            <span class="pdp__stock"><span data-icon="check-big"></span> In stock</span>
            <span class="muted">Code: ${code}</span>
          </div>

          <div class="pdp__price">
            <span class="price__now">${money(p.price)}</span>
            ${p.oldPrice ? `<span class="price__old">${money(p.oldPrice)}</span><span class="pdp__save">Save ${money(save)} (${off(p)}%)</span>` : ""}
          </div>

          <p class="pdp__desc">${esc(p.description)}</p>
          ${variantHTML}

          <div class="pdp__buy">
            <div class="pdp__qty">
              <span>Quantity</span>
              <div class="qty qty--lg">
                <button type="button" data-pdp-delta="-1" aria-label="Decrease">−</button>
                <span data-pdp-qty>1</span>
                <button type="button" data-pdp-delta="1" aria-label="Increase">+</button>
              </div>
            </div>
            <div class="pdp__actions">
              <button class="btn btn--outline btn--lg" data-pdp-add><span data-icon="cart"></span> Add to cart</button>
              <button class="btn btn--primary btn--lg" data-pdp-order>Order Now</button>
            </div>
          </div>

          <div class="pdp__contact">
            <a href="tel:${STORE.phoneLink}" class="pdp__contact-btn"><span data-icon="phone"></span><span><small>Call to order</small>${STORE.phone}</span></a>
            <a href="#" class="pdp__contact-btn pdp__contact-btn--wa" data-pdp-wa target="_blank" rel="noreferrer"><span data-icon="whatsapp"></span><span><small>Order on</small>WhatsApp</span></a>
          </div>

          <ul class="pdp__perks">
            <li><span data-icon="truck"></span><div><strong>Fast delivery</strong><small>1-2 days in Dhaka, 2-5 days outside</small></div></li>
            <li><span data-icon="cod"></span><div><strong>Cash on delivery</strong><small>Check first, then pay</small></div></li>
            <li><span data-icon="return"></span><div><strong>7-day easy return</strong><small>If damaged or not as described</small></div></li>
            <li><span data-icon="badge"></span><div><strong>100% authentic</strong><small>Quality checked before dispatch</small></div></li>
          </ul>
        </div>
      </section>

      <section class="pdp__details">
        <div class="pdp__tabs" role="tablist">
          <button role="tab" class="is-active" data-tab="desc" aria-selected="true">Description</button>
          <button role="tab" data-tab="delivery" aria-selected="false">Delivery &amp; Payment</button>
          <button role="tab" data-tab="returns" aria-selected="false">Returns</button>
        </div>
        <div class="pdp__panel is-active" data-panel="desc" role="tabpanel">
          <p>${esc(p.description)}</p>
          <table class="pdp__specs">
            <tr><th>Product code</th><td>${code}</td></tr>
            <tr><th>Category</th><td>${esc(p.category)}</td></tr>
            <tr><th>Availability</th><td>In stock</td></tr>
            <tr><th>Customer rating</th><td>${p.rating} out of 5 (${p.reviews} reviews)</td></tr>
            <tr><th>Price</th><td>${money(p.price)}${p.oldPrice ? ` <s class="muted">${money(p.oldPrice)}</s>` : ""}</td></tr>
          </table>
        </div>
        <div class="pdp__panel" data-panel="delivery" role="tabpanel" hidden>
          <table class="pdp__specs">
            <tr><th>Inside Dhaka</th><td>${money(STORE.deliveryInsideDhaka)}, usually 1-2 working days</td></tr>
            <tr><th>Outside Dhaka</th><td>${money(STORE.deliveryOutsideDhaka)}, usually 2-5 working days</td></tr>
            <tr><th>Payment</th><td>Cash on delivery, bKash, Nagad, Rocket, Visa and Mastercard</td></tr>
          </table>
          <p class="muted">Our team will call you to confirm your order before dispatch. See our <a href="payment.html">Payment Policy</a> for details.</p>
        </div>
        <div class="pdp__panel" data-panel="returns" role="tabpanel" hidden>
          <p>Received a damaged, wrong or different item? Contact us within <strong>7 days</strong> of delivery and we'll arrange a replacement or refund.</p>
          <ul class="pdp__list">
            <li>Keep the product unused with its original packaging and tags.</li>
            <li>Share photos or an unboxing video of the issue.</li>
            <li>Refunds are processed within 5-7 working days after we receive the item.</li>
          </ul>
          <p class="muted">Read the full <a href="refund.html">Refund &amp; Return Policy</a>.</p>
        </div>
      </section>

      ${
        related.length
          ? `<section class="section pdp__related">
              <div class="section__head"><h3 class="section__title">You may also like.</h3></div>
              <div class="grid">${related.map(cardHTML).join("")}</div>
            </section>`
          : ""
      }

      <div class="pdp-bar">
        <div class="pdp-bar__price">
          <span class="price__now">${money(p.price)}</span>
          ${p.oldPrice ? `<span class="price__old">${money(p.oldPrice)}</span>` : ""}
        </div>
        <button class="btn btn--outline" data-pdp-add aria-label="Add to cart"><span data-icon="cart"></span></button>
        <button class="btn btn--primary" data-pdp-order>Order Now</button>
      </div>`;

    hydrateIcons(root);
    revealImages(root);

    const qtyEl = $("[data-pdp-qty]", root);
    const qty = () => Number(qtyEl.textContent);
    const chosen = () => readVariantPick(root, p);
    const waLink = () => {
      const pick = chosen();
      const bits = [pick.color, pick.size].filter(Boolean).join(", ");
      return `https://wa.me/${STORE.whatsapp}?text=${encodeURIComponent(
        `Hi ${STORE.name}, I'd like to order:\n${p.name}${bits ? ` (${bits})` : ""}\nQuantity: ${qty()}\nPrice: ${money(pick.price * qty())}\n${location.href}`
      )}`;
    };
    $("[data-pdp-wa]", root).href = waLink();
    root.addEventListener("change", (e) => {
      if (!e.target.closest("[data-variant]")) return;
      const now = root.querySelector(".pdp__price .price__now");
      if (now) now.textContent = money(chosen().price);
      $("[data-pdp-wa]", root).href = waLink();
    });

    root.addEventListener("click", async (e) => {
      const d = e.target.closest("[data-pdp-delta]");
      if (d) {
        qtyEl.textContent = Math.max(1, Math.min(20, qty() + Number(d.dataset.pdpDelta)));
        $("[data-pdp-wa]", root).href = waLink();
        return;
      }
      if (e.target.closest("[data-pdp-add]")) {
        const pick = chosen();
        if (!requireSizeOrToast(p, pick)) return;
        return addToCart(p.id, qty(), false, pick);
      }
      if (e.target.closest("[data-pdp-order]")) {
        const pick = chosen();
        if (!requireSizeOrToast(p, pick)) return;
        return openCheckout([{ id: p.id, qty: qty(), ...pick }]);
      }
      if (e.target.closest("[data-back]")) {
        if (document.referrer.startsWith(location.origin) && history.length > 1) history.back();
        else location.href = window.BUYBARI_CATALOG ? "/#products" : "index.html#products";
        return;
      }
      const tab = e.target.closest("[data-tab]");
      if (tab) {
        $$("[data-tab]", root).forEach((t) => {
          const on = t === tab;
          t.classList.toggle("is-active", on);
          t.setAttribute("aria-selected", on);
        });
        $$("[data-panel]", root).forEach((panel) => {
          const on = panel.dataset.panel === tab.dataset.tab;
          panel.hidden = !on;
          panel.classList.toggle("is-active", on);
        });
        return;
      }
      if (e.target.closest("[data-share]")) {
        const data = { title: p.name, text: `${p.name} at ${money(p.price)} on ${STORE.name}`, url: location.href };
        try {
          if (navigator.share) await navigator.share(data);
          else {
            await navigator.clipboard.writeText(location.href);
            toast("Link copied", "check-big");
          }
        } catch {}
      }
    });

    const zoom = $("[data-zoom]", root);
    const img = $("img", zoom);
    zoom.addEventListener("mousemove", (e) => {
      if (isMobile()) return;
      const r = zoom.getBoundingClientRect();
      img.style.transformOrigin = `${((e.clientX - r.left) / r.width) * 100}% ${((e.clientY - r.top) / r.height) * 100}%`;
      zoom.classList.add("is-zoomed");
    });
    zoom.addEventListener("mouseleave", () => zoom.classList.remove("is-zoomed"));
  };

  /* ================= Init ================= */
  const applyUrlFilters = () => {
    if (!isHome()) return;
    const params = new URLSearchParams(location.search);
    const q = params.get("q") || "";
    const cat = params.get("cat") || "";
    if (!q && !cat) return;
    state.query = q;
    $$("[data-search-input]").forEach((i) => (i.value = q));
    setCategory(CATEGORIES.some((c) => c.name === cat) ? cat : "", true);
  };

  renderCategories();
  hydrateIcons();
  renderSections();
  initSlider();
  initSearch();
  renderCart();
  renderWishlistCount();
  initChrome();
  initContactForm();
  initProductPage();
  applyUrlFilters();
})();
