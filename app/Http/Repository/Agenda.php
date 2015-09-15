<?php

namespace App\Http\Repository;

use DB;

class Agenda
{
    const RESPONDERAM_PRE_E_POS     = true;
    const NAO_RESPONDERAM_PRE_E_POS = false;

    const ETAPA_PRE = 'pre';
    const ETAPA_POS = 'pos';

    const PERSONAL_PROFESSIONAL_COACHING_INTENSIVO = 20;
    const PERSONAL_PROFESSIONAL_COACHING           = 1;

    const EXECUTIVE_COACHING_INTENSIVO = 19;
    const EXECUTIVE_COACHING           = 2;

    const XTREME_COACHING_INTENSIVO = 21;
    const XTREME_COACHING           = 7;

    /**
     * @param $curso
     * @return mixed
     */
    public static function getAgendasByCurso($curso, $data, $diasCarencia)
    {
        $idScriptsPre = implode(', ', self::getIdScriptByCurso($curso, [Agenda::ETAPA_PRE]));
        $idScriptsPos = implode(', ', self::getIdScriptByCurso($curso, [Agenda::ETAPA_POS]));

        $idCursos = implode(', ', self::getIdCursosCorrelacionadosByCurso($curso));

        $query = "
                SELECT
                agenda.numreg AS numreg_agenda,
                agenda.id_curso,
                MAX(agenda_datas.dt_curso) AS dt_ultimo_dia,
                (
                  SELECT COUNT(DISTINCT id_pessoa) AS total
                  FROM c_coaching_inscricao_curso_detalhe
                  WHERE id_agenda = numreg_agenda
                ) AS total_inscritos,
                instrutor.nome_usuario AS instrutor,
                local_curso.nome_local_curso,
                IF (CURDATE() BETWEEN MIN(agenda_datas.dt_curso) AND MAX(agenda_datas.dt_curso), 'andamento', IF (MAX(agenda_datas.dt_curso) < CURDATE(), 'encerrado', 'aberto')) AS status_curso,
                (
                    SELECT COUNT(DISTINCT id_pessoa) AS total
                    FROM c_coaching_inscricao_curso_detalhe
                    WHERE id_agenda = numreg_agenda
                ) AS total_inscritos,
                (
                    SELECT COUNT( DISTINCT curso_detalhe.id_pessoa )
                    FROM c_coaching_inscricao_curso_detalhe as curso_detalhe
                   INNER JOIN is_pessoa as pessoa
                    ON curso_detalhe.id_pessoa = pessoa.numreg
                   INNER JOIN is_script_agendamento as agendamento
                    ON agendamento.id_pessoa = pessoa.numreg
                   INNER JOIN c_coaching_agenda_curso as curso
                    ON curso.numreg = agendamento.id_agenda
                   WHERE curso.id_curso IN ($idCursos)
                    AND agendamento.id_script IN ($idScriptsPre)
                    AND curso_detalhe.id_agenda = numreg_agenda
                    AND agendamento.id_situacao = 4
                    ORDER BY pessoa.razao_social_nome ASC
                ) AS responderam_pre,
                (
                    SELECT COUNT( DISTINCT curso_detalhe.id_pessoa )
                    FROM c_coaching_inscricao_curso_detalhe as curso_detalhe
                   INNER JOIN is_pessoa as pessoa
                    ON curso_detalhe.id_pessoa = pessoa.numreg
                   INNER JOIN is_script_agendamento as agendamento
                    ON agendamento.id_pessoa = pessoa.numreg
                   INNER JOIN c_coaching_agenda_curso as curso
                    ON curso.numreg = agendamento.id_agenda
                   WHERE curso.id_curso IN ($idCursos)
                    AND agendamento.id_script IN ($idScriptsPos)
                    AND curso_detalhe.id_agenda = numreg_agenda
                    AND agendamento.id_situacao = 4
                    ORDER BY pessoa.razao_social_nome ASC
                ) AS responderam_pos
                FROM c_coaching_agenda_curso AS agenda

                INNER JOIN is_usuario AS instrutor
                ON instrutor.numreg = agenda.id_instrutor

                INNER JOIN c_coaching_local_curso AS local_curso
                ON local_curso.numreg = agenda.id_local_curso

                INNER JOIN c_coaching_agenda_curso_detalhe AS agenda_datas
                ON agenda_datas.id_agenda_curso = agenda.numreg

                WHERE agenda.id_curso = :idCurso
                AND agenda_datas.dt_curso >= '$data'
                GROUP BY agenda.numreg
                ORDER BY dt_ultimo_dia DESC, agenda_datas.numreg DESC;";

//        HAVING CURDATE() > (dt_ultimo_dia + INTERVAL $diasCarencia DAY)

        return DB::select($query, ['idCurso' => $curso]);
    }

    public static function getAlunosByAgendaNumreg($agendaNumreg, $isScriptsPre, $idScriptsPos)
    {
        $sql = "SELECT
                    DISTINCT curso_detalhe.id_pessoa,
                    pessoa.razao_social_nome AS nome_aluno,
                    IF(agendamento_pre.numreg IS NULL, 'sem_agendamento_pre', IF(agendamento_pre.id_situacao = 4, 'realizado', 'pendente')) AS pre_agendamento,
                    IF(agendamento_pos.numreg IS NULL, 'sem_agendamento_pos', IF(agendamento_pos.id_situacao = 4, 'realizado', 'pendente')) AS pos_agendamento
                FROM c_coaching_inscricao_curso_detalhe AS curso_detalhe

                INNER JOIN is_pessoa AS pessoa
                ON pessoa.numreg = curso_detalhe.id_pessoa

                LEFT JOIN is_script_agendamento AS agendamento_pre
                ON agendamento_pre.id_pessoa = curso_detalhe.id_pessoa AND agendamento_pre.id_script IN ($isScriptsPre)

                LEFT JOIN is_script_agendamento AS agendamento_pos
                ON agendamento_pos.id_pessoa = curso_detalhe.id_pessoa AND agendamento_pos.id_script IN ($idScriptsPos)

                WHERE curso_detalhe.id_agenda = $agendaNumreg
                ORDER BY pessoa.razao_social_nome ASC";

        return DB::select(DB::raw($sql));
    }

    public static function getIdScriptsByAgenda($agendaNumreg, $etapa)
    {
        $sql = "SELECT script.numreg AS id_script
                FROM c_coaching_agenda_curso AS agenda_curso
                INNER JOIN c_coaching_curso AS curso
                ON curso.numreg = agenda_curso.id_curso
                INNER JOIN is_script AS script
                ON script.curso = curso.curso
                WHERE agenda_curso.numreg = $agendaNumreg
                AND script.etapa = '".$etapa."';";

        return DB::select($sql);
    }

    public static function getAgendas($curso = null, $data = '0000-00-00', $carenciaDias = 0)
    {
        $sql = "
        SELECT agenda.numreg AS numreg_agenda
        FROM c_coaching_agenda_curso AS agenda
        INNER JOIN c_coaching_agenda_curso_detalhe AS agenda_datas
        ON agenda_datas.id_agenda_curso = agenda.numreg
        WHERE agenda.id_curso = :idCurso
        AND agenda_datas.dt_curso >= :data
        GROUP BY agenda.numreg
        HAVING CURDATE() > (MAX(agenda_datas.dt_curso) + INTERVAL :carenciaDias DAY)
        ORDER BY agenda_datas.numreg DESC;";

        $result = DB::select($sql, ['idCurso' => $curso, 'data' => $data, 'carenciaDias' => $carenciaDias]);

        $agendasIn = [];
        foreach($result as $agenda)  {
            $agendasIn[] = $agenda->numreg_agenda;
        }

        return $agendasIn;
    }

    public static function getAlunosInscritosAgendas($agendas)
    {
        $agendasIn = implode(', ', $agendas);

        $sql = "
        SELECT DISTINCT curso_detalhe.id_pessoa AS numreg
        FROM c_coaching_inscricao_curso_detalhe AS curso_detalhe
        INNER JOIN is_pessoa AS pessoa
        ON curso_detalhe.id_pessoa = pessoa.numreg
        WHERE curso_detalhe.id_agenda IN (
            $agendasIn
        )
        GROUP BY curso_detalhe.id_pessoa
        ORDER BY pessoa.razao_social_nome ASC;";

        $result = DB::select($sql);

        $pessoasNumreg = [];
        foreach($result as $agenda)  {
            $pessoasNumreg[] = $agenda->numreg;
        }

        return $pessoasNumreg;
    }

    /**
     * Retorna os alunos que responderam o pré e o pós.
     */
    public static function getAlunosConsolidados($idPessoas, $idScripts = [], $responderamPreEPos = true)
    {
        $idPessoasIn = implode(', ', $idPessoas);
        $idScriptsIn = implode(', ', $idScripts);

        $consolidado = ($responderamPreEPos == true) ? " = 4" : "IS NULL";

        $sql = "
        SELECT id_pessoa FROM (
            SELECT
            agendamento.id_pessoa,
            COUNT(1) AS total
            FROM is_script_agendamento AS agendamento
            WHERE id_pessoa IN (
                $idPessoasIn
            )
            AND agendamento.id_script IN (
              $idScriptsIn
            )
            AND agendamento.id_situacao $consolidado
            GROUP BY agendamento.id_pessoa
            HAVING total > 1
        ) AS pessoas_que_responderam_os_dois;";

        $result = DB::select($sql);

        $pessoasNumreg = [];
        foreach($result as $agenda)  {
            $pessoasNumreg[] = $agenda->id_pessoa;
        }

        return $pessoasNumreg;
    }

    public static function getIdScriptByCurso($curso, $etapas = [])
    {
        $idScriptsIn = "'" . implode("', '", $etapas) . "'";

        $sql = "
        SELECT script.numreg AS id_script
        FROM c_coaching_curso AS curso
        INNER JOIN is_script AS script
        ON script.curso = curso.curso
        WHERE curso.numreg = :idCurso
        AND script.etapa IN (
            $idScriptsIn
        );";

        $results = DB::select($sql, ['idCurso' => $curso]);

        $idScripts = [];
        foreach($results as $result) {
            $idScripts[] = $result->id_script;
        }

        return $idScripts;
    }

    public static function getIdCursosCorrelacionadosByCurso($curso)
    {
        $sql = "
        SELECT curso_2.numreg
        FROM c_coaching_curso AS curso
        INNER JOIN c_coaching_curso AS curso_2
        ON curso.curso = curso_2.curso
        WHERE curso.numreg = :idCurso;";

        $results = DB::select($sql, ['idCurso' => $curso]);

        $idCursos = [];
        foreach($results as $result) {
            $idCursos[] = $result->numreg;
        }

        return $idCursos;
    }

    public static function graficoLinhaProgressaoRespondidos($alunosInscritos, $scripts = [])
    {
        $alunosInscritosIn = "'" . implode("', '", $alunosInscritos) . "'";
        $scriptsIn = implode(', ', $scripts);

        $sql = "
        SELECT
        IF (
            DATE_FORMAT(data_respondido, '%Y-%m-%d') = '0000-00-00',
            '2015-08-28',
            DATE_FORMAT(data_respondido, '%Y-%m-%d')
        ) AS date,
        COUNT(1) AS value
        FROM is_script_agendamento
        WHERE id_pessoa IN (
            #Alunos inscritos na turma
            $alunosInscritosIn
        )
        AND id_script IN (
            #Scripts de pré e pós
            $scriptsIn
        )
        AND id_situacao = 4
        GROUP BY DATE_FORMAT(data_respondido, '%Y-%m-%d')
        ORDER BY date ASC;";

        $result = DB::select($sql);

        $qtdRespondidos = 0;
        foreach($result as $chave => $dadoGrafico) {
            $qtdRespondidos += $dadoGrafico->value;
            $result[$chave]->value = $qtdRespondidos;
        }

        return $result;
    }

    public static function getUltimosScriptsRespondidos($alunos = [], $scripts = [])
    {
        $alunosIn  = implode(', ', $alunos);
        $scriptsIn = implode(', ', $scripts);

        $sql = "
        SELECT
            pessoa.razao_social_nome,
            agendamento.nome_agendamento,
            IF (
                DATE_FORMAT(data_respondido, '%Y-%m-%d') = '0000-00-00',
                '2015-08-28 00:00:00',
                DATE_FORMAT(data_respondido, '%Y-%m-%d %H:%i:%s')
            ) AS data_respondido
        FROM is_script_agendamento AS agendamento
        INNER JOIN is_pessoa AS pessoa
        ON pessoa.numreg = agendamento.id_pessoa
        WHERE agendamento.id_pessoa IN (
          $alunosIn
        )
        AND agendamento.id_script IN (
          $scriptsIn
        )
        AND agendamento.id_situacao = 4
        ORDER BY agendamento.data_respondido DESC;";

        return DB::select($sql);
    }

    public static function getTodosScriptsByAlunosAndScripts($alunos = [], $scripts = [])
    {
        $alunosIn = implode(', ', $alunos);
        $scriptsIn = implode(', ', $scripts);

        $sql = "
        SELECT *
        FROM is_script_agendamento
        WHERE id_pessoa IN (
            $alunosIn
        )
        AND id_script IN (
            $scriptsIn
        )
        ORDER BY id_pessoa ASC;";

        return DB::select($sql);
    }

    public static function getDadosGraficoQuestao($idQuestao)
    {
        $sql = "
        SELECT
            resposta.numreg,
            resposta.id_pergunta,
            resposta.resposta,
            COUNT(realizado.id_resposta) AS total
        FROM is_script_resposta AS resposta
        LEFT JOIN is_script_realizado AS realizado
        ON resposta.numreg = realizado.id_resposta
        AND realizado.id_pessoa IN (268416, 269175, 273337, 275039)
        WHERE resposta.id_pergunta = $idQuestao
        GROUP BY resposta.numreg
        ORDER BY resposta.ordem ASC;";

        return DB::select($sql);
    }

    public static function getDataInicioFimProgressao($agendaNumreg)
    {
        $sql = "
        SELECT
            DATE_FORMAT(agenda_detalhe.dt_curso, '%Y-%m-%d') AS data_inicio_progressao,
            DATE_FORMAT(MAX(agenda_detalhe.dt_curso + INTERVAL 30 DAY), '%Y-%m-%d') AS data_fim_progressao
        FROM c_coaching_agenda_curso_detalhe AS agenda_detalhe
        WHERE id_agenda_curso = $agendaNumreg;";

        return DB::select($sql)[0];
    }

}