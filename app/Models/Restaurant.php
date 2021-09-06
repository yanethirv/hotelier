<?php

namespace App\Models;

use App\Http\Livewire\Admin\RestaurantThemes\RestaurantThemeTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'property_id', 'restaurant_theme_id', 'restaurant_type_id', 'restaurant_location_id', 'how_many_pax',
        'open_time', 'closing_time', 'included'
    ];

    public function scopeSearch($query, $val){
        return $query
            ->where('name','like','%'.$val.'%')
            ;
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function restaurantTheme(){
        return $this->belongsTo(RestaurantTheme::class);
    }

    public function restaurantType(){
        return $this->belongsTo(RestaurantType::class);
    }

    public function restaurantLocation(){
        return $this->belongsTo(RestaurantLocation::class);
    }

}
