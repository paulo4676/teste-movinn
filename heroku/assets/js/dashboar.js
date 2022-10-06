
$(document).on('click', function(){
    console.log("jquery ok");
    var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id
    console.log(clickedBtnID);
});

