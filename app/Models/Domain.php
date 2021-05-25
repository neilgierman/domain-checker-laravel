<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $table = 'domains';
    public $timestamps = true;

    protected $fillable = [
        'domainName',
        'deliveredCount',
        'bouncedCount',
        'created_at'
    ];
}
