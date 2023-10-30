<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class CmsPages extends Model
{
	use Sluggable;
	public function sluggable(): array
    {
        return [
            'page_slug' => [
                'source' => 'meta_title'
            ]
        ];
    }
    protected $table = 'cms_pages';
}
