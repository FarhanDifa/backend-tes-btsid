<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Checklist extends Model
{
    use SoftDeletes;
    protected $table = 'checklist';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'description',
        'is_completed',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }

    public function loadFillable($input = [])
    {
        if (count($input) == 0) {
            return false;
        }

        foreach (Schema::getColumnListing($this->table) as $attribute) {
            if (array_key_exists($attribute, $input)) {
                $this->$attribute = $input[$attribute];
            }
        }

        return true;
    }

    public static function query($params = [])
    {
        $query = parent::query()->with('items');

        if (@$params['id'] !== null) {
            $query->where('id', '=', $params['id']);
        }

        $query->whereNull('deleted_at');

        return $query;
    }
}
