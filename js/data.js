const SERVER = window.BUYBARI_CATALOG || null;

const STORE = SERVER?.store || {
  name: "Buybari",
  tagline: "Everything your bari needs: home, kitchen, gadgets, fashion and food, delivered to your door anywhere in Bangladesh.",
  logo: "images/logo.png",
  phone: "+880 1777-012681",
  phoneLink: "+8801777012681",
  whatsapp: "8801777012681",
  email: "contactus@buybari.com",
  address: "Dhaka, Bangladesh",
  facebook: "https://www.facebook.com/share/1CRT4Dpc91/",
  hours: "Saturday to Thursday, 10:00 AM to 8:00 PM",
  deliveryInsideDhaka: 70,
  deliveryOutsideDhaka: 130,
};

const SLIDES = SERVER?.slides || [
  {
    image: "images/banners/client-1.jpeg",
    alt: "Buybari: everything you need, one place",
    plain: true,
    href: "#products",
  },
  {
    image: "images/banners/client-2.jpeg",
    alt: "Welcome to Buybari",
    plain: true,
    href: "#products",
  },
];

const CATEGORIES = SERVER?.categories || [
  { name: "Home Decor", icon: "sofa" },
  { name: "Home & Kitchen", icon: "kitchen" },
  { name: "Electronics", icon: "plug" },
  { name: "Smart Gadgets", icon: "watch" },
  { name: "Men's Fashion", icon: "shirt" },
  { name: "Women's Fashion", icon: "dress" },
  { name: "Kids' Fashion", icon: "kid" },
  { name: "Life Style", icon: "sparkle" },
  { name: "Groceries & Food", icon: "food" },
  { name: "Bath & Hardware", icon: "wrench" },
];

const SECTIONS = SERVER?.sections || [
  { id: "hot", title: "Hot Products", badge: "hot" },
  { id: "discount", title: "Discount Products", badge: "discount" },
  { id: "new", title: "New Arrival Products", badge: "new" },
  { id: "regular", title: "Regular Products", badge: "feature" },
];

// [image, name, price, old price, category, rating, reviews, description]
const RAW = {
  hot: [
    ["vase-set", "Handmade Ceramic Vase Set (3 pcs)", 1250, 1550, "Home Decor", 5, 48, "A trio of hand-thrown ceramic vases in cream, terracotta and red. Perfect for dried flowers or as standalone decor on shelves and tables."],
    ["earbuds", "Pro Wireless Earbuds with ENC", 1450, 1900, "Smart Gadgets", 5, 126, "Bluetooth 5.3 earbuds with environmental noise cancellation, 30 hours total playback with the case and touch controls."],
    ["frying-pan", "Granite Non-Stick Frying Pan 26cm", 990, 1250, "Home & Kitchen", 5, 73, "PFOA-free granite coating, induction compatible base and a cool-touch wood-look handle. Cooks evenly with less oil."],
    ["panjabi", "Premium Cotton Panjabi (Maroon)", 1850, 2200, "Men's Fashion", 5, 64, "Soft, breathable cotton panjabi with tone-on-tone embroidery on the collar and placket. Available in M, L, XL and XXL."],
    ["three-piece", "Embroidered Cotton Three Piece", 2250, 2650, "Women's Fashion", 5, 91, "Unstitched cotton three piece with floral hand-embroidery on the kameez and a printed matching dupatta."],
    ["smartwatch", "Smart Fitness Watch with Calling", 2490, 2990, "Smart Gadgets", 4, 57, "1.85\" HD display, Bluetooth calling, heart-rate and SpO2 tracking, 100+ sports modes and up to 7 days battery."],
    ["bottle", "Insulated Steel Water Bottle 1L", 650, 800, "Life Style", 5, 112, "Double-wall vacuum insulation keeps drinks cold for 24 hours or hot for 12. Leak-proof steel cap with carry loop."],
    ["desk-lamp", "Rechargeable LED Desk Lamp", 1150, 1400, "Electronics", 4, 39, "Foldable arm, 3 color temperatures, stepless dimming and a 2000mAh battery. Eye-friendly light for study and work."],
  ],
  discount: [
    ["kids-set", "Kids Cotton T-Shirt & Shorts Set", 590, 850, "Kids' Fashion", 5, 44, "Comfortable 100% cotton tee with leaf print and soft navy shorts. Sizes for ages 2 to 10."],
    ["kettle", "Electric Kettle 1.8L (Red)", 1290, 1650, "Home & Kitchen", 5, 88, "1500W fast boil, stainless steel base, auto shut-off and boil-dry protection. Brews tea for the whole family."],
    ["honey", "Natural Wildflower Honey 500g", 650, 850, "Groceries & Food", 5, 203, "Raw, unprocessed honey collected from wildflower farms. No added sugar or preservatives."],
    ["towels", "Premium Cotton Bath Towel Set (3 pcs)", 890, 1200, "Home Decor", 4, 51, "Thick, absorbent and quick-drying cotton towels in coral, orange and cream."],
  ],
  new: [
    ["charger", "20W Type-C Fast Charger with Cable", 580, 750, "Electronics", 5, 97, "PD 20W fast charging adapter with a 1m USB-C cable. Charges compatible phones up to 50% in 30 minutes. 6 month warranty."],
    ["speaker", "Portable Bluetooth Speaker (Orange)", 1350, 1650, "Electronics", 5, 62, "Rich bass, IPX6 water resistance, 12-hour battery and a detachable strap for outdoor trips."],
    ["handbag", "Structured Leather Tote Bag (Red)", 1690, 2100, "Women's Fashion", 5, 38, "Spacious PU leather tote with gold hardware, inner zip pocket and sturdy double handles."],
    ["backpack", "Kids School Backpack", 990, 1250, "Kids' Fashion", 5, 29, "Lightweight, water-resistant backpack with padded straps and a front organiser pocket."],
    ["bedsheet", "Floral Cotton Bedsheet Set (King)", 1450, 1800, "Home Decor", 5, 76, "King size pure cotton bedsheet with two matching pillow covers. Colorfast print that stays bright wash after wash."],
    ["dry-fruits", "Premium Mixed Dry Fruits & Nuts 500g", 890, 1050, "Groceries & Food", 5, 134, "Almonds, cashews, pistachios, walnuts, golden raisins and dates, freshly packed."],
    ["hijab", "Georgette Hijab Set (3 pcs)", 450, 600, "Women's Fashion", 4, 85, "Soft, lightweight georgette hijabs in coral, peach and mustard. Easy to style and breathable."],
    ["sneakers", "Men's Casual Low-Top Sneakers", 1990, 2400, "Men's Fashion", 4, 47, "Leather and suede upper with a cushioned insole and durable rubber sole. Sizes 39 to 44."],
  ],
  regular: [
    ["faucet", "Chrome Basin Mixer Faucet", 1600, 1900, "Bath & Hardware", 5, 22, "Solid brass body with a mirror chrome finish, ceramic cartridge and hot/cold single lever control."],
    ["containers", "Glass Food Storage Container Set (4 pcs)", 1100, 1350, "Home & Kitchen", 5, 58, "Borosilicate glass containers with airtight snap-lock lids. Microwave, oven and freezer safe."],
    ["tiffin", "Stainless Steel 3-Tier Tiffin Box", 750, 950, "Life Style", 5, 66, "Food-grade stainless steel tiffin carrier with secure side clips. Ideal for office and school lunches."],
    ["wall-clock", "Minimal Wooden Wall Clock 12\"", 950, 1200, "Home Decor", 4, 31, "Silent sweep movement, natural wood frame and a clean cream dial with orange markers."],
  ],
};

const PRODUCTS = SERVER?.products ? SERVER.products.slice() : [];
if (!SERVER) {
  SECTIONS.forEach((section) => {
    RAW[section.id].forEach(([file, name, price, oldPrice, category, rating, reviews, description]) => {
      PRODUCTS.push({
        id: file,
        name,
        image: `images/products/${file}.jpg`,
        price,
        oldPrice: oldPrice > price ? oldPrice : 0,
        category,
        section: section.id,
        badge: section.badge,
        rating,
        reviews,
        description,
        variants: [],
      });
    });
  });
}
