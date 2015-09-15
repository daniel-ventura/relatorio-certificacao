@extends('index')

@section('content')

<div class="row">

    <div class="col-md-6">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">PPC INTENSIVO</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                <th>NUMREG</th>
                                <th>ALUNO</th>
                                <th>PRÉ</th>
                                <th>PÓS</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--@foreach($alunos as $aluno)--}}
                            {{--<tr>--}}
                                {{--<td>{{ $aluno->numreg }}</td>--}}
                                {{--<td>{{ $aluno->nome_aluno }}</td>--}}
                                {{--<td>--}}
                                    {{--@if($aluno->pre == 4)--}}
                                        {{--<span class="label label-sm label-success">Realizado</span>--}}
                                    {{--@else--}}
                                        {{--<span class="label label-sm label-default">Pendente</span>--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--@if($aluno->pos == 4)--}}
                                        {{--<span class="label label-sm label-success">Realizado</span>--}}
                                    {{--@else--}}
                                        {{--<span class="label label-sm label-default">Pendente</span>--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>



</div>

@stop

