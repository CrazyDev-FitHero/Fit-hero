<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    protected $table = 'exercice';

    public $primaryKey="numexercice";
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [

'numexercice' => 'int',
'codeexercice' => 'string',
'nomexercice' => 'string'
    ];
    public function serie()
    {
        return $this->belongsToMany(SerieExercice::class, 'numserie');
    }

}
