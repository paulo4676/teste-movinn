$(document).on("click",".appDetails", function () {
    alert("teste");
    var clickedBtnID = $(this).attr('id');
    console.log(clickedBtnID)
});