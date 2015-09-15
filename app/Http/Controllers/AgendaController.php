<?php

namespace App\Http\Controllers;

use App\Http\Repository\Agenda;
use App\Http\Repository\QuestionarioCertificacao;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use ProjetoCertificacao\DataReport;

class AgendaController extends Controller
{
    public function index()
    {
//        $ppcIntensivo = Agenda::getAgendasPPCIntensivo();
//        return view('agenda.detalhe_agenda')
//            ->with(compact('agendasIntensivas'));
    }

    public function agenda($agendaNumreg)
    {
        // Pega e formata os idScripts para pré da agenda
        $idScriptsPre = [];
        $arrayScriptsPre = Agenda::getIdScriptsByAgenda($agendaNumreg, Agenda::ETAPA_PRE);
        foreach($arrayScriptsPre as $result) {
            $idScriptsPre[] = $result->id_script;
        }
        $scriptsPre = implode(', ', $idScriptsPre);

        // Pega e formata os idScripts para pré da agenda
        $idScriptsPos = [];
        $arrayScriptsPos = Agenda::getIdScriptsByAgenda($agendaNumreg, Agenda::ETAPA_POS);
        foreach($arrayScriptsPos as $result) {
            $idScriptsPos[] = $result->id_script;
        }
        $scriptsPos = implode(', ', $idScriptsPos);

        $alunosInscritosByAgenda = Agenda::getAlunosInscritosAgendas([$agendaNumreg]);

        $gruposPerguntasPre        = QuestionarioCertificacao::getGruposPerguntasByIdScript($scriptsPre);
        $gruposPerguntasPos        = QuestionarioCertificacao::getGruposPerguntasByIdScript($scriptsPos);
        $alunos                    = Agenda::getAlunosByAgendaNumreg($agendaNumreg, $scriptsPre, $scriptsPos);
        $totalScriptsAgendamento   = count(Agenda::getTodosScriptsByAlunosAndScripts($alunosInscritosByAgenda, [$scriptsPre, $scriptsPos]));
        $ultimosScriptsRespondidos = Agenda::getUltimosScriptsRespondidos($alunosInscritosByAgenda, [$scriptsPre, $scriptsPos]);
        $datasProgressao           = Agenda::getDataInicioFimProgressao($agendaNumreg);
        $alunosConsolidados        = Agenda::getAlunosConsolidados($alunosInscritosByAgenda, array_merge($idScriptsPre, $idScriptsPos), Agenda::RESPONDERAM_PRE_E_POS);
        $dadosGrafico              = json_encode(Agenda::graficoLinhaProgressaoRespondidos($alunosInscritosByAgenda, [$scriptsPre, $scriptsPos]));


        return view('agenda.alunos_agenda')
            ->with(compact('alunos'))
            ->with(compact('dadosGrafico'))
            ->with(compact('scriptsPre'))
            ->with(compact('scriptsPos'))
            ->with(compact('gruposPerguntasPre'))
            ->with(compact('gruposPerguntasPos'))
            ->with(compact('ultimosScriptsRespondidos'))
            ->with('dataProgressaoFinal', $datasProgressao->data_fim_progressao)
            ->with('dataProgressaoInicial', $datasProgressao->data_inicio_progressao)
            ->with(compact('totalScriptsAgendamento'))
            ->with(compact('alunosConsolidados'));
    }

    public function dashboard()
    {}

    public function ppc()
    {
        $nomeAgenda             = 'PPC';

        $agendasIntensivas      = Agenda::getAgendasByCurso(
            Agenda::PERSONAL_PROFESSIONAL_COACHING_INTENSIVO,
            //Carbon::parse('2014-09-05'),
            Carbon::parse('0000-00-00'),
            0
        );
        $totalAgendasIntensivas = count($agendasIntensivas);

        $agendasNormais         = Agenda::getAgendasByCurso(
            Agenda::PERSONAL_PROFESSIONAL_COACHING,
            //Carbon::parse('2014-09-05'),
            Carbon::parse('0000-00-00'),
            0
        );
        $totalAgendasNormais    = count($agendasNormais);

        return view('agenda.detalhe_agenda')
            ->with('tituloDashboard', $nomeAgenda)
            ->with(compact('nomeAgenda'))
            ->with(compact('agendasIntensivas'))
            ->with(compact('totalAgendasIntensivas'))
            ->with(compact('agendasNormais'))
            ->with(compact('totalAgendasNormais'));
    }

    public function executive()
    {
        $nomeAgenda = 'EXECUTIVE';

        $agendasIntensivas = Agenda::getAgendasByCurso(
            Agenda::EXECUTIVE_COACHING_INTENSIVO,
            //Carbon::parse('2014-09-05'),
            Carbon::parse('0000-00-00'),
            0
        );
        $totalAgendasIntensivas = count($agendasIntensivas);

        $agendasNormais = Agenda::getAgendasByCurso(
            Agenda::EXECUTIVE_COACHING,
            //Carbon::parse('2014-09-05'),
            Carbon::parse('0000-00-00'),
            0
        );
        $totalAgendasNormais = count($agendasNormais);

        return view('agenda.detalhe_agenda')
            ->with('tituloDashboard', $nomeAgenda)
            ->with(compact('nomeAgenda'))
            ->with(compact('agendasIntensivas'))
            ->with(compact('totalAgendasIntensivas'))
            ->with(compact('agendasNormais'))
            ->with(compact('totalAgendasNormais'));
    }

    public function xtreme()
    {
        $nomeAgenda = 'XTREME';

        $agendasIntensivas = Agenda::getAgendasByCurso(
            Agenda::XTREME_COACHING_INTENSIVO,
            //Carbon::parse('2014-09-05'),
            Carbon::parse('0000-00-00'),
            0
        );
        $totalAgendasIntensivas = count($agendasIntensivas);

        $agendasNormais = Agenda::getAgendasByCurso(
            Agenda::XTREME_COACHING,
            //Carbon::parse('2014-09-05'),
            Carbon::parse('0000-00-00'),
            0
        );
        $totalAgendasNormais    = count($agendasNormais);

        return view('agenda.detalhe_agenda')
            ->with('tituloDashboard', $nomeAgenda)
            ->with(compact('nomeAgenda'))
            ->with(compact('agendasIntensivas'))
            ->with(compact('totalAgendasIntensivas'))
            ->with(compact('agendasNormais'))
            ->with(compact('totalAgendasNormais'));
    }

    public function dadosGraficoQuestao($idQuestao)
    {
        return Agenda::getDadosGraficoQuestao($idQuestao);
    }

}
