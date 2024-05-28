<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "services";
    protected $fillable = [
        "name", 
        "price", 
        "image", 
        "description",
        "user_id", 
        "created_at", 
        "updated_at"
    ];

    public function additionalServices() {
        return $this->hasMany(AdditionalService::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
