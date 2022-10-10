
function change_pages(page){
    if($("#account").val() != ""){
        switch (page) {
            case 'Deposito':
              html = '<section id="container" class="service-section"> <h2>Deposito</h2>  <div class="service-section-header">  <div class="search-field"> <input id="valor" min="1" type="number" placeholder="Digite o Valor a depositar"> </div><button id="depositar" onclick="deposito()" class="flat-button"> depositar</button> </div> </section>';
              $("#container").replaceWith(html);
              break;
            case 'Saque':
                html ='<section id="container" class="service-section"> <h2>Saque</h2>  <div class="service-section-header">  <div class="search-field"> <input id="valor" min="1" type="number"  placeholder="Digite o valor que deseja sacar"> </div><button  id="sacar" onclick="saque()"  class="flat-button"> Sacar</button> </div> </section>';
                $("#container").replaceWith(html);
                break;
            case 'Transferencia':
                html = '<section id="container" class="service-section"> <h2>Transferencia</h2>  <div class="service-section-header">  <div class="search-field"> <input id="numero_conta_transfer" min="1" type="number" placeholder="Numero da conta"> <input id="valor" min="1"  type="number" placeholder="Digite o valor que deseja transferir"> </div> <button id="trasferir" onclick="transferencia()"   class="flat-button"> Transferir </button> </div> </section>';
                $("#container").replaceWith(html);
                break;
            default:
                html = '<section id="container" class="service-section"> <h2>Home</h2> <h3>Seja Bem Vindo !</h3> </section>';
                break;
          }
    }else{
        Swal.fire({
            width: 250,
            background: '#fc3903',
            position: 'top-end',
            title: "entre com uma conta valida !",
            showConfirmButton: false,
            timer: 1500
        })
    } 
}

function changeacouunt(){
    Parameters = {"numero_conta" :  $("#account").val() };
    get_account(null,"ControllerAccount","selectAccount",Parameters)
}

function get_account(filename = null,className = null, FunctionName,Parameters){
    $.post({
        url: "/assets/php/Controllers/ControllerRequest.php",
        data: {filename : filename,className : className, FunctionName: FunctionName , data : Parameters},
        success: function (result) {
            if(result != null){
                var obj = jQuery.parseJSON( result );
                var valor =  (parseFloat(obj[0]["saldo"])).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD',
                  }).replace("$","")
                $("#saldo_conta").text(valor)
                $("#conta_id").text(obj[0]["conta_id"])
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                icon: 'warning',
                title: 'Não foi possivel encontrar sua conta deseja criar uma ?',
                showDenyButton: true,
                confirmButtonText: 'sim',
                denyButtonText: 'nao',
              }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'escolha o tipo da conta',
                        showDenyButton: true,
                        showCancelButton: true,
                        denyButtonColor: '#3341dd',
                        confirmButtonText: 'Corrente',
                        denyButtonText: 'Poupança',
                      }).then((result) => {
                        if (result.isConfirmed) {

                            Parameters = {
                                "tipo_conta" : "1",
                                "numero_conta": $("#account").val()
                            }

                            $.post({
                                url: "/assets/php/Controllers/ControllerRequest.php",
                                data: {filename : null,className : "ControllerAccount", FunctionName: "create_account" , data : Parameters},
                                success: function (result) {
                                    Swal.fire({
                                        background: '#34eb46',
                                        position: 'top-end',
                                        title: result,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                      changeacouunt()
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    $("#saldo_conta").text("0")
                                    $("#account").val("");
                                    $("#conta_id").text("")
                                    Swal.fire({
                                        background: '#fc3903',
                                        position: 'top-end',
                                        title: xhr.responseText,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            });
                        } else if (result.isDenied) {
                            Parameters = {
                                "tipo_conta" : "2",
                                "numero_conta": $("#account").val()
                            }
                            $.post({
                                url: "/assets/php/Controllers/ControllerRequest.php",
                                data: {filename : null,className : "ControllerAccount", FunctionName: "create_account" , data : Parameters},
                                success: function (result) {
                                    Swal.fire({
                                        background: '#34eb46',
                                        position: 'top-end',
                                        title: result,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    changeacouunt()
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    $("#saldo_conta").text("0")
                                    $("#account").val("");
                                    $("#conta_id").text("")
                                    Swal.fire({
                                        background: '#fc3903',
                                        position: 'top-end',
                                        title: xhr.responseText,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            });
                        }else{
                            $("#saldo_conta").text("0")
                            $("#account").val("");
                            $("#conta_id").text("")
                        }
                      })
                } else if (result.isDenied) {
                    $("#saldo_conta").text("0")
                    $("#account").val("");
                    $("#conta_id").text("")
                }
              })
     
        }
   });
}


function saque()
{
    Parameters = {"conta_id": $("#conta_id").text(),"numero_conta" :  $("#account").val(), "valor" : $("#valor").val() };
    saldo = parseFloat($("#saldo_conta").text().replace(",",""));
    valor = parseFloat($("#valor").val());
    if( saldo > valor ){
        $.post({
            url: "/assets/php/Controllers/ControllerRequest.php",
            data: {filename : null,className : "ControllerAccount", FunctionName: "saque" , data : Parameters},
            success: function (result) {
                Swal.fire({
                    background: '#34eb46',
                    position: 'top-end',
                    title: result,
                    showConfirmButton: false,
                    timer: 1500
                })
                $("#valor").val("")
                changeacouunt()
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    background: '#fc3903',
                    position: 'top-end',
                    title: xhr.responseText,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
       });
    }else{
        $("#valor").val("");
        Swal.fire({
            background: '#fc3903',
            position: 'top-end',
            title: "Não é possivel sacar um valor maior que o saldo !",
            showConfirmButton: false,
            timer: 1500
        })
    }
}

function deposito()
{
    Parameters = {"conta_id": $("#conta_id").text(),"numero_conta" :  $("#account").val(), "valor" : $("#valor").val() };
    $.post({
        url: "/assets/php/Controllers/ControllerRequest.php",
        data: {filename : null,className : "ControllerAccount", FunctionName: "deposito" , data : Parameters},
        success: function (result) {
            Swal.fire({
                background: '#34eb46',
                position: 'top-end',
                title: result,
                showConfirmButton: false,
                timer: 1500
            })
            $("#valor").val("")
            changeacouunt()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                background: '#fc3903',
                position: 'top-end',
                title: xhr.responseText,
                showConfirmButton: false,
                timer: 1500
            })
        }
   });

}

function transferencia()
{
    saldo = parseFloat($("#saldo_conta").text().replace(",",""));
    valor = parseFloat($("#valor").val());
    if( saldo > valor ){

            Parameters = {"numero_conta_transfer" : $("#numero_conta_transfer").val()  ,"numero_conta" :  $("#account").val(), "valor" : $("#valor").val() };
            $.post({
                url: "/assets/php/Controllers/ControllerRequest.php",
                data: {filename : null,className : "ControllerAccount", FunctionName: "transferencia" , data : Parameters},
                success: function (result) {
                    Swal.fire({
                        background: '#34eb46',
                        position: 'top-end',
                        title: result,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#numero_conta_transfer").val("") 
                    $("#valor").val("")
                    changeacouunt()
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        background: '#fc3903',
                        position: 'top-end',
                        title: xhr.responseText,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
        });
    }else{
        $("#valor").val("");
        Swal.fire({
            background: '#fc3903',
            position: 'top-end',
            title: "Não é possivel trasferir um valor maior que o saldo !",
            showConfirmButton: false,
            timer: 1500
        })
    }
}






