<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieExercice extends Model
{
    protected $table = 'serie_exercice';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'numserie' => 'int',
        'numexercice' => 'int',
        'position' => 'int',
        'repetitions' => 'int'
    ];

    public function exos()
    {
        return $this->belongsTo(Exercice::class, 'numexercice');
    }

}
