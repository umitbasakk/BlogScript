$(document).ready(function(){
  $("#logout").click(function(){


          var Data = "logout="+"logout";

        Swal.fire({
          title: 'Emin Misin?',
          text: "çıkış yapacaksın!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Evet, Çıkış Yap",
          cancelButtonText: "Hayır,İptal Et"
        }).then((result) => {
          if(result.value){

               $.ajax({
                 type: "POST",
                 url: "/operations.php",
                 data:Data,
                 success:function(data){

                             veri = JSON.parse(data);

                             Swal.fire({
                               icon: veri.status,
                               title: veri.message
                             }).then((result) => {
                               if(result.value){
                                 window.location = "/home";

                               }
                             })

                             if(veri.status == "success"){
                                 setTimeout(function(){
                                    window.location = "/home";
                                 },1300);
                             }

                 }
               })

          }
        })



  })
})
