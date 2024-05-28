<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    use HasFactory;

    protected $fillable = ["name", "price", "description", "service_id", "created_at", "updated_at"];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
