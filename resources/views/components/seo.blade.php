@props(['title' => null, 'description' => null, 'image' => null, 'product' => null])

@php
    $finalTitle = ($title ? $title . ' | ' : '') . 'AutoParts Hub - VIP Premium Components';
    $finalDescription = $description ?? 'Discover high-performance, platinum-grade automotive parts. Engineered for excellence, available for true enthusiasts.';
    $finalImage = $image ?? asset('images/og-default.jpg');
    $currentUrl = url()->current();
@endphp

<!-- Primary Meta Tags -->
<title>{{ $finalTitle }}</title>
<meta name="title" content="{{ $finalTitle }}">
<meta name="description" content="{{ $finalDescription }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $product ? 'product' : 'website' }}">
<meta property="og:url" content="{{ $currentUrl }}">
<meta property="og:title" content="{{ $finalTitle }}">
<meta property="og:description" content="{{ $finalDescription }}">
<meta property="og:image" content="{{ $finalImage }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $currentUrl }}">
<meta property="twitter:title" content="{{ $finalTitle }}">
<meta property="twitter:description" content="{{ $finalDescription }}">
<meta property="twitter:image" content="{{ $finalImage }}">

@if($product)
@php
    $productSchema = [
        '@context' => 'https://schema.org/',
        '@type' => 'Product',
        'name' => $product->name,
        'image' => [$finalImage],
        'description' => $finalDescription,
        'sku' => $product->sku ?? 'N/A',
        'brand' => [
            '@type' => 'Brand',
            'name' => $product->brand->name ?? 'Platinum Series'
        ],
        'offers' => [
            '@type' => 'Offer',
            'url' => $currentUrl,
            'priceCurrency' => 'USD',
            'price' => $product->price,
            'availability' => 'https://schema.org/InStock'
        ]
    ];
@endphp
<!-- JSON-LD for Search Engines -->
<script type="application/ld+json">
    {!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
