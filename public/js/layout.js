(() => {
  "use strict";

  const page = document.body.dataset.page || "home";
  const home = page === "home" ? "" : "index.html";
  const year = new Date().getFullYear();
  const PAGES = Object.assign(
    {
      home: "index.html",
      campaign: `${home}#discount`,
      shop: `${home}#products`,
      about: "about.html",
      contact: "contact.html",
      refund: "refund.html",
      privacy: "privacy.html",
      terms: "terms.html",
      payment: "payment.html",
    },
    window.BUYBARI_PAGES || {}
  );

  const NAV = [
    { id: "home", label: "Home", href: PAGES.home },
    { id: "campaign", label: "Campaign", href: PAGES.campaign },
    { id: "shop", label: "Shop", href: PAGES.shop },
    { id: "about", label: "About us", href: PAGES.about },
    { id: "contact", label: "Contact us", href: PAGES.contact },
    { id: "refund", label: "Return process", href: PAGES.refund },
  ];

  const LEGAL = [
    { id: "privacy", label: "Privacy Policy", href: PAGES.privacy },
    { id: "terms", label: "Terms & Conditions", href: PAGES.terms },
    { id: "refund", label: "Refund & Return Policy", href: PAGES.refund },
    { id: "payment", label: "Payment Policy", href: PAGES.payment },
  ];

  const navLinks = NAV.map(
    (n) => `<li><a href="${n.href}" class="${n.id === page ? "is-active" : ""}">${n.label}</a></li>`
  ).join("");

  const header = `
  <div class="announce">
    <div class="container announce__inner">
      <p><span data-icon="truck"></span> Delivery all over Bangladesh &middot; Cash on delivery available</p>
      <a href="tel:${STORE.phoneLink}" class="announce__phone"><span data-icon="phone"></span> ${STORE.phone}</a>
    </div>
  </div>

  <header class="header" id="top">
    <div class="header__main container">
      <a href="${PAGES.home}" class="logo" aria-label="${STORE.name} home">
        <img src="${STORE.logo}" alt="${STORE.name}" width="110" height="86" />
      </a>

      <div class="header__center">
        <form class="search" role="search" data-search>
          <div class="search__field">
            <input type="search" placeholder="Search for products..." aria-label="Search products" autocomplete="off" data-search-input />
            <div class="search__results" data-search-results hidden></div>
          </div>
          <button type="submit" class="btn btn--primary search__btn">
            <span data-icon="search"></span><span>Search</span>
          </button>
        </form>
        <ul class="quick-cats" data-quick-cats></ul>
      </div>

      <div class="header__actions">
        <a href="tel:${STORE.phoneLink}" class="hotline">
          <span class="hotline__icon" data-icon="phone"></span>
          <span>
            <small>Hotline Number:</small>
            <strong>${STORE.phone}</strong>
          </span>
        </a>
        <button class="icon-btn" data-open-wishlist aria-label="Wishlist">
          <span data-icon="heart"></span>
          <span class="icon-btn__badge" data-wishlist-count hidden>0</span>
        </button>
        <button class="icon-btn" data-open-cart aria-label="Cart">
          <span data-icon="cart"></span>
          <span class="icon-btn__badge" data-cart-count hidden>0</span>
        </button>
      </div>
    </div>

    <div class="header__mobile">
      <div class="header__mobile-top">
        <button class="icon-btn" data-open-menu aria-label="Open menu"><span data-icon="menu"></span></button>
        <a href="${PAGES.home}" class="logo"><img src="${STORE.logo}" alt="${STORE.name}" width="70" height="55" /></a>
        <button class="icon-btn" data-open-cart aria-label="Cart">
          <span data-icon="cart"></span>
          <span class="icon-btn__badge" data-cart-count hidden>0</span>
        </button>
      </div>
      <form class="search search--mobile" role="search" data-search>
        <div class="search__field">
          <input type="search" placeholder="Search..." aria-label="Search products" autocomplete="off" data-search-input />
          <div class="search__results" data-search-results hidden></div>
        </div>
        <button type="submit" class="btn btn--primary search__btn" aria-label="Search"><span data-icon="search"></span></button>
      </form>
    </div>
  </header>

  <nav class="navbar" data-navbar>
    <div class="container navbar__inner">
      <div class="cat-dropdown">
        <button class="cat-dropdown__btn" data-cat-toggle aria-expanded="false">
          <span data-icon="grid"></span>
          <span>Categories</span>
          <span class="chev" data-icon="chevron-down"></span>
        </button>
        <ul class="cat-dropdown__menu" data-cat-menu></ul>
      </div>
      <ul class="navbar__links">${navLinks}</ul>
      <button class="navbar__cart" data-open-cart>
        <span data-icon="cart"></span>
        <span data-cart-total>৳0</span>
      </button>
    </div>
  </nav>`;

  const footer = `
  <section class="newsletter">
    <div class="container newsletter__inner">
      <div>
        <h3>Get deals before anyone else</h3>
        <p>Follow us on Facebook for flash sales, new arrivals and exclusive coupon codes.</p>
      </div>
      <a href="${STORE.facebook}" target="_blank" rel="noreferrer" class="btn btn--light btn--lg"><span data-icon="facebook"></span> Follow ${STORE.name}</a>
    </div>
  </section>

  <footer class="footer" id="footer">
    <div class="container">
      <div class="footer__grid">
        <div class="footer__brand">
          <a href="${PAGES.home}"><img src="${STORE.logo}" alt="${STORE.name}" class="footer__logo" loading="lazy" /></a>
          <p class="footer__tagline">${STORE.tagline}</p>
          <h2 class="footer__title">Follow Us</h2>
          <ul class="socials">
            <li><a href="${STORE.facebook}" target="_blank" rel="noreferrer" aria-label="Facebook"><span data-icon="facebook"></span></a></li>
          </ul>
        </div>

        <div>
          <h2 class="footer__title">Contacts</h2>
          <ul class="footer__contact">
            <li><span data-icon="pin"></span><div><h3 class="footer__sub">Address</h3><p>${STORE.address}</p></div></li>
            <li><span data-icon="phone"></span><div><h3 class="footer__sub">Phone</h3><p><a href="tel:${STORE.phoneLink}">${STORE.phone}</a></p></div></li>
            <li><span data-icon="mail"></span><div><h3 class="footer__sub">Email</h3><p><a href="mailto:${STORE.email}">${STORE.email}</a></p></div></li>
          </ul>
        </div>

        <div>
          <h2 class="footer__title">Company</h2>
          <ul class="footer__links">
            <li><a href="${PAGES.about}">About us</a></li>
            <li><a href="${PAGES.contact}">Contact us</a></li>
            <li><a href="${PAGES.shop}">Shop</a></li>
            <li><a href="${PAGES.campaign}">Campaign</a></li>
          </ul>
        </div>

        <div>
          <h2 class="footer__title">Legals</h2>
          <ul class="footer__links">
            ${LEGAL.map((l) => `<li><a href="${l.href}">${l.label}</a></li>`).join("")}
          </ul>
        </div>
      </div>

      <div class="footer__bottom">
        <p>&copy; ${year} <a href="${PAGES.home}">${STORE.name}&trade;</a>. All Rights Reserved.</p>
        <div class="payments">
          <p>Payment Methods</p>
          <ul class="payments__list">
            <li class="pay pay--bkash">bKash</li>
            <li class="pay pay--nagad">Nagad</li>
            <li class="pay pay--rocket">Rocket</li>
            <li class="pay pay--visa">VISA</li>
            <li class="pay pay--master"><i></i><i></i></li>
            <li class="pay pay--cod">COD</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <nav class="bottom-nav" aria-label="Mobile navigation">
    <a href="${PAGES.home}" class="${page === "home" ? "is-active" : ""}"><span data-icon="home"></span><span>Home</span></a>
    <button data-open-menu><span data-icon="grid"></span><span>Categories</span></button>
    <a href="${PAGES.shop}"><span data-icon="bag"></span><span>Products</span></a>
    <button data-open-cart>
      <span class="bottom-nav__icon"><span data-icon="cart"></span><span class="icon-btn__badge" data-cart-count hidden>0</span></span>
      <span>Cart</span>
    </button>
  </nav>

  <div class="overlay" data-overlay></div>
  <aside class="drawer drawer--left" data-menu aria-label="Menu">
    <div class="drawer__head">
      <img src="${STORE.logo}" alt="${STORE.name}" class="drawer__logo" />
      <button class="icon-btn" data-close aria-label="Close"><span data-icon="close"></span></button>
    </div>
    <div class="drawer__body">
      <ul class="drawer__nav">
        ${NAV.map((n) => `<li><a href="${n.href}" data-close class="${n.id === page ? "is-active" : ""}">${n.label}</a></li>`).join("")}
      </ul>
      <h4 class="drawer__label">Categories</h4>
      <ul class="drawer__cats" data-drawer-cats></ul>
    </div>
  </aside>

  <aside class="drawer drawer--right" data-cart aria-label="Shopping cart">
    <div class="drawer__head">
      <h3>Your Cart <span class="muted" data-cart-items-label></span></h3>
      <button class="icon-btn" data-close aria-label="Close"><span data-icon="close"></span></button>
    </div>
    <div class="drawer__body" data-cart-body></div>
    <div class="drawer__foot" data-cart-foot>
      <div class="cart-total"><span>Subtotal</span><strong data-cart-subtotal>৳0</strong></div>
      <button class="btn btn--primary btn--block btn--lg" data-checkout>Proceed to Checkout</button>
    </div>
  </aside>

  <aside class="drawer drawer--right" data-wishlist aria-label="Wishlist">
    <div class="drawer__head">
      <h3>Wishlist</h3>
      <button class="icon-btn" data-close aria-label="Close"><span data-icon="close"></span></button>
    </div>
    <div class="drawer__body" data-wishlist-body></div>
  </aside>

  <div class="modal" data-modal role="dialog" aria-modal="true" aria-labelledby="modal-title" hidden>
    <div class="modal__box">
      <button class="icon-btn modal__close" data-close aria-label="Close"><span data-icon="close"></span></button>
      <div class="modal__content" data-modal-content></div>
    </div>
  </div>

  <div class="speed-dial" data-speed-dial>
    <div class="speed-dial__actions">
      <a href="tel:${STORE.phoneLink}" class="speed-dial__action" style="--c:#e31e24" aria-label="Call us"><span data-icon="phone"></span><em>Call us</em></a>
      <a href="https://wa.me/${STORE.whatsapp}" target="_blank" rel="noreferrer" class="speed-dial__action" style="--c:#25d366" aria-label="WhatsApp"><span data-icon="whatsapp"></span><em>WhatsApp</em></a>
      <a href="${STORE.facebook}" target="_blank" rel="noreferrer" class="speed-dial__action" style="--c:#1877f2" aria-label="Facebook"><span data-icon="facebook"></span><em>Facebook</em></a>
    </div>
    <button class="speed-dial__fab" data-speed-toggle aria-label="Contact options" aria-expanded="false"><span data-icon="chat"></span></button>
  </div>

  <button class="to-top" data-to-top aria-label="Back to top"><span data-icon="arrow-up"></span></button>
  <div class="toasts" data-toasts aria-live="polite"></div>`;

  document.body.insertAdjacentHTML("afterbegin", header);
  document.body.insertAdjacentHTML("beforeend", footer);

  const legalNav = document.querySelector("[data-legal-nav]");
  if (legalNav) {
    legalNav.innerHTML = LEGAL.map(
      (l) => `<li><a href="${l.href}" class="${l.id === page ? "is-active" : ""}">${l.label}</a></li>`
    ).join("");
  }
})();
