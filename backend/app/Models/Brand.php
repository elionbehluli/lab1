<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'country_of_origin',
        'logo_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function deleteLogo($id)
    {
        if(Storage::disk('public')->exists($this->logo_url)){
            Storage::disk('public')->delete($this->logo_url);
        }
    }

}
