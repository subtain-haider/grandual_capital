<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'p_subscriptions';

    public function users()
    {
        return $this->hasMany(User::class, 'p_subscription_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
