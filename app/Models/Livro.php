<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    /**
        * The attributes that are mass assignable.
        *
        * @var string[]
    */
    protected $fillable = [
        'nome',
        'categoria',
        'codigo',
        'autor',
        'ebook',
        'tamanho_arquivo',
        'peso',
        'pessoa_id',
    ];

    public $timestamps = true;

    public function pessoa(){
        return $this->belongsTo('App\Models\Pessoa');
    }
}
