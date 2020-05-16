
    $(document).ready(function(){

        $("#register").click(function(){

                  var username = $("#username").val();
                  var telephone = $("#telephone").val();
                  var name = $("#name").val();
                  var surname = $("#surname").val();
                  var email = $("#emails").val();
                  var password = $("#sifre").val();
                  var password2 = $("#sifre2").val();


                    var Data = "userRegister="+username+"&username="+username+"&telephone="+telephone+"&surname="+surname+"&email="+email+"&password="+password+"&name="+name+"&password2="+password2;



                    $.ajax({

                          type: "POST",
                          url: "operations.php",
                          data: Data,
                          success:function(data){

                              veri = JSON.parse(data);

                            Swal.fire({
                               icon: veri.status,
                               title: veri.message,
                             }).then((result) => {
                               if(result.value){

                                 if(veri.status == "success"){
                                   window.location = "/";
                                 }else{

                                 }
                               }
                             })

                               if(veri.status == "success"){
                                 setTimeout(function(){
                                   window.location = "";
                                 },2000)
                               }

                          }

                    });





        })

        $("#login").click(function(){

                    var email = $("#email").val();
                    var password = $("#password").val();

                      var Data = "userlogin="+email+"&email="+email+"&password="+password;

                    $.ajax({
                        type: "POST",
                        url: "operations.php",
                        data:Data,
                        success:function(data){

                            ver = JSON.parse(data);

                            Swal.fire({
                                icon: ver.status,
                                text: ver.message
                              }).then((result) => {
                                if(result.value){

                                  if(ver.status == "success"){
                                    window.location = "/home";

                                  }
                                }
                              })

                              if(ver.status == 'success'){
                                setTimeout(function(){
                                window.location.assign("/home");
                              }, 2000);
                              }



                        }

                    });





          })




    })
