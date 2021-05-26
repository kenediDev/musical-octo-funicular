<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $table = "accounts";
    protected $fillable = ['first_name', 'last_name', 'avatar', 'background', 'is_superuser', 'staff', 'user_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
