@extends('store.layout')

@section('content')
<section class="page-hero">
    <div class="container">
      <nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span>/</span><span>Payment Policy</span></nav>
      <h1>Payment Policy</h1>
      <p>Simple, secure ways to pay, including cash when your parcel arrives.</p>
    </div>
  </section>

  <main class="container page legal">
    <aside class="legal__nav" aria-label="Policies"><ul data-legal-nav></ul></aside>

    <article class="legal__body prose">
      <p class="legal__updated">Last updated: October 12, 2026</p>

      <p>Buybari offers several payment options so you can shop the way that suits you best. This policy explains each method, delivery charges and what to expect when paying.</p>

      <h2>1. Accepted payment methods</h2>
      <ul>
        <li><strong>Cash on Delivery (COD):</strong> available across all 64 districts. Pay the delivery person in cash after you receive and check your parcel.</li>
        <li><strong>bKash, Nagad &amp; Rocket:</strong> pay instantly from your mobile wallet. Our team will share the merchant number and reference when confirming your order.</li>
        <li><strong>Debit &amp; credit cards:</strong> Visa and Mastercard payments through a secure payment gateway (where available).</li>
      </ul>

      <h2>2. Delivery charges</h2>
      <ul>
        <li>Inside Dhaka city: <strong>৳70</strong></li>
        <li>Outside Dhaka: <strong>৳130</strong></li>
      </ul>
      <p>Delivery charges may differ for heavy or bulky items, and any difference will be confirmed with you before dispatch. The total payable amount is always shown in your order summary.</p>

      <h2>3. Advance payment</h2>
      <p>For some orders, such as high-value items, bulky products, custom orders or deliveries to certain remote areas, we may request the delivery charge or a partial payment in advance. We will always tell you before confirming your order, and any advance paid is fully refundable if we cannot fulfil the order.</p>

      <h2>4. Paying by mobile wallet</h2>
      <ol class="steps">
        <li>Place your order on the website and choose your preferred payment method.</li>
        <li>Our team will call or message you to confirm the order and share our official payment number.</li>
        <li>Send the payment and use your order number as the reference.</li>
        <li>Share the transaction ID with us. Once verified, your order will be processed for dispatch.</li>
      </ol>

      <div class="callout">
        <span data-icon="shield"></span>
        <div><strong>Stay safe:</strong> Buybari will <strong>never</strong> ask for your PIN, OTP or card password. Only send payments to numbers confirmed by our official hotline <a href="tel:+8801777012681">+880 1777-012681</a>. If you are unsure, call us first.</div>
      </div>

      <h2>5. Payment security</h2>
      <p>Card payments are handled by certified payment gateways using industry-standard encryption. Buybari does not store your card number, PIN or wallet credentials.</p>

      <h2>6. Pricing &amp; currency</h2>
      <p>All prices are in Bangladeshi Taka (৳). The amount you pay is the product price shown at checkout plus the applicable delivery charge. There are no hidden fees.</p>

      <h2>7. Failed or duplicate payments</h2>
      <p>If money was deducted but your order was not confirmed, or if you were charged twice, please contact us with the transaction ID. After verification, the extra amount will be refunded within 5-7 working days.</p>

      <h2>8. Refunds</h2>
      <p>Refunds for returns or cancellations are handled according to our <a href="/refund">Refund &amp; Return Policy</a>.</p>

      <h2>9. Questions?</h2>
      <p>Call <a href="tel:+8801777012681">+880 1777-012681</a>, email <a href="mailto:contactus@buybari.com">contactus@buybari.com</a> or message us on <a href="https://www.facebook.com/share/1CRT4Dpc91/" target="_blank" rel="noreferrer">Facebook</a>.</p>
    </article>
  </main>
@endsection
