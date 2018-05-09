$(function (){
    $('.carousel').carousel({ interval: 6000 });
    $('.right').click(function() { $('.carousel').carousel('next');});
    $('.left').click(function() { $('.carousel').carousel('prev');});
    $('h4').tooltip();
    $('td').tooltip({ placement: 'left', trigger:'focus' });
    $('span').tooltip();
    $('.modal-btn').click(function() { $('.modal').modal('show');});
    $('.dropdown-toggle').mouseover(function() { $(this).dropdown('toggle');});
});	
