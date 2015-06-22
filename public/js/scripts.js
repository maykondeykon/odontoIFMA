$(function () {
    $('.datepicker').datetimepicker({
        language: 'pt-BR',
        pickTime: false
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
     * Retorna lista de pacientes com base no texto informado
     * @param string
     * @return Json
     */
    var cache = {};
    $( ".pacienteNome" ).autocomplete({
        minLength: 2,
        source: function( request, response ) {
            var term = request.term;
            if ( term in cache ) {
                response( cache[ term ] );
                return;
            }
            $.post( "/get-json/getPacientesJson", request, function( data, status, xhr ) {
                cache[ term ] = data;
                response( data );
            });
        },
        select : function(event, ui) {
            this.value = ui.item.value;
            $('.pacienteId').val(ui.item.id);//Adiciona o id do paciente ao form

            return false;
        }
    });

});//<--Fim da function

$(document).ready(function() {
    $('.dataTable').dataTable( {
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


    } );
} );
