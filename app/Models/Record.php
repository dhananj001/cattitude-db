<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'phone',
        'email',
        'reason',
        'charged',
        'comment',
        'added_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
