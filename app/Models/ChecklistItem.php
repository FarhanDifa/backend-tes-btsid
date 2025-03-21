<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class ChecklistItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['checklist_id', 'title', 'description', 'is_completed'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
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
        $query = parent::query();

        if (@$params['id'] !== null) {
            $query->where('id', '=', $params['id']);
        }
        
        if (@$params['checklist_id'] !== null) {
            $query->where('checklist_id', '=', $params['checklist_id']);
        }

        $query->whereNull('deleted_at');

        return $query;
    }
}
