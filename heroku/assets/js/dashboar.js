
$("#Home").click(function(){
    var conteudo = $("#divPrincipal").text();
    alert(conteudo);
    $("#divPrincipal").text("<h3>Novo conteudo</h3>")
});
