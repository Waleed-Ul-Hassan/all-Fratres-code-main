<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    //

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection('mysql_blog');
    }

    public function latest_posts()
    {
        $domain = getsubDomain();
        $domain = str_replace("/","", $domain);

        return $this->hasMany(Blog::class, 'blog_cat','slug')
                ->where('country', $domain)->groupBy('slug')
                ->where('status', 'Active')->latest()->limit(10);
    }

}
