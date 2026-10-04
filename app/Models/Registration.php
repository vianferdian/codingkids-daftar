<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'birth_date',
        'category',
        'school',
        'parent_name',
        'parent_phone',
        'address',
        'registered_at',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'registered_at' => 'datetime',
        ];
    }

    /**
     * Get formatted category label (SD / SMP)
     */
    public function getCategoryLabelAttribute(): string
    {
        return strtoupper($this->category);
    }

    /**
     * Get class package name based on category
     */
    public function getPackageNameAttribute(): string
    {
        return $this->category === 'sd' ? 'Code & Play (SD)' : 'Code & Explore (SMP)';
    }

    /**
     * Get class description
     */
    public function getPackageDescriptionAttribute(): string
    {
        return $this->category === 'sd' 
            ? 'Belajar coding dengan animasi interaktif, game mini, dan debugging dasar' 
            : 'Belajar coding dengan desain 3D game dan script dasar';
    }
}
