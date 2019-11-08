<?php

namespace App;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use Eloquence;

    protected $table = 'tag';
}
