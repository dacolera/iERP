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
        },
        retornaTipo : function(item) {
            var tipo = $(item).attr('tipo');
            var subject = '';
            switch(tipo) {
                case 'emp' : subject = 'empresa'; break;
                case 'dep' : subject = 'departamento'; break;
                case 'func': subject = 'funcionario'; break;
                case 'proc': subject = 'procedimento'; break;
                case 'tar' : subject = 'tarefa'; break;
            }
            return {"tipo":tipo,"subject":subject};
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

    //suspender ajax
    
    $('tbody').on('click', '.suspender', function(e){
        e.preventDefault();
        var tipo = App.retornaTipo(this).tipo;
        var subject = App.retornaTipo(this).subject;
        
        var id = $(this).attr(tipo);
        var status = $('.status-'+tipo+'-'+id).text() == 'Ativa' ? 'Inativa' : 'Ativa';
        
        App.modalConfirm('Tem certeza que deseja mudar o status para '+status+' ?', function(){
            $.ajax({
                url: '/ierp/public/'+subject+'/suspender-ativar-toogle/' + id +'/'+ status,
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.status == 'ok') {
                        $('.status-'+tipo+'-'+id).text(status);
                    }
                }
            });
        });       
    });

    $('tbody').on('click', '.deletar', function(e) {
       e.preventDefault();
       self = this;
       App.modalConfirm('Tem certeza que deseja deletar esse registro ?', function(){
            window.location.href = $(self).attr('href');
       });
    });
    
    $('tbody').on('click', 'tr td:first-child', function(){
        $('#detalhe').modal('show');
    });

    $('input[type=file]').change(function(e){
        $('span.'+$(this).attr('id')).text(e.target.files[0].name);
    });
});
