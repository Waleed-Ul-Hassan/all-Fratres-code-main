<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   @foreach($industries as $industry)
    <url>
        <loc>{{url('jobs/'.$industry->industry_slug)}}</loc>
        <lastmod>{{gmdate('Y-m-d\TH:i:s+00:00', strtotime($industry->updated_at))}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
   @endforeach
   @foreach($locations as $location)
    <url>
        <loc>{{url('jobs/in-'.$location->city_slug)}}</loc>
        <lastmod>{{gmdate('Y-m-d\TH:i:s+00:00', strtotime($location->updated_at))}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
   @endforeach
   @foreach($blogs as $blog)
    <url>
        <loc>{{url('career-advice/'.$blog->slug)}}</loc>
        <lastmod>{{gmdate('Y-m-d\TH:i:s+00:00', strtotime($blog->updated_at))}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
   @endforeach



</urlset>