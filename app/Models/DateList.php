<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DateList extends Model
{
    use SoftDeletes;

    public $table = 'date_lists';
    protected $primaryKey = 'id';
    public $fillable = ['date'];
    protected $dates = ['deleted_at'];

    public function todos()
    {
        return $this->hasMany(todo::class);
    }
}