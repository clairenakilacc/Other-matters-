<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Equipment extends Model
{
    use HasFactory;

    const ITEM_PREFIX = 'ITEM';
    const ITEM_COLUMN = 'Item_no';
    const PROPERTY_PREFIX = 'PROP';
    const PROPERTY_COLUMN = 'Property_no';
    const CONTROL_PREFIX = 'CTRL';
    const CONTROL_COLUMN = 'Control_no';

    protected $fillable = [
        'Unit_no',
        'Description',
        'Specifications',
        'Facility_id',
        'Category_id',
        'Status',
        'Date_acquired',
        'Supplier',
        'Amount',
        'Estimated_life',
        'Item_no',
        'Property_no',
        'Control_no',
        'Serial_no',
        'No_of_stocks',
        'Restocking_point',
        'Person_liable',
        'Remarks',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'Facility_id');
    }
}
