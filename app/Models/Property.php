<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'room_range_id', 'category_id', 'description', 'logo', 'address', 'country_id', 'user_id',
        'stars', 'opening_date', 'floor_number', 'experience', 'instagram', 'facebook', 'linkedin', 'youtube', 'twitter',
        'frontdesk_phone', 'frontdesk_email', 'reservation_phone', 'reservation_email', 'billing_email', 'state', 'city'
    ];

    public function scopeSearch($query, $val){

        if($val=== ''){
            return;
        }
            
        return $query->where('name', 'like', "%{$val}%");
                    
    }

    //Relación uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Relación uno a muchos inversa
    public function experiences(){
        return $this->belongsToMany(Experience::class);
    }

    //Relación uno a muchos inversa
    public function amenities(){
        return $this->belongsToMany(Amenity::class);
    }

    public function roomRange(){
        return $this->belongsTo(RoomRange::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    //Relacion uno a muchos
    public function rooms(){
        return $this->hasMany(Room::class);
    }

    //Relacion uno a muchos
    public function restaurants(){
        return $this->hasMany(Restaurant::class);
    }

    //Relacion uno a muchos
    public function mealPlans(){
        return $this->hasMany(MealPlan::class);
    }

    //Relacion uno a muchos
    public function ratePlans(){
        return $this->hasMany(RatePlan::class);
    }

    //Relacion uno a muchos
    public function documents(){
        return $this->hasMany(Document::class);
    }

    //Relacion uno a muchos
    public function photos(){
        return $this->hasMany(Photo::class);
    }
}
