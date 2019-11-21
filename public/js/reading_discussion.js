function create_avatar_progress(exp_percentage,dom){
  $(dom).circleProgress({
    value: exp_percentage,
    size: 40,
    fill: "#FF0266",
    lineCap: "round"
  });
}

function scrollToElement(pageElement) {
    var positionX = 0,
        positionY = 0;

    while(pageElement != null){
        positionX += pageElement.offsetLeft;
        positionY += pageElement.offsetTop;
        pageElement = pageElement.offsetParent;
        window.scrollTo({ top: positionY, left: positionX, behavior: 'smooth' });
    }
}

var ID = function () {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return '_' + Math.random().toString(36).substr(2, 9);
};

$(document).ready(function(){
  if(getCookie("darkmode") == "on"){
    changetoDarkMode(true);
  }else{
    changetoDarkMode(false);
  }

  $.scrolline();

  /*Initialize avatar circle progress*/
  $(".avatar").each(function(index){
    let exp_percentage = $(this).data("exp-percentage");
    create_avatar_progress(exp_percentage,this);
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  /*Events*/
  $("#like-btn").click(function(e){
    let discussion_id = $("#discussion-id").val();
    let that = this;
    let direct = $(this).data("liked-d-yet");
    let url = "";
    if(direct == true){
      //unlike
      url = "/user/action/unlike_discussion";
      $(this).data("liked-d-yet",false);
      $(this).attr("data-liked-d-yet",false);
      animateCSS("#like-btn","bounce");
    }else{
      //like
      url = "/user/action/like_discussion";
      $(this).data("liked-d-yet",true);
      $(this).attr("data-liked-d-yet",true);
      animateCSS("#like-btn","heartBeat");
    }

    $.ajax({
      type:'POST',
      data:{
        discussion_id:discussion_id
      },
      url:url,
      success:function(data){
        if(data == -1){
          Swal.fire({
            type:'error',
            title:'Đăng nhập để tiếp tục',
            showConfirmButton:true,
            showCancelButton:true,
            confirmButtonText:"Đăng nhập",
            cancleButtonText:'Đóng'
          }).then(function(result){
            if(result.value){
              window.location.href = "/bongden_login";
            }
          });
        }else{
          Swal.fire({
            type:'success',
            title: direct ? 'Đã bỏ thích' : 'Đã thích',
            position:'top-end',
            showConfirmButton:false,
            timer:1500,
            toast:true
          });
        }
      },
      error:function(jqXHR,exception){
        console.log(jqXHR.responseText);
      }
    });
  });

  $("#upvote-btn").click(function(e){
      let discussion_id = $("#discussion-id").val();
      let that = this;
      $.ajax({
        type:'POST',
        data:{
          discussion_id:discussion_id
        },
        url:'/user/action/upvote_discussion',
        success:function(data){
          if(data == "unauthorized"){
            Swal.fire({
              type:'error',
              title:'Đăng nhập để tiếp tục',
              showConfirmButton:true,
              showCancelButton:true,
              confirmButtonText:"Đăng nhập",
              cancleButtonText:'Đóng'
            }).then(function(result){
              if(result.value){
                window.location.href = "/bongden_login";
              }
            });
          }else{
            if(data == "permission_denied"){
              Swal.fire({
                type:'error',
                title:'Oops !',
                text:'Cấp độ của bạn chưa đủ để mở tính năng bỏ phiếu. Đạt cấp 4 để mở tính năng này'
              });
            }else{
              animateCSS("#upvote-btn","fadeOutUp");
              $(that).data("voted-d-yet",true);
              $(that).attr("data-voted-d-yet",true);
              if($("#downvote-btn").data("voted-d-yet") == true){
                $("#downvote-btn").data("voted-d-yet",false);
                $("#downvote-btn").attr("data-voted-d-yet",false);
              }
            }
          }
        },
        error:function(jqXHR,exception){
          console.log(jqXHR.responseText);
        }
      });
  });

  $("#downvote-btn").click(function(e){
      let discussion_id = $("#discussion-id").val();
      let that = this;
      $.ajax({
        type:'POST',
        data:{
          discussion_id:discussion_id
        },
        url:'/user/action/downvote_discussion',
        success:function(data){
          if(data == "unauthorized"){
            Swal.fire({
              type:'error',
              title:'Đăng nhập để tiếp tục',
              showConfirmButton:true,
              showCancelButton:true,
              confirmButtonText:"Đăng nhập",
              cancleButtonText:'Đóng'
            }).then(function(result){
              if(result.value){
                window.location.href = "/bongden_login";
              }
            });
          }else{
            if(data == "permission_denied"){
              Swal.fire({
                type:'error',
                title:'Oops !',
                text:'Cấp độ của bạn chưa đủ để mở tính năng bỏ phiếu. Đạt cấp 4 để mở tính năng này'
              });
            }else{
              animateCSS("#downvote-btn","fadeOutDown");
              $(that).data("voted-d-yet",true);
              $(that).attr("data-voted-d-yet",true);
              if($("#upvote-btn").data("voted-d-yet") == true){
                $("#upvote-btn").data("voted-d-yet",false);
                $("#upvote-btn").attr("data-voted-d-yet",false);
              }
            }
          }
        },
        error:function(jqXHR,exception){
          console.log(jqXHR.responseText);
        }
      });
  });

  $("#send-answer-btn").click(function(e){
    let discussion_id = $("#discussion-id").val();
    let comment_content = $("#answerbox-input").val();
    $("#answer-box").hide();
    $.ajax({
      type:'POST',
      data:{
        discussion_id:discussion_id,
        comment_content:comment_content
      },
      url:'/user/action/post_discussion_comment',
      success:function(data){
        if(data == -1){
          Swal.fire({
            type:'error',
            title:'Bình luận không xác định',
            text:'Vui lòng đăng nhập để bình luận'
          });
          $("#answer-box").show();
        }else{
          let uniqueID = "avatar" + ID();
          let d = $(data);
          d.find(".avatar").attr("id",uniqueID);
          let exp_percentage = d.find(".avatar").data("exp-percentage");

          $("#cm-inner-container").append(d.hide().fadeIn(500));
          $("#answerbox-input").val("");

          create_avatar_progress(exp_percentage,$("#" + uniqueID));

          $("#answer-box").show();

          scrollToElement(document.getElementById(uniqueID));
        }
      },
      error:function(jqXHR,exception){
        console.log(jqXHR.responseText);
      }
    });
  });

  $("#cm-outer-container").on("click",".reply-cm-btn",function(){
      let reply_block_id = $(this).data("rl-bl-id");
      let name = $(this).data("name");
      let parent_id = $(this).data("parent-id");
      $("#parent_name").html(name);
      $("#reply-btn").attr("data-parent-id",parent_id);
      $("#reply-btn").attr("data-rl-bl-id",reply_block_id);
      $("#replybox-input").val("");
      $("#reply-block").removeClass("d-none").detach().appendTo("#" + reply_block_id);
      scrollToElement(document.getElementById("reply-block"));
  });

  $("#cm-outer-container").on("click",".like-cm-btn",function(){
      let comment_id = $(this).data("comment-id");
      let count = $("#like-cm-count__" + comment_id);
      let that = this;

      $(that).html("Đã thích");
      $(that).removeClass("like-cm-btn").addClass("unlike-cm-btn");

      $.ajax({
        type:'POST',
        data:{
          comment_id:comment_id
        },
        url:'/user/action/like_discussion_comment',
        success:function(data){
          $(count).html(data);
        },
        error:function(jqXHR,exception){
          console.log(jqXHR.responseText);
        }
      });
  });

  $("#cm-outer-container").on("click",".unlike-cm-btn",function(){
      let comment_id = $(this).data("comment-id");
      let count = $("#like-cm-count__" + comment_id);
      let that = this;

      $(that).html("Thích");
      $(that).removeClass("unlike-cm-btn").addClass("like-cm-btn");
      $.ajax({
        type:'POST',
        data:{
          comment_id:comment_id
        },
        url:'/user/action/unlike_discussion_comment',
        success:function(data){
          $(count).html(data);
        },
        error:function(jqXHR,exception){
          console.log(jqXHR.responseText);
        }
      });
  });

  $("#reply-btn").on("click",function(){
    let discussion_id = $("#discussion-id").val();
    let comment_content = $("#replybox-input").val();
    let parent_id = $(this).data("parent-id");
    let root = $(this).data("rl-bl-id");
    $("#reply-block").hide();
    $.ajax({
      type:'POST',
      data:{
        discussion_id:discussion_id,
        comment_content:comment_content,
        parent_id:parent_id,
        root:root
      },
      url:'/user/action/post_discussion_reply',
      success:function(data){
        if(data == -1){
          Swal.fire({
            type:'error',
            title:'Bình luận không xác định',
            text:'Vui lòng đăng nhập để tiếp tục'
          });
          $("#reply-block").show();
        }else{
          let uniqueID = "avatar" + ID();
          let d = $(data);
          d.find(".avatar").attr("id",uniqueID);
          let exp_percentage = d.find(".avatar").data("exp-percentage");
          $(d).insertBefore("#reply-block").hide().fadeIn(500);
          create_avatar_progress(exp_percentage,$("#" + uniqueID));
          $("#replybox-input").val("");
          $("#reply-block").show();
        }
      },
      error:function(jqXHR,exception){
        console.log(jqXHR.responseText);
      }
    });
  });

  //SHARING FACEBOOK
  window.fbAsyncInit = function(){
FB.init({
    appId: '681364862313844', status: true, cookie: true, xfbml: true });
};
(function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if(d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id;
    js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
    ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ false));
function postToFeed(title, desc, url, image){
var obj = {method: 'feed',link: url, picture: 'http://www.url.com/images/'+image,name: title,description: desc};
function callback(response){}
FB.ui(obj, callback);
}

  $("#share-fb-btn").on('click',function(e){
    let elem = $(this);
    postToFeed(elem.data('title'), elem.data('desc'), elem.data('href'), elem.data('image'));
    return false;
  });
});
