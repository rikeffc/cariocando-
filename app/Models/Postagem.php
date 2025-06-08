<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use OwenIt\Auditing\Contracts\Auditable;
    use OwenIt\Auditing\Auditable as AuditableTrait;

    class Postagem extends Model implements Auditable
    {
        use HasFactory, AuditableTrait;

        // Adicione esta linha para especificar explicitamente o nome da tabela
        protected $table = 'postagens';

        protected $fillable = [
            'titulo',
            'descricao',
            'categoria_id',
            'user_id',
        ];

        public function categoria()
        {
            return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
        }

        public function autor()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }
    }
