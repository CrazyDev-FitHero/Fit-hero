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
        'nomexercice' => 'string',
        'gainexercice' => 'int'
    ];
    public function serie()
    {
        return $this->belongsToMany(SerieExercice::class, 'numserie');
    }

    public function getGifExerciceBase64()
    {
        return base64_encode($this->gifexercice);
    }

    public function getImageExerciceBase64()
    {
        // Assumes there is an 'imageexercice' BLOB column in the table
        return base64_encode($this->imageexercice);
    }

}
