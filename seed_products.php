<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;

$products = [
    // Category 1: Car Accessories
    [
        'category_id' => 1,
        'name' => 'Eco-Leather Dashboard Mat',
        'description' => 'Premium non-slip dashboard mat designed to protect your car\'s interior from UV rays and heat. Custom fit for most vehicles.',
        'price' => 29.99,
        'stock' => 50,
        'image' => 'eco_leather_dashboard_mat_1774254592373.png'
    ],
    [
        'category_id' => 1,
        'name' => 'High-Velocity Portable Car Vacuum',
        'description' => 'Compact and powerful 120W motor vacuum with HEPA filter, perfect for tackling dirt, dust, and crumbs in hard-to-reach areas.',
        'price' => 45.50,
        'stock' => 30,
        'image' => 'portable_car_vacuum_cleaner_1774254606013.png'
    ],
    [
        'category_id' => 1,
        'name' => 'Universal Magnetic Vent Mount',
        'description' => 'Sleek, high-strength magnetic phone holder that clips securely to any vent. Features 360-degree rotation for optimal viewing angles.',
        'price' => 14.99,
        'stock' => 100,
        'image' => 'magnetic_vent_mount_phone_holder_1774254620350.png'
    ],
    // Category 4: Electronics
    [
        'category_id' => 4,
        'name' => 'UltimaDrive 10" Android Head Unit',
        'description' => 'Upgrade your infotainment system with a 10-inch HD touchscreen, Wireless Apple CarPlay, Android Auto, and built-in GPS navigation.',
        'price' => 249.00,
        'stock' => 15,
        'image' => 'android_head_unit_10_inch_1774254636727.png'
    ],
    [
        'category_id' => 4,
        'name' => 'Guardian 4K Dual Dash Cam',
        'description' => 'Capture every detail in stunning 4K resolution. Includes a rear camera and G-sensor for automatic accident recording. Night vision enabled.',
        'price' => 129.99,
        'stock' => 20,
        'image' => 'dual_dash_cam_4k_front_rear_set_1774254656238.png'
    ],
    [
        'category_id' => 4,
        'name' => 'Elite OBD2 Wifi Scanner',
        'description' => 'Diagnoses engine codes, monitors real-time performance data, and clears Check Engine lights directly from your smartphone.',
        'price' => 34.00,
        'stock' => 40,
        'image' => 'obd2_wifi_scanner_diagnostic_tool_1774254675856.png'
    ],
    // Category 6: LED Lights
    [
        'category_id' => 6,
        'name' => 'NeonSync RGB Interior Lighting Kit',
        'description' => 'Customizable app-controlled LED strips for your car\'s interior. Choose from 16 million colors and sync with your favorite music.',
        'price' => 39.99,
        'stock' => 60,
        'image' => 'rgb_interior_lighting_kit_neon_1774254696969.png'
    ],
    [
        'category_id' => 6,
        'name' => 'CrystalVision H11 LED Headlight Bulbs',
        'description' => 'Ultra-bright 12000LM 6000K cool white bulbs with advanced cooling fans for maximum visibility and longevity. Plug-and-play installation.',
        'price' => 59.95,
        'stock' => 45,
        'image' => 'h11_led_headlight_bulbs_set_1774254715508.png'
    ],
    [
        'category_id' => 6,
        'name' => 'GLOW-TECH Underbody Underglow Kit',
        'description' => 'High-intensity exterior LED bars with multiple lighting modes and wireless remote. Weather-proof and durable construction.',
        'price' => 79.00,
        'stock' => 25,
        'image' => 'underglow_led_strip_kit_exterior_1774254732751.png'
    ],
    // Category 7: Car Parts
    [
        'category_id' => 7,
        'name' => 'Performance Ceramic Brake Pads (Front)',
        'description' => 'Low-dust, high-friction ceramic pads for superior stopping power and noise reduction. Engineered for performance and durability.',
        'price' => 85.00,
        'stock' => 20,
        'image' => 'performance_ceramic_brake_pads_pair_1774254752677.png'
    ],
    [
        'category_id' => 7,
        'name' => 'K&N Cold Air Intake System',
        'description' => 'Increase horsepower and torque with this high-flow air intake. Features a washable, reusable filter.',
        'price' => 310.00,
        'stock' => 10,
        'image' => 'kn_cold_air_intake_system_engine_1774254767534.png'
    ],
    [
        'category_id' => 7,
        'name' => 'Lowering Springs Pro-Kit (Set of 4)',
        'description' => 'Drop your vehicle\'s center of gravity for better handling and a more aggressive stance without compromising ride quality.',
        'price' => 220.00,
        'stock' => 8,
        'image' => 'lowering_springs_pro_kit_set_of_4_1774254783425.png'
    ],
];

foreach ($products as $pData) {
    $imageName = $pData['image'];
    unset($pData['image']);
    
    $pData['slug'] = Str::slug($pData['name']);
    $pData['brand_id'] = ($pData['category_id'] == 7) ? 4 : 1; // Assigning most to brand 1, Car parts to brand 4 (K&N)
    $pData['status'] = 1;
    $pData['sku'] = strtoupper(Str::random(10));
    
    $product = Product::create($pData);
    
    ProductImage::create([
        'product_id' => $product->id,
        'image_path' => 'products/' . $imageName,
        'is_primary' => true
    ]);
}

echo "Successfully added 12 products with images.";
