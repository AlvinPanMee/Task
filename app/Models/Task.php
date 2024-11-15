<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';
    protected $guarded = ['id'];
    protected $fillable = ['task_id', 'title', 'description', 'status'];

    protected $hidden = ['id','task_id', 'deleted_at', 'created_at', 'updated_at'];

    const STATUS = [
        0 => 'completed',
        1 => 'open'
    ];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (int $status) => self::STATUS[$status],
        );
    }

}