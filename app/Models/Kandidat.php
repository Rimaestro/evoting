<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $table = 'kandidat';

    protected $fillable = [
        'nama_ketua',
        'nama_wakil',
        'foto',
        'visi',
        'misi',
        'nomor_urut',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
