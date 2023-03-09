<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
protected $fillable=[
    'name',
];

    public function getCreatedAt()
    {
        return $this->created_at->format("d/M/y");
    }
}
