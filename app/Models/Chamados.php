<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    use HasFactory;

    protected $table = 'chamados';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'titulo',
        'descricao',
        'resposta',
        'anexo',
        'status'
    ];

    public static function listagem($limit, $offset, $search, $sort, $order)
    {
        try {

            $total = self::count();

            $chamados = self::offset($offset);

            if(!empty($search)){
                $chamados = $chamados->whereRaw("(upper(titulo) LIKE upper('%{$search}%'))
                                                or (upper(status) LIKE upper('%{$search}%'))
                                                or (TO_CHAR(criacao, 'DD/MM/YYYY HH:MI:SS') LIKE '%{$search}%')");
            }

            $chamados = $chamados->limit($limit)->orderBy($sort, $order)->get();
    
            return ["total" => $total, "rows" => $chamados];

        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        } 
    }
}
