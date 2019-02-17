<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseRecordFeature extends Model
{
    public $fillable = [
        'case_record_id', 'feature_id', 'value'
    ];
}
