
function teste(){
    console.log("js ok");
}


$(document).on("click",".appDetails", function () {
    alert("teste");
    var clickedBtnID = $(this).attr('id');
    console.log(clickedBtnID)
});


$(document).on("click",".appDetails", function (event) {
    alert(event.target.id);
});