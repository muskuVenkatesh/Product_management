<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the full URL for the product image or return a fallback graphic.
     */
    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&auto=format&fit=crop&q=80';
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        }

        return asset('storage/'.$this->image);
    }

    /**
     * Get stock status label text.
     */
    public function getStockStatusTextAttribute(): string
    {
        if ($this->quantity <= 0) {
            return 'Out of Stock';
        }

        if ($this->quantity <= 5) {
            return 'Low Stock';
        }

        return 'In Stock';
    }

    /**
     * Get CSS badge class for stock status.
     */
    public function getStockBadgeClassAttribute(): string
    {
        if ($this->quantity <= 0) {
            return 'bg-danger-subtle text-danger border border-danger-subtle';
        }

        if ($this->quantity <= 5) {
            return 'bg-warning-subtle text-warning-emphasis border border-warning-subtle';
        }

        return 'bg-success-subtle text-success border border-success-subtle';
    }
}
