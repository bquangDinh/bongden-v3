$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var birthyear = parseInt($("#user-birthyear").data("year"));
  var selectLength = 0;
  for(var i = 1900;i <= 2019;i++,selectLength++){
    var o = new Option(i,i);
    if(i == birthyear){
      $(o).prop('selected',true);
    }
    $("#user-birthyear").append(o);
  }

  var cleave = new Cleave('#user-phone',{
    phone: true,
    phoneRegionCode: 'VN'
  });

  async function getCoverChoosen(){
    const inputOptions = new Promise((resolve) => {
      setTimeout(() => {
        resolve({
          "url":"URL",
          "upload":"Tải lên từ máy tính"
        });
      },200);
    });

    const {value: choosen} = await Swal.fire({
      title:'Chọn phương thức lấy ảnh',
      input:'radio',
      inputOptions:inputOptions,
      inputValidator:(value) => {
        if(!value){
          return 'You need to choose something!';
        }
      }
    });

    if(choosen){
      if(choosen == "url"){
        (async function setCoverByURL(){
          const {value:url} = await Swal.fire({
            title:'URL',
            input:'url',
            inputPlaceholder: 'Enter the image URL'
          });

          if(url){
            $.ajax({
              type:'post',
              url:'/user/profile/avatar_with_url',
              data:{
                'avatarURL':url
              },
              success:function(data){
                if(data == "0"){
                  $("#user-avatar").css("background-image","url('" + url + "')");
                  $("#avatar-top-bar").attr("src",url);
                }
              },
              error:function(jqXHR,exception){
                console.log(jqXHR.responseText);
                Swal.fire({
                  type:'error',
                  title:'Oops !',
                  text:'Không thể cập nhật ảnh đại diện !'
                });
              }
            });
          }
        })();
      }else{
        const {value: file} = await Swal.fire({
          title: 'Select image',
          input:'file',
          inputAttributes:{
            'accept': 'image/*',
            'aria-label': 'Tải ảnh đại diện'
          }
        });

        if(file){
          let filesize = file.size/1024/1024;
          let FILE_SIZE_LIMIT = 1; // 1MB;
          if(filesize > FILE_SIZE_LIMIT){
            Swal.fire({
              type:'error',
              title:'File ảnh quá lớn !!!',
              text:'Vui lòng sử dụng ảnh có dung lượng dưới 1MB'
            });
          }else{
            let data = new FormData();
            data.append('avatarFile',file);

            let ajax = new XMLHttpRequest();

            ajax.onreadystatechange = function(){
              if(ajax.readyState === 4 && ajax.status === 200){
                $("#user-avatar").css("background-image","url('" + ajax.responseText + "')");
                $("#avatar-top-bar").attr("src",ajax.responseText);
              }
            }

            let url = "/user/profile/avatar_with_file";

            ajax.open("post",url,true);
            ajax.setRequestHeader('X-CSRF-TOKEN',$('meta[name="csrf-token"]').attr('content'));
            ajax.send(data);
          }
        }
      }
    }
  }

  $("#update-avatar-btn").on("click",function(e){
    getCoverChoosen();
  });
});
