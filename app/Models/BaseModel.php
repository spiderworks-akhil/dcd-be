<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Schema, Auth;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaseModel extends Model {
    use Loggable;

    public static function boot() {
        parent::boot();
        $input = request()->all();
        static::creating(function ($model) {
            if(Schema::hasColumn($model->getTableName(), 'created_by')) {
                if($user = Auth::user())
                    $model->created_by = $user->id;
            }
        });
        
        static::saving(function ($model) {
            if(Schema::hasColumn($model->getTableName(), 'updated_by')) {
                if($user = Auth::user())
                    $model->updated_by = $user->id;
            }
            // return true;
        });
    }
    
    public static function getTableName() {
        return with(new static)->getTable();
    }

    public function created_user(): ?BelongsTo
    {
        if ($this->checkColumn('created_by')) return $this->belongsTo(Admin::class, 'created_by');
        return null;
    }

    public function updated_user(): ?BelongsTo
    {
        if ($this->checkColumn('updated_by')) return $this->belongsTo(Admin::class, 'updated_by');
        return null;
    }

    public function featured_image(): ?BelongsTo
    {
        if ($this->checkColumn('featured_image_id')) return $this->belongsTo(Media::class, 'featured_image_id');
        return null;
    }

    public function banner_image(): ?BelongsTo
    {
        if ($this->checkColumn('banner_image_id')) return $this->belongsTo(Media::class, 'banner_image_id');
        return null;
    }

    public function og_image(): ?BelongsTo
    {
        if ($this->checkColumn('og_image_id')) return $this->belongsTo(Media::class, 'og_image_id');
        return null;
    }

    protected function checkColumn($column){
        return Schema::hasColumn(static::getTableName(), $column);
    }

}
