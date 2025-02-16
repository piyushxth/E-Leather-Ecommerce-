<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc>{{route('home')}} </loc>
      <lastmod>{{$today}}</lastmod>
      <priority>0.1</priority>
   </url>

   <url>
      <loc>{{route('frontend.aboutus')}}</loc>
      <lastmod>{{ $today }}</lastmod>
      <priority>0.2</priority>
   </url>

   <url>
      <loc>{{route('frontend.blogs')}}</loc>
      <lastmod>{{ $today }}</lastmod>
      <priority>0.2</priority>
   </url>

   @if($blogs->isNotEmpty())
      @foreach($blogs as $blog)
      <url>
         <loc>{{ route('frontend.blog_details',[$blog->blog_slug]) }}</loc>
         <lastmod>{{ $today }}</lastmod>
         <priority>0.2</priority>
      </url>
      @endforeach
   @endif

   <url>
      <loc>{{route('frontend.brands')}}</loc>
      <lastmod>{{ $today }}</lastmod>
      <priority>0.2</priority>
   </url>

   @if($brands->isNotEmpty())
      @foreach($brands as $brand)
      <url>
         <loc>{{ route('frontend.brand_details',[$brand->slug]) }}</loc>
         <lastmod>{{ $today }}</lastmod>
         <priority>0.2</priority>
      </url>
      @endforeach
   @endif

   @if($categories->isNotEmpty())
      @foreach($categories as $category)
      <url>
         <loc>{{ route('category',[$category->slug]) }}</loc>
         <lastmod>{{ $today }}</lastmod>
         <priority>0.2</priority>
      </url>
      @endforeach
   @endif

   @if($products->isNotEmpty())
      @foreach($products as $product)
      <url>
         <loc>{{ route('main_product',[$product->slug]) }}</loc>
         <lastmod>{{ $today }}</lastmod>
         <priority>0.2</priority>
      </url>
      @endforeach
   @endif


   <url>
      <loc>{{route('contact')}}</loc>
      <lastmod>{{ $today }}</lastmod>
      <priority>0.2</priority>
   </url>


</urlset>