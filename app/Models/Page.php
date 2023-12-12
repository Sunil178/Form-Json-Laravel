<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'number', 'schema', 'content' ];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $old = json_decode($model->getOriginal('schema'));
            $new = json_decode($model->schema);
            if ($old != $new) {
                $model->content = null;
            }
        });
    }
}
