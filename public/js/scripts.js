$(function () {
    $('.datepicker').datetimepicker({
        language: 'pt-BR',
        pickTime: false
    });

    $('.datepickerTime').datetimepicker({
        language: 'pt-BR',
        pickTime: true
    });

//http://igorescobar.github.io/jQuery-Mask-Plugin/
    $(".data").mask('11/11/1111');
    $(".tel").mask('(00)0000-0000');
    $(".cpf").mask('000.000.000-00', {reverse: true});
    $(".rg").mask('000000000000-0', {reverse: true});
    $(".cep").mask('00000-000', {reverse: true});

    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.cel').mask(SPMaskBehavior, spOptions);

    /**
     * Retorna lista de pacientes com base no texto informado dinâmicamente
     * @param string
     * @return Json
     */
    var cache = {};
    $(".pacienteNome").autocomplete({
        minLength: 2,
        source: function (request, response) {
            var term = request.term;
            if (term in cache) {
                response(cache[term]);
                return;
            }
            $.post("/get-json/getPacientesJson", request, function (data, status, xhr) {
                cache[term] = data;
                response(data);
            });
        },
        select: function (event, ui) {
            this.value = ui.item.value;
            $('.pacienteId').val(ui.item.id);//Adiciona o id do paciente ao form

            return false;
        }
    });

    /**
     * Retorna lista de dentistas com base no texto informado dinâmicamente
     * @param string
     * @return Json
     */
    var cache = {};
    $(".dentistaNome").autocomplete({
        minLength: 2,
        source: function (request, response) {
            var term = request.term;
            if (term in cache) {
                response(cache[term]);
                return;
            }
            $.post("/get-json/getDentistasJson", request, function (data, status, xhr) {
                cache[term] = data;
                response(data);
            });
        },
        select: function (event, ui) {
            this.value = ui.item.value;
            $('.dentistaId').val(ui.item.id);//Adiciona o id do dentista ao form

            return false;
        }
    });

    /**
     * Alterna os inputs ativos na tela de consulta
     */
    $("#formConsulta #consultaPor").change(function () {

        switch ($(this).val()) {
            case 'paciente':
                $("#formConsulta #buscaPorTermo").children().attr('readonly', false);
                $("#formConsulta #buscaPorTermo").show();
                $("#formConsulta #buscaPorDataGroup").hide();
                break;
            case 'atendimento':
                $("#formConsulta #buscaPorTermo").hide();
                $("#formConsulta #buscaPorDataGroup").show();
                break;
            default:
                $("#formConsulta #buscaPorTermo").children().attr('readonly', true);
                $("#formConsulta #buscaPorTermo").show();
                $("#formConsulta #buscaPorDataGroup").hide();
        }

    });

    /**
     * Realiza consulta no banco de dados de acordo com o termo informado
     * @return Tabela com os dados populados
     */
    var dt = 0;
    $("#btBuscar").click(function () {

        var tipo = $("#formConsulta #consultaPor").val();
        var termo = $("#formConsulta #termo").val();
        var dtIni = $("#formConsulta #dataIni").val();
        var dtFim = $("#formConsulta #dataFim").val();

        $('#panelConsulta').hide();

        if (tipo == 'paciente') {
            var url = '/get-json/getPacientesJson';
            var data = 'param=' + termo;
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend: function () {
                $('#carregando').show();
            },
            success: function (ret) {
                var row;
                $.each(ret, function (key, value) {
                    row += "<tr><td>" + value['nome'] + "</td><td>" + value['data_nasc'] + "</td><td>" + value['matricula'] + "</td><td>" + value['campus'] + "</td><td><a class='btn btn-default' href='/" + value['id'] + "'><i class='fa fa-eye'></i> </a></td></tr>";
                });
                $('#carregando').hide();
                $('#panelConsulta').show();
                $("#tableResult").html(row);
                if (dt == 0) {
                    dataTable();
                }
                dt++;
            }
        });
    });

    /**
     * Habilita o plugin dataTable
     */
    function dataTable() {
        $('.dataTable').dataTable({
            "order": [],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }

        });
    }

});//<--Fim da function
