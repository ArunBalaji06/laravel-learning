<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
use function Illuminate\Events\queueable;
use Stripe\Customer;
use App\Models\Card;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];

    /**
     * Sync datas with stripe account automatically
     */
    protected static function booted()
    {
        static::updated(queueable(function ($customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }

    /**
     * Override the stripe automatic sync based on local DB columns
     * DB name column synced with stripe account name
     */
    public function stripeName()
    {
        return $this->name;
    }

    /**
     * Override the stripe automatic sync based on local DB columns
     * DB email column synced with stripe account email
     */
    public function stripeEmail()
    {
        return $this->email;
    }

        // /**
        //  * Override the stripe automatic sync based on local DB columns
        //  * DB phone column synced with stripe account phone
        //  */
        // public function stripePhone()
        // {
        //     return $this->phone;
        // }

        // /**
        //  * Override the stripe automatic sync based on local DB columns
        //  * DB address column synced with stripe account address
        //  */
        // public function stripeAddress()
        // {
        //     return $this->address;
        // }
        

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function card()
    {
        return $this->hasMany('App\Models\Card','user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction','user_id','id');
    }
}
