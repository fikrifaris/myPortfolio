<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class todo extends Model
{
    use SoftDeletes;
    
    public $table = 'todos';
    protected $primaryKey = 'id';
    public $fillable = ['task', 'status', 'date_list_id'];
    protected $dates = ['deleted_at'];


     /**
     * Model Relationship Related Code
     *
     */
    public function date_lists()
    {
        return $this->belongsTo('DateList', 'id');
    }
}
