<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [ // função que trata a propriedade items como array, entrou na model, será tratado como array
        "items" => "array"
    ];

    protected $dates = ["date"]; // dizendo para o laravel sobre o novo campo de datas presente

    protected $guarded = []; // Permiti atualizações feitas com formulários POST / Ao colocar algum campo dentro
    //do array, fará com que esse campo não seja atualizado - Situação causada pelo método all() no update

    public function user(){ // Este método serve para dizer que o evento pertence a UM  / one to Many
        return $this->belongsTo("App/Models/User");
    }

    public function users() // Evento possui muitos u
    {
        return $this->belongsToMany("App\Models\user");
    }
}
