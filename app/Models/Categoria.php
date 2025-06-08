<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable; // Importa a interface Auditable
use OwenIt\Auditing\Auditable as AuditableTrait; // Importa a trait Auditable

class Categoria extends Model implements Auditable // Implementa a interface Auditable
{
    use HasFactory, AuditableTrait; // Usa a trait AuditableTrait para ativar a auditoria

    // Define os atributos que podem ser preenchidos em massa (mass assignable)
    protected $fillable = ['nome']; // O campo 'nome' é permitido para preenchimento em massa

    // Opcional: Define um relacionamento com Postagem, se uma categoria pode ter várias postagens
    // Isso é útil para futuras funcionalidades, como listar postagens de uma categoria.
    public function postagens()
    {
        return $this->hasMany(Postagem::class, 'categoria_id', 'id');
    }

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class, 'categoria_id', 'id');
    }
}
