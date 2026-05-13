<?php
$products = [
  [
  "id" => 0,
  "name" => "Grass-Fed Dog Food",
  "price" => 85.00,
  "category" => "Nutrition",
  "img" => "img/grass dog food.jpg",
  "description" => "A premium dry food made with grass-fed ingredients to support strong muscles, healthy digestion, and everyday energy for adult dogs.",
  "options" => [
    "size" => ["4 lb", "12 lb", "24 lb"]
  ],
  "option_prices" => [
    "size" => [
      "4 lb" => 85.00,
      "12 lb" => 145.00,
      "24 lb" => 220.00
    ]
  ]
],
  [
    "id" => 1,
    "name" => "Cat Toy Set",
    "price" => 22.00,
    "category" => "Play",
    "img" => "img/cat toy set.jpg",
    "description" => "A fun bundle of soft and interactive toys designed to keep cats active, curious, and entertained throughout the day.",
    "options" => [
      "color" => ["Pastel", "Bright", "Neutral"]
    ]
  ],
  [
    "id" => 2,
    "name" => "Interactive Cat Ball",
    "price" => 18.00,
    "category" => "Play",
    "img" => "img/cat ball.jpg",
    "description" => "A lightweight rolling toy that encourages chasing, batting, and independent play for energetic cats.",
    "options" => [
      "color" => ["Blue", "Pink", "Green"]
    ]
  ],
  [
    "id" => 3,
    "name" => "Soft Cat Bed",
    "price" => 35.00,
    "category" => "Home",
    "img" => "img/cat bed.jpg",
    "description" => "A plush and cozy bed with soft padding that gives cats a warm, secure place to nap and relax.",
    "options" => [
      "size" => ["Small", "Medium", "Large"],
      "color" => ["Cream", "Gray", "Blush"]
    ]
  ],
  [
    "id" => 4,
    "name" => "Dog Leash",
    "price" => 20.00,
    "category" => "Walk",
    "img" => "img/dog leash.jpg",
    "description" => "A durable everyday leash made for comfortable walks, reliable control, and easy handling.",
    "options" => [
      "color" => ["Black", "Blue", "Red"]
    ]
  ],
  [
    "id" => 5,
    "name" => "Dog Harness",
    "price" => 28.00,
    "category" => "Walk",
    "img" => "img/dog harness.jpg",
    "description" => "A supportive harness that helps distribute pressure more evenly for safer and more comfortable walks.",
    "options" => [
      "size" => ["Small", "Medium", "Large"],
      "color" => ["Black", "Sage", "Tan"]
    ]
  ],
  [
    "id" => 6,
    "name" => "Orthopedic Dog Bed",
    "price" => 40.00,
    "category" => "Home",
    "img" => "img/dog bed.jpg",
    "description" => "A supportive orthopedic bed designed to cushion joints and provide extra comfort for resting dogs.",
    "options" => [
      "size" => ["Medium", "Large", "XL"],
      "color" => ["Stone", "Navy", "Olive"]
    ]
  ],
  [
    "id" => 7,
    "name" => "Dog Toy Pack",
    "price" => 25.00,
    "category" => "Play",
    "img" => "img/dog toys.jpg",
    "description" => "A playful set of chew and toss toys made to keep dogs engaged, active, and mentally stimulated.",
    "options" => [
      "style" => ["Chew Set", "Fetch Set", "Mixed Set"]
    ]
  ],
  [
    "id" => 8,
    "name" => "Classic Pet Bed",
    "price" => 30.00,
    "category" => "Home",
    "img" => "img/bed.jpg",
    "description" => "A simple, comfortable pet bed that fits easily into any room and gives pets a soft place to rest.",
    "options" => [
      "size" => ["Small", "Medium", "Large"]
    ]
  ],
  [
    "id" => 9,
    "name" => "Stoneware Feeding Bowl",
    "price" => 18.00,
    "category" => "Feeding",
    "img" => "img/Stoneware Feeding Bowl.jpg",
    "description" => "A sturdy stoneware bowl with a clean modern look, ideal for serving food or water every day.",
    "options" => [
      "size" => ["Small", "Medium", "Large"],
      "color" => ["White", "Sand", "Charcoal"]
    ]
  ]
];

function getProductById($id, $products) {
  foreach ($products as $product) {
    if ((int)$product["id"] === (int)$id) {
      return $product;
    }
  }
  return null;
}

function formatPrice($price) {
  return "$" . number_format((float)$price, 2);
}
?>