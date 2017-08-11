$(document).ready(function(){
    $('body').on('click', '.btn-action-to-confirm', function(){
        $('#confirm-modal form').attr('action', $(this).data('href'));
        $('#confirm-modal form').append('<input type="hidden" name="_method" value="'+$(this).data('method')+'"/>');
    });
})