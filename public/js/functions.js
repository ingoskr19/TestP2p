$(document).ready(function () {

    $('#pagar').on('click', function () {
        $("#form_buying").attr("action", "/");

        if($("form")[0].checkValidity()) {
           $('#form_buying').submit();
           $('#cancelPay').click();
        }

    });

    setInterval(function(){
        verifyStatus();
    }, 420000);

    $('[data-newTransaccion="newTransaccion"]').on('click', function () {
        getBankList();
    });

    function verifyStatus(){

            $.ajax({
                type: "POST",
                url: '/verifyEstatus',
                data: '_token=' + $('#token').val(),
                datatype: "JSON",
                success: function (respuesta) {
                    console.log(respuesta);
                },
                error: function (response) {
                    console.log("Algo falló. por favor consulte con el administrador. o intente mas tarde");
                }
            });
    }

    function getBankList(){
        $('#loading').fadeIn();
        var currentdate = new Date();
        var hoy = currentdate.getDate() + "/" + (currentdate.getMonth()+1)  + "/" + currentdate.getFullYear();

        //&& getCookieText('last_request') === hoy
        if(getCookieText('last_request') !== undefined && getCookieJson('listBank') !== undefined && getCookieText('last_request') === hoy){
            options = "";
            data = getCookieJson('listBank');
            for (i = 0; i < data.length; i++) {
                options += '<option data-icon="glyphicon-home" value="' + data[i].bankCode + '">' + data[i].bankName + '</option>';
            }
            $('#loading').fadeOut();
            $("errorGetBankList").fadeOut();
            $('#banco').html(options);
            $('#banco').addClass('selectpicker');
            $('.selectpicker').selectpicker();
        } else {
            $.ajax({
                type: "POST",
                url: '/getBankList',
                data: '_token=' + $('#token').val(),
                datatype: "JSON",
                async: true,
                success: function (respuesta) {
                    data = eval(respuesta);
                    options = "";
                    for (i = 0; i < data.length; i++) {
                        options += '<option data-icon="glyphicon-home" value="' + data[i].bankCode + '">' + data[i].bankName + '</option>';
                    }
                    $('#banco').html(options);
                    $('#banco').addClass('selectpicker');
                    $('.selectpicker').selectpicker();
                    $('#banco').fadeIn();
                    $('#loading').fadeOut();
                    $("errorGetBankList").fadeOut();

                    //$('#grilla-lista-grupo').dataTable().fnAddData( [i+1,estudiantes[i].Estudiante.identificacion,estudiantes[i].Estudiante.apellido1+' '+estudiantes[i].Estudiante.apellido2+' '+estudiantes[i].Estudiante.nombre1+' '+estudiantes[i].Estudiante.nombre2]);
                    setCookieText('last_request',hoy,1);
                    setCookieJson('listBank',data,1);
                },
                error: function () {
                    $("errorGetBankList").fadeIn();
                    $('#loading').fadeOut();
                }
            });

        }
    }

    function getCookieText(nombre) {
    return $.cookie(nombre);
    }

    function setCookieText(nombre,valor,tiempo) {
        $.cookie(nombre, valor, { expires : tiempo });
    }

    function getCookieJson(nombre) {
        return JSON.parse($.cookie(nombre));
    }

    function setCookieJson(nombre,valor,tiempo) {
        $.cookie(nombre, JSON.stringify(valor), { expires : tiempo });
    }


    $('#popupNewTransaccion').on('show.bs.modal', function (event) {

    });

});
