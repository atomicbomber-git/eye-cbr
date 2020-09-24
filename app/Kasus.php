<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    protected $table = "case_records";
    protected $guarded = [];

    const HASIL_DIAGNOSIS = [
        'GLAUKOMA' => 'Glaukoma',
        'KATARAK' => 'Katarak',
        'KONJUNGTIVITIS' => 'Konjungtivitis',
        'MIOPI' => 'Miopi',
        'HORDEOLUM' => 'Hordeolum',
    ];

    public function case_record_features()
    {
        return $this->hasMany(CaseRecordFeature::class, "case_record_id");
    }

    public function scopeVerified($query)
    {
        $query->where('verified', 1);
    }

    public function scopeUnverified($query)
    {
        $query->where('verified', 0);
    }
}
