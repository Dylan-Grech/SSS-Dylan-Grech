<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];
    
    /**
     * Relation established between college and studets. A college can have many students
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
