//main application js file

 var App = (function($, document, undefined){

     var validations = {
         email : function(field){
            return /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i.test($(field).val());
         },
         cnpj : function($value){
             $value = $($value).val().replace(/(\.|\-|\/)/g, '');

             //calcula o primeiro dígito verificador
             var $a = 0,
                 $i = $a ,
                 $d1 = $i,
                 $d2 = $d1,
                 $j = 5;

             for ($i=0; $i<12; $i++) {
                 $a += $value[$i] * $j;
                 ($j > 2) ? $j-- : $j = 9;
             }
             $a = $a % 11;
             ($a > 1) ? $d1 = 11 - $a : $d1 = 0;

             //calcula o segundo dígito verificador
             $a = $i = 0;
             $j = 6;
             for ($i=0; $i<13; $i++) {
                 $a += $value[$i] * $j;
                 ($j > 2) ? $j-- : $j = 9;
             }
             $a = ($a % 11);
             ($a > 1) ? $d2 = 11 - $a : $d2 = 0;

             return (($d1 == $value[12]*1) && ($d2 == $value[13]*1));
         },
         vazio : function(field){
            return $(field).val() != '';
         },
         cep : function(field){
            return /^\d{5}-\d{3}$/.test($(field).val());
         },
         login : function(field){
             return $(field).val().length >= 6;
         },
         senha : function(field){
             return $(field).val().length >= 6;
         }
     };

    return {
        valida : function(field){
            var erro = 0;
            if($(field).hasClass('email')) {
                if(!validations.email(field)){
                    $(field).parents('.form-group').addClass('has-error');
                    erro++;
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('cnpj')){
                if(!validations.cnpj(field)){
                    $(field).parents('.form-group').addClass('has-error');
                    erro++;
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('cep')){
                if(!validations.cep(field)){
                    $(field).parents('.form-group').addClass('has-error');
                    erro++;
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('login')){
                if(!validations.login(field)){
                    $(field).parents('.form-group').addClass('has-error');
                    erro++;
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('senha')){
                if(!validations.senha(field)){
                    $(field).parents('.form-group').addClass('has-error');
                    erro++;
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else {
                if(!validations.vazio(field)){
                    $(field).parents('.form-group').addClass('has-error');
                    erro++;
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            }
            return erro;
        },
        modalConfirm : function(msg, handler) {
           
            $('#confirm .modal-body').text(msg);
            $('#confirm').modal('show');
            $('#confirm .confirm-ok').unbind().click(handler);
        }
    };
 })(jQuery, document ? document : window);


$(function(){

    var url = window.location.href;
    if(url.indexOf('listar?')) {
        var query = url.split('listar')[1];
        var atual = $('.exportUrl').attr('href');
        $('.exportUrl').attr('href', atual+query);
    }
    
    $('.datepicker').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
    
    $('#cnpj').mask('99.999.999/9999-99');
    $('#cep').mask('99999-999');

    //login no sistema

    $("#login").click(function(){
        $("#myModal").modal();
    });

    //submit form cadastrar empresa
    $('.emp-cad').click(function(e){

        e.preventDefault();
        var erro = 0;
        $('#emp-cad-form input.obr').each(function(){
         erro  += App.valida(this);
        });
        

        if(erro > 0)
            return false;
        $('#emp-cad-form').submit();
    });

    $('#emp-cad-form input.obr').blur(function(){
         App.valida(this);
    });

    //ordenacao ajax
    $('#ordered > th[ord]').each(function(){

        $(this).on('click', function(){
            if($(this).attr('ord') == 'desc')
            {
                $('#ordered > th[ord] i').removeClass('fa-arrow-down').removeClass('fa-arrow-up');
                $(this).children('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
                $(this).attr('ord','asc');
            } else {
                $('#ordered > th[ord] i').removeClass('fa-arrow-down').removeClass('fa-arrow-up');
                $(this).children('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
                $(this).attr('ord','desc');
            }

            $.ajax({
                url : '/ierp/public/ordenar/'+$(this).attr('campo')+'/'+$(this).attr('ord'),
                success : function(data) {
                    var json = JSON.parse(data);
                    $('#emp_content').empty();
                    for (i in json) {
                        var status = json[i].status == "A" ? "Ativa" : "Inativa";
                        var row = '<tr>';
                        row += '<td><i class="fa fa-search"></i><a href="/ierp/public/detalhe/'+json[i].id+'">'+json[i].id+'</a></td>';
                        row += '<td>'+json[i].razao_social+'</td>';
                        row += '<td>'+json[i].cnpj+'</td>';
                        row += '<td>'+json[i].inscricao_municipal+'</td>';
                        row += '<td>'+json[i].inscricao_estadual+'</td>';
                        row += '<td>'+json[i].CNAE_principal+'</td>';
                        row += '<td>'+json[i].regime_tributacao+'</td>';
                        row += '<td>'+json[i].valor_honorarios+'</td>';
                        row += '<td>'+json[i].vencimento_honorarios+'</td>';
                        row += '<td class="text-center status-emp-'+json[i].usr_id+'">'+status+'</td>';
                        row += '<td class="text-center"><a href="/ierp/public/editar/'+json[i].id+'"><i class="fa fa-fw fa-edit"></i></a></td>';
                        row += '<td class="text-center deletar"><a href="/ierp/public/deletar/'+json[i].id+'"><i class="fa fa-fw fa-times"></i></a></td>';
                        row += '<td class="text-center suspender" emp="'+json[i].usr_id+'"><i class="fa fa-fw fa-lock"></i></td>';
                        row += '</tr>';
                        $('#emp_content').append(row);

                    }
                }
            });
        });
    });
    // fim da ordenacao ajax

    //suspender empresa ajax

    $('tbody').on('click', '.suspender', function(e){
        e.preventDefault();
        var id = $(this).attr('emp');
        var status = $('.status-emp-'+id).text() == 'Ativa' ? 'Inativa' : 'Ativa';

        App.modalConfirm('Tem certeza que deseja mudar o status dessa empresa para '+status+' ?', function(){
            $.ajax({
                url: '/ierp/public/suspender-ativar-toogle/' + id +'/'+ status,
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.status == 'ok') {
                        $('.status-emp-'+id).text(status);
                    }
                }
            });
        });       
    });

    $('tbody').on('click', '.deletar', function(e) {
       e.preventDefault();
       self = this;
       App.modalConfirm('Tem certeza que deseja deletar essa empresa ?', function(){
            window.location.href = $(self).find('a').attr('href');
       });
    });
    
    $('tbody').on('click', 'tr td:first-child', function(){
        $('#detalhe').modal('show');
    });

    $('input[type=file]').change(function(e){
        $('span.'+$(this).attr('id')).text(e.target.files[0].name);
    });
});
