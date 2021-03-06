<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['cnpj', 'logo', 'name', 'url', 'email', 'subscription', 'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
