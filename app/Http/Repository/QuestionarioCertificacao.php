<?php

namespace App\Http\Repository;

use DB;

class QuestionarioCertificacao
{

    # Primeiro select, verificamos os grupos de um script pré de ppc
    public static function getGruposPerguntasByIdScript($scripts)
    {
        $sql = "
        SELECT
            grupo_perguntas.numreg AS grupo_numreg,
            grupo_perguntas.ordem,
            grupo_perguntas.nome_grupo,
            grupo_perguntas.descricao
        FROM is_script_pergunta AS perguntas
        INNER JOIN is_grupo_de_pergunta AS grupo_perguntas
        ON grupo_perguntas.numreg = perguntas.id_grupo_pergunta
        WHERE perguntas.id_script IN ($scripts)
        GROUP BY perguntas.id_grupo_pergunta
        ORDER BY grupo_perguntas.ordem ASC;";

        return DB::select($sql);
    }

    public static function getPerguntasByScriptAndGrupo($scripts, $grupoPerguntas)
    {
        $sql = "
        SELECT
            GROUP_CONCAT(pergunta.numreg) AS numreg_pergunta,
            pergunta.pergunta,
            pergunta.ordem,
            pergunta.sn_obrigatorio,
            pergunta.descricao,
            tipo_pergunta.numreg AS numreg_tipo_pergunta,
            tipo_pergunta.nome_script_tipo_pergunta AS tipo_pergunta
        FROM is_script_pergunta AS pergunta
        INNER JOIN is_script_tipo_pergunta AS tipo_pergunta
        ON tipo_pergunta.numreg = pergunta.id_tipo
        WHERE pergunta.id_script IN ($scripts)
        AND pergunta.id_grupo_pergunta = $grupoPerguntas
        GROUP BY pergunta.pergunta
        ORDER BY pergunta.ordem ASC;";

        return DB::select($sql);
    }

    public static function getRespondidosByPessoasAndScriptsAndPergunta($idPessoas = [], $idScripts, $idPergunta, $tipoPergunta, $media = false)
    {
        $idPessoasIn = implode(', ', $idPessoas);

        switch($tipoPergunta) {
            case 8:
            case 7:
            case 11:
                $sql = "
                SELECT
                    alternativa_numerico.alternativa AS resposta,
                    COUNT(realizado.numreg) AS total
                FROM is_altervativas_para_numerico AS alternativa_numerico

                LEFT JOIN is_script_realizado AS realizado
                ON realizado.id_resposta = alternativa_numerico.alternativa
                AND realizado.id_pergunta IN ($idPergunta)
                AND realizado.id_pessoa IN ($idPessoasIn)
                AND realizado.id_script IN ($idScripts)

                WHERE alternativa_numerico.fk_numreg_tipo_pergunta = $tipoPergunta
                GROUP BY alternativa_numerico.alternativa
                ORDER BY alternativa_numerico.ordem ASC";

                if ($media) {
                    $sql = "
                    SELECT SUM(total)/".count($idPessoas)." AS media_total FROM (
                        SELECT
                        (alternativa_numerico.alternativa * COUNT(realizado.numreg)) AS total
                        FROM is_altervativas_para_numerico AS alternativa_numerico

                        LEFT JOIN is_script_realizado AS realizado
                        ON realizado.id_resposta = alternativa_numerico.alternativa
                        AND realizado.id_pergunta IN ($idPergunta)
                        AND realizado.id_pessoa IN ($idPessoasIn)
                        AND realizado.id_script IN ($idScripts)

                        WHERE alternativa_numerico.fk_numreg_tipo_pergunta = $tipoPergunta
                        GROUP BY alternativa_numerico.alternativa
                        ORDER BY alternativa_numerico.ordem ASC
                    ) AS total";
                }

                break;

            case 1:
                $sql = "
                SELECT
                    pessoa.razao_social_nome AS aluno,
                    realizado.nome_resposta AS resposta
                FROM is_script_realizado AS realizado

                INNER JOIN is_pessoa AS pessoa
                ON pessoa.numreg = realizado.id_pessoa

                WHERE realizado.id_pergunta IN ($idPergunta)
                AND realizado.id_pessoa IN ($idPessoasIn)
                AND realizado.id_script IN ($idScripts);";
                break;

            default:
                $sql = "
                SELECT
                    resposta.resposta,
                    COUNT(realizado.id_resposta) AS total
                FROM is_script_resposta AS resposta
                LEFT JOIN is_script_realizado AS realizado
                ON resposta.numreg = realizado.id_resposta
                AND realizado.id_pessoa IN ($idPessoasIn)
                AND realizado.id_script IN ($idScripts)
                WHERE resposta.id_pergunta IN ($idPergunta)
                GROUP BY resposta.numreg
                ORDER BY resposta.ordem ASC;";
                break;
        }

        return DB::select($sql);
    }

}