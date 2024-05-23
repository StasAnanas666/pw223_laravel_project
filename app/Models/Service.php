<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "services";
    protected $fillable = ["name", "price", "image", "description", "created_at", "updated_at"];

    public function additionalServices() {
        return $this->hasMany(AdditionalService::class);
    }
}
