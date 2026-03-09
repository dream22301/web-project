<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    const PRIORITY = [
        0 => 'normal',
        1 => 'info',
        2 => 'warning',
        3 => 'urgent',
    ];

    protected $fillable = [
        'title',
        'audience',
        'prioritas',
        'content',
        'publish_date',
    ];
    protected $appends = ['priority_label'];

    public function getPriorityLabelAttribute() {
        return self::PRIORITY[$this->prioritas] ?? 'normal';
    }
}
