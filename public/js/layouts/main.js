function showNotiWithSwal(title,type,mess){
  Swal.fire({
    title: title,
    type: type,
    text: mess
  });
}

function showAlertWithContext(context){
  var mess = "";
  var title = "";
  var type = "";
  if(context == "dev"){
      mess = 'Website Bóng Đèn đang trong quá trình phát triển, các thông tin trên website không phải là chính thức';
      title = "Oops";
      type = "warning";
  }else if(context == "update"){
    mess = "Trang bạn đang tìm kiếm hiện đang được cập nhật. Hãy quay lại sau nhé !";
    title = "Oops";
    type = "warning";
  }

  showNotiWithSwal(title, type, mess);
}

function changetoDarkMode(darkmode){
  if(darkmode){
    $("body").removeClass("light");
    $("body").addClass("night");
  }else{
    $("body").removeClass("night");
    $("body").addClass("light");
  }
}

$(document).ready(function(){
  $(".hamburger").on('click',function(){
    $(this).toggleClass('is-active');
    $(".navbar-mobile").toggleClass("is-open");
  });

  $("#search-btn").on('click',function(){
    $("#search-field").toggleClass("is-open");
  });

  $("#search-field-close-btn").on('click',function(){
    $("#search-field").removeClass("is-open");
  });

  $(".remark").on('click',function(e){
    e.preventDefault();
    showAlertWithContext($(this).data("rm-type"));
    return false;
  });

  $("#dark-switch-input").change(function(){
    console.log("changed");
    if(this.checked){
      changetoDarkMode(true);
    }else{
      changetoDarkMode(false);
    }
  });
});
