<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'dob', 'college_id'];

    /**
     * Relation established between student and college. A student can only be assigned to one college
     */
    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
