
function teste(){
    console.log("js ok");
}

$(window).on('click', ".appDetails", function(){
    console.log($(this).attr('id'));
});