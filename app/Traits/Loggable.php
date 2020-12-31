<?php

namespace App\Traits;

use App\Models\Admin;

trait Loggable {
    public function initializeLoggable(){

        $this->fillable = array_merge($this->fillable, ['created_by', 'updated_by', 'deleted_by']);

        static::creating(function($model){
            $model->created_by = auth()->guard('admin')->id();
        });

        static::updating(function($model){
            $model->updated_by = auth()->guard('admin')->id();
        });

        static::saving(function($model){
            if($model->exists){
                $model->updated_by = auth()->guard('admin')->id();
            }
            else{
                $model->created_by = auth()->guard('admin')->id();
            }
        });

        static::deleting(function($model){
            $model->deleted_by = auth()->guard('admin')->id();
            $model->save();
        });

    }

    public function creator(){
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater(){
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function remover(){
        return $this->belongsTo(Admin::class, 'deleted_by');
    }
}
