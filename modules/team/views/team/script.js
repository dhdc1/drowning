$(function(){
    
    $('.member').click(function(e){
        $('#modal').modal('show').find('.modalContent').load('index.php?r=team/team-member/create');
    });
    
});

