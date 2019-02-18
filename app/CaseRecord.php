<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseRecord extends Model
{
    public $fillable = [
        'verified'
    ];

    public function case_record_features()
    {
        return $this->hasMany(CaseRecordFeature::class);
    }
}
