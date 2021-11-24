<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    /**
        * The attributes that are mass assignable.
        *
        * @var string[]
    */
    protected $fillable = [
        'nome',
        'idade',
        'sexo'
    ];
    
    public $timestamps = true;

    public function livro(){
        return $this->hasOne('App\Models\Livro');
    }
}
