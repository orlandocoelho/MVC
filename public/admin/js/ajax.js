$(document).ready(function(){
    
    $('form[name="selectImage"]').submit(function(){
        var formimage = $(this);
        var button = $(this).find(':button');
        $.ajax({
           url: "/admin/conteudo/article/selectimg",
           type: "POST",
           data: "acao=selectimg&"+formimage.serialize(),
           beforeSend: function(){
               button.html('Aguarde..').attr('disabled', true);
           },
           success: function(retorno){
               button.html('Salvar').attr('disabled', false);
               $('.img-select-modal').modal('hide');
               $('#imgSelect').html(retorno);
           }
        });
        return false;
    });
    
    $('.table').on("click", '#button-img', function(){
        var id = $(this).attr('data-id');
        
        $.post('/admin/conteudo/article/veImage', {id: id}, function(retorno){
            $('#modal').modal();
            $('#modal-title').html('Imagens do artigo');
            $('.modal-body .row').html(retorno);
        });
        
        return false; 
    });
    
    $('.table').on("click", '#button-text', function(){
        var id = $(this).attr('data-id');
        
        $.post('/admin/conteudo/article/veText', {id: id}, function(retorno){
            $('#modal').modal();
            $('#modal-title').html('Texto do artigo');
            $('.modal-body .row').html(retorno);
        });
        
        return false; 
    });
        
});