$(function (){
    var info = $('.info');
    $('#mailtip2').mailtip({
    onselected: function (mail){
    info.text('alanbarret98@gmail.com ' + mail)
    }
    });
});