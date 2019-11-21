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
    setCookie("darkmode","on");
    $('#dark-switch-input').prop('checked', true);
  }else{
    $("body").removeClass("night");
    $("body").addClass("light");
    setCookie("darkmode","off");
    $('#dark-switch-input').prop('checked', false);
  }
}

function setCookie(cname, cvalue) {
  document.cookie = cname + "=" + cvalue;
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function animateCSS(element, animationName, callback) {
    const node = document.querySelector(element)
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
}

function openUserProfile(user){
  $("#us-pr-logo").attr("src",user.logo);
  $("#us-pr-name").html(user.name);
  $("#us-pr-last-achieve-name").html(user.achieve);
  $("#us-pr-p-ar-count").html(user.article_count);
  $("#us-pr-p-dis-count").html(user.discussion_count);
  $("#us-pr-p-level-count").html(user.level);
  $("#us-pr-p-exp-count").html(user.exp);

  $("#user-profile").show();
  animateCSS("#user-profile","bounceIn");
}

$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('body').materialScrollTop();

  if(getCookie("darkmode") == "on"){
    changetoDarkMode(true);
  }else{
    changetoDarkMode(false);
  }

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
    if(this.checked){
      changetoDarkMode(true);
    }else{
      changetoDarkMode(false);
    }
  });

  $(document).on("click",".avatar",function(){
    let user_id = $(this).data("us-id");
    if(user_id){
      $.ajax({
        type:'POST',
        data:{
          user_id:user_id
        },
        url:'/user_preview',
        success:function(data){
          console.log(data);
          let d = {
            logo:data.avatarURL,
            name:data.name,
            article_count:data.article_count,
            discussion_count:data.discussion_count,
            level:data.level,
            exp:data.exp,
            achieve:data.achieve
          }
          openUserProfile(d);
        },
        error:function(jqXHR,exception){
          console.log(jqXHR.responseText);
        }
      });
    }
  });

  $("#us-pr-close").on('click',function(e){
    animateCSS("#user-profile","zoomOut",function(){
      $("#user-profile").hide();
    });
  });

  $("#user-avatar").on('click',function(e){
    let avatar_path = $(this).attr("src");
    let user_name = $(this).data("usn");

    Swal.fire({
      title: user_name,
      customClass:{
        'image': 'popup-avatar'
      },
      imageUrl: avatar_path,
      showConfirmButton: true,
      showCancelButton: true,
      showCloseButton: true,
      confirmButtonText: 'Tới trang Dashboard',
      cancelButtonText: 'Đăng xuất',
      confirmButtonColor: '#2ecc71',
      cancelButtonColor: '#e74c3c'
    }).then(function(result){
      if(typeof result.dismiss == "undefined"){
        window.location.href = "/user";
      }else{
        if(result.dismiss == "cancel"){
          window.location.href = "/bongden_logout";
        }
      }
    });
  });
});
