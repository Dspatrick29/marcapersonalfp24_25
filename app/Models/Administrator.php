<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Administrator extends Model
{

    use HasFactory;

    protected $fillable = ['user_id',
'email'];

    /**
     * La función belongsTo se utiliza para establecer una relación de pertenencia
     * entre el modelo Administrator y otro modelo, indicando que cada instancia
     * de Administrator está asociada a una instancia de otro modelo.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
