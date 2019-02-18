<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseRecord extends Model
{
    public $fillable = [
        'verified', 'level'
    ];

    const LEVELS = [
        'RINGAN' => 'Ringan',
        'SEDANG' => 'Sedang',
        'PARAH' => 'Parah'
    ];

    public function case_record_features()
    {
        return $this->hasMany(CaseRecordFeature::class);
    }

    public function scopeVerified($query)
    {
        $query->where('verified', 1);
    }
}
