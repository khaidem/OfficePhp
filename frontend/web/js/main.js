
// For view and upadate button in GridView
$(function () {
    $('.modalButton').click(function () {
       $.get($(this).attr('href'), function(data){
        $('#modal').modal('show').find('#modalContent').html(data)
       });
       return false;
    });
});

$(function(){
    //get the click of the create button
    $('#modalButtonCreate').click(function (){
        $('#modalCreate').modal('show')
        .find('#modalCreateContent').load($(this).attr('value'))
    })
})


