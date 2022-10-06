
$(document).on('click', function(event){
    console.log("jquery ok");
    console.log(event.target.id);
});

$(document).ready(function(){
    $('pages').click(function(event){
        alert(event.target.id);
    });
});