<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'num_rooms', 'profile_photo_path', 'phone', 'country_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function scopeFilter($query, $search){

        if($search === ''){
            return;
        }

        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
    }

    //Mutator
    public function getRolAttribute(): string
    {
        if($this->role === 'superadmin'){
            return 'Super Admin';
        }

        return $this->role === 'admin' ? 'Administrator' : 'Client';
    }

    public function getAvatarAttribute(): string
    {

        return $this->profile_photo_path ?? 'img/avatars/default.jpg';
    }

    public function servicesTransactions() {
        return $this->hasMany(ServicesTransaction::class);
    }

    public function subscriptionsTransactions() {
        return $this->hasMany(SubscriptionsTransaction::class);
    }

    public function plansTransactions() {
        return $this->hasMany(PlansTransaction::class);
    }

    public function activationServiceTransactions() {
        return $this->hasMany(ActivationServiceTransaction::class);
    }

    //Relacion uno a muchos
    public function properties(){
        return $this->hasMany(Property::class);
    }

    // A user can send a message
    public function sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // A user can also receive a message
    public function received()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function feeInvoices() {
        return $this->hasMany(FeeInvoice::class);
    }

    public function marketplaceInvoices() {
        return $this->hasMany(Invoice::class);
    }

}
