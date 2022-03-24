<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'url',
        'content'
    ];

    // Page belong to user
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
