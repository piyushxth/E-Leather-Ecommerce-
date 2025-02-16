<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;

    protected $table='navbars';

    protected $fillable = [
        'name','slug','target','parent_id', 'route', 'ordering','status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function scopeAsc($query)
    {
        return $query->orderBy('ordering','asc');
    }

    
    public function navbars()
    {
        return $this->hasMany(Navbar::class, 'parent_id', 'id')->orderBy('ordering');
    }

    public function childrenNavbars()
     {
        return $this->hasMany(Navbar::class, 'parent_id', 'id')->with('navbars');
     }
}
