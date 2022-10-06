
function teste(){
    console.log("js ok");
}


$(document).on("click",".appDetails", function () {
    var clickedBtnID = $(this).attr('id');
    console.log(clickedBtnID)
});


$(document).on("click",".appDetails", function (event) {
    alert(event.target.id);
});