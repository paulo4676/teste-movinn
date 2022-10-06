
function teste(){
    console.log("js ok");
}

$(window).on('click', function(){
    console.log($(this).attr('id'));
});