<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DateList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'date_lists';
    protected $primaryKey = 'id';
    protected $fillable = ['date'];
    protected $dates = ['deleted_at'];
}
