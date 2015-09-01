//main application js file

 var App = (function($, document, undefined){

     var validations = {
         email : function(field){
            return /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i.test($(field).val());
         },
         cnpj : function(field){
             var i = 0,
                 l = 0;
                strNum = "",
                strMul = "0000000000000",
                character = "",
                iValido = 1,
                iSoma = 0,
                strNum_base = "",
                iLenNum_base = 0,
                iLenMul = 0,
                iSoma = 0,
                strNum_base = 0,
                iLenNum_base = 0,
                cnpj = $(field).val();

             if (cnpj == "")
                 return false;

             l = cnpj.length;
             for (i = 0; i < l; i++) {
                 caracter = cnpj.substring(i,i+1)
                 if ((caracter >= '0') && (caracter <= '9'))
                     strNum = strNum + caracter;
             };

             if(strNum.length != 14)
                 return false;

             strNum_base = strNum.substring(0,12);
             iLenNum_base = strNum_base.length - 1;
             iLenMul = strMul.length - 1;
             for(i = 0;i < 12; i++)
                 iSoma = iSoma +
                 parseInt(strNum_base.substring((iLenNum_base-i),(iLenNum_base-i)+1),10) *
                 parseInt(strMul.substring((iLenMul-i),(iLenMul-i)+1),10);

             iSoma = 11 - (iSoma - Math.floor(iSoma/11) * 11);
             if(iSoma == 11 || iSoma == 10)
                 iSoma = 0;

             strNum_base = strNum_base + iSoma;
             iSoma = 0;
             iLenNum_base = strNum_base.length - 1
             for(i = 0; i < 13; i++)
                 iSoma = iSoma +
                 parseInt(strNum_base.substring((iLenNum_base-i),(iLenNum_base-i)+1),10) *
                 parseInt(strMul.substring((iLenMul-i),(iLenMul-i)+1),10)

             iSoma = 11 - (iSoma - Math.floor(iSoma/11) * 11);
             if(iSoma == 11 || iSoma == 10)
                 iSoma = 0;
             strNum_base = strNum_base + iSoma;
             if(strNum != strNum_base)
                 return false;
             return true;
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
            if($(field).hasClass('email')) {
                if(!validations.email(field)){
                    $(field).parents('.form-group').addClass('has-error');
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('cnpj')){
                if(!validations.cnpj(field)){
                    $(field).parents('.form-group').addClass('has-error');
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('cep')){
                if(!validations.cep(field)){
                    $(field).parents('.form-group').addClass('has-error');
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('login')){
                if(!validations.login(field)){
                    $(field).parents('.form-group').addClass('has-error');
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else if($(field).hasClass('senha')){
                if(!validations.senha(field)){
                    $(field).parents('.form-group').addClass('has-error');
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            } else {
                if(!validations.vazio(field)){
                    $(field).parents('.form-group').addClass('has-error');
                } else {
                    $(field).parents('.form-group').removeClass('has-error');
                }
            }
        },
        modalConfirm : function(msg, handler) {
           
            $('#confirm .modal-body').text(msg);
            $('#confirm').modal('show');
            $('#confirm .confirm-ok').unbind().click(handler);
        }
    };
 })(jQuery, document ? document : window);


$(function(){


    //login no sistema

    $("#login").click(function(){
        $("#myModal").modal();
    });

    var erros = 0;
    //submit form cadastrar empresa
    $('.emp-cad').click(function(e){

        e.preventDefault();

        $('#emp-cad-form input.obr').each(function(){
            App.valida(this);
        });

        erros = $('#emp-cad-form .has-error').length;

        if(erros > 0)
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
                        row += '<td>'+json[i].id+'</td>';
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
});
