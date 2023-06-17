<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buruh extends Model
{
    use HasFactory;
    protected $table = 'buruhs';
    protected $guarded = [];

    public function pembayaran() {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id', 'id');
    }
}
