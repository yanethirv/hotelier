<?php

namespace App\Models;

use App\Http\Livewire\Admin\Occupancies\OccupancyTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'property_id', 'room_type_id', 'occupancy_id', 'floor', 'number', 'description', 'amount_extra_person',
        'late_check_out', 'early_check_in', 'day_pass_fee', 'night_pass_fee', 'roll_away_bed', 'pet_fee', 'rate_plan_id', 'rate'
    ];

    public function scopeSearch($query, $val){

        return $query
            ->where('code','like','%'.$val.'%')
            ;
    }

    //Relación uno a muchos inversa
    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function occupancy(){
        return $this->belongsTo(Occupancy::class);
    }

    public function roomType(){
        return $this->belongsTo(RoomType::class);
    }

    public function ratePlan(){
        return $this->belongsTo(RatePlan::class);
    }
}