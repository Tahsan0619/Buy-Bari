@extends('store.layout')

@section('content')
<section class="page-hero">
    <div class="container">
      <nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span>/</span><span>Contact us</span></nav>
      <h1>We're here to help</h1>
      <p>Questions about a product, an order or a return? Reach out any way you like and our team will respond quickly.</p>
    </div>
  </section>

  <main class="container page">
    <section class="contact-cards">
      <a class="contact-card" href="tel:+8801777012681">
        <div class="value__icon"><span data-icon="phone"></span></div>
        <h3>Call us</h3>
        <p>+880 1777-012681</p>
      </a>
      <a class="contact-card" href="mailto:contactus@buybari.com">
        <div class="value__icon"><span data-icon="mail"></span></div>
        <h3>Email us</h3>
        <p>contactus@buybari.com</p>
      </a>
      <a class="contact-card" href="https://www.facebook.com/share/1CRT4Dpc91/" target="_blank" rel="noreferrer">
        <div class="value__icon"><span data-icon="facebook"></span></div>
        <h3>Facebook page</h3>
        <p>Message us on Facebook</p>
      </a>
      <div class="contact-card">
        <div class="value__icon"><span data-icon="pin"></span></div>
        <h3>Location</h3>
        <p>Dhaka, Bangladesh</p>
      </div>
    </section>

    <section class="contact-grid">
      <div class="panel">
        <h2>Send us a message</h2>
        <p>Fill in the form and we'll get back to you within 24 hours.</p>
        <form data-contact-form novalidate>
          <div class="field-row">
            <div class="field">
              <label for="ct-name">Your name *</label>
              <input id="ct-name" name="name" autocomplete="name" placeholder="Full name" />
            </div>
            <div class="field">
              <label for="ct-phone">Phone number *</label>
              <input id="ct-phone" name="phone" type="tel" inputmode="numeric" autocomplete="tel" placeholder="01XXXXXXXXX" />
            </div>
          </div>
          <div class="field-row">
            <div class="field">
              <label for="ct-email">Email (optional)</label>
              <input id="ct-email" name="email" type="email" autocomplete="email" placeholder="you@example.com" />
            </div>
            <div class="field">
              <label for="ct-subject">Subject</label>
              <select id="ct-subject" name="subject">
                <option>Product enquiry</option>
                <option>Order status</option>
                <option>Return or refund</option>
                <option>Bulk / corporate order</option>
                <option>Other</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label for="ct-message">Message *</label>
            <textarea id="ct-message" name="message" rows="5" placeholder="How can we help you?"></textarea>
          </div>
          <button type="submit" class="btn btn--primary btn--lg btn--block"><span data-icon="send"></span> Send message</button>
        </form>
      </div>

      <div>
        <div class="panel">
          <h2>Customer support hours</h2>
          <p class="muted" style="margin-bottom:12px">Phone and Facebook support</p>
          <div class="callout" style="margin:0">
            <span data-icon="clock"></span>
            <div>
              <strong>Saturday to Thursday</strong><br />10:00 AM to 8:00 PM<br />
              <span class="muted">Online orders are accepted 24/7.</span>
            </div>
          </div>
        </div>

        <div class="map">
          <iframe title="Buybari location in Dhaka, Bangladesh" src="https://maps.google.com/maps?q=Dhaka,%20Bangladesh&z=11&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </section>

    <section class="panel faq" style="margin-top:32px">
      <h2>Frequently asked questions</h2>
      <p>Quick answers to the questions we hear most.</p>
      <details>
        <summary>How long does delivery take?</summary>
        <p>Inside Dhaka, orders usually arrive within 1-2 working days. Outside Dhaka, delivery takes 2-5 working days depending on your location.</p>
      </details>
      <details>
        <summary>How much is the delivery charge?</summary>
        <p>Delivery costs ৳70 inside Dhaka and ৳130 outside Dhaka. The exact charge is shown in your order summary before you confirm.</p>
      </details>
      <details>
        <summary>Can I pay when I receive my order?</summary>
        <p>Yes. Cash on delivery is available all over Bangladesh. You can also pay with bKash, Nagad, Rocket or a debit/credit card.</p>
      </details>
      <details>
        <summary>What if my product is damaged or not as described?</summary>
        <p>Contact us within 7 days of delivery with your order number and a photo of the item. We will arrange a replacement or refund. See our <a href="/refund" style="color:var(--primary)">Refund &amp; Return Policy</a> for details.</p>
      </details>
      <details>
        <summary>How do I track my order?</summary>
        <p>After your order is dispatched, we'll send you an SMS with the courier details. You can also call us any time with your order number for an update.</p>
      </details>
    </section>
  </main>
@endsection
