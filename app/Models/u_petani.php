<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class u_petani extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'email',
        'telp',
        'nik',
        'jeniskelamin',
        'tanggallahir',
        'alamat'
    ];
    protected static function booted()
    {
        // Set nilai default untuk kolom yang diinginkan sebelum model disimpan
        static::creating(function ($model) {
            $model->setDefaults();
        });
    }
    public function setDefaults()
    {
        $this->attributes['telp'] = $this->attributes['telp'] ?? '';
        $this->attributes['nik'] = $this->attributes['nik'] ?? '';
        $this->attributes['tanggallahir'] = $this->attributes['tanggallahir'] ?? date('Y-m-d');
        $this->attributes['jeniskelamin'] = $this->attributes['jeniskelamin'] ?? 'laki-laki';
        $this->attributes['alamat'] = $this->attributes['alamat'] ?? '';
    }
}
