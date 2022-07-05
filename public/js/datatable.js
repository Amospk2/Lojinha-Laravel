$(document).ready(function ($) {

    var table = $("#table").DataTable({
        ajax: "manage_products/list",
        processing:true,
        serverSide:true,
        columns:[
            {data:"id", name:"id"},
            {data:"name", name:"name"},
            {data:"price", name:"city"},
            {data:"quantity", name:"private"},
            {data:"available", name:"available"},
            {data:"opcoes", name:"opcoes"},

        ],
    });
    
    (function($) {

    "use strict";

    var fullHeight = function() {

        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function(){
        $('.js-fullheight').css('height', $(window).height());
        });

    };
    fullHeight();

    })(jQuery);


    $(document).on('click', '.delete', function(){
      var id = $(this).data('id');
  
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
          title: 'Tem certeza que deseja excluir esse?',
          text: "Você não pederá reverter essa ação!",
          icon: 'warning',
          showCancelButton: true,
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Confirmar',
          reverseButtons: false
        }).then((result) => {
          if (result.value) {
  
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "manage_products/delete/"+id,
              type: 'DELETE',
              data:{"id":id},
              success:function(data){
                  if(data.erro){
                      swalWithBootstrapButtons.fire(
                          'Atenção! 1',
                          'Um erro ocorreu no servidor! Exclusão cancelada, tente mais tarde.',
                          'error'
                        )
                  }else{
  
                      swalWithBootstrapButtons
                      .fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        ).then(function(result){
                            if(result.value){
                                $('#table').DataTable().draw(false);
                            }
                        })
                  }
              },
              error:function(data){
                  swalWithBootstrapButtons.fire(
                      'Atenção! 2',
                      'Um erro ocorreu no servidor! Exclusão cancelada, tente mais tarde.',
                      'Erro 2'
                    )
              },
            });
          } else if (
            result.dismiss === Swal.DismissReason.cancel
          ) {
              swalWithBootstrapButtons.fire(
                  'Atenção!',
                  'Exclusão cancelada!',
                  'error'
                ) 
          }
        })
      });


      var table = $("#usertable").DataTable({
        ajax: "/manage_users/list",
        processing:true,
        serverSide:true,
        columns:[
            {data:"id", name:"id"},
            {data:"name", name:"name"},
            {data:"email", name:"email"},
            {data:"opcoes", name:"opcoes"},

        ],
    });
    

    $(document).on('click', '.delete-user', function(){
      var id = $(this).data('id');
  
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
          title: 'Tem certeza que deseja excluir esse?',
          text: "Você não pederá reverter essa ação!",
          icon: 'warning',
          showCancelButton: true,
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Confirmar',
          reverseButtons: false
        }).then((result) => {
          if (result.value) {
  
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "manage_users/delete_user/"+id,
              type: 'DELETE',
              data:{"id":id},
              success:function(data){
                  if(data.erro){
                      swalWithBootstrapButtons.fire(
                          'Atenção! 1',
                          'Um erro ocorreu no servidor! Exclusão cancelada, tente mais tarde.',
                          'error'
                        )
                  }else{
  
                      swalWithBootstrapButtons
                      .fire(
                          'Deleted!',
                          'Your user has been deleted.',
                          'success'
                        ).then(function(result){
                            if(result.value){
                                $('#usertable').DataTable().draw(false);
                            }
                        })
                  }
              },
              error:function(data){
                  swalWithBootstrapButtons.fire(
                      'Atenção! 2',
                      'Um erro ocorreu no servidor! Exclusão cancelada, tente mais tarde.',
                      'Erro 2'
                    )
              },
            });
          } else if (
            result.dismiss === Swal.DismissReason.cancel
          ) {
              swalWithBootstrapButtons.fire(
                  'Atenção!',
                  'Exclusão cancelada!',
                  'error'
                ) 
          }
        })
      });

    
}); 
      