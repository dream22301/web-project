<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    const PRIORITY = [
        'normal' => 0,
        'info' => 1,
        'warning' => 2,
        'urgent' => 3,
    ];

    protected $fillable = [
        'title',
        'audience',
        'prioritas',
        'content',
        'publish_date',
    ];

    public function getPriorityLabelAttribute() {
        return self::PRIORITY[$this->prioritas];
    }
}
