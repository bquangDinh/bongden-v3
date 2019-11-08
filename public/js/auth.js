function registerform(){
  $("#login-form").css("display","none");
  $("#register-form").css("display","block");
  $("#register-form").addClass("animated fadeInRight");
  $("#login-cover").hide();
  $("#register-cover").fadeIn(500);
}

function loginform(){
  $("#login-form").css("display","block");
  $("#register-form").css("display","none");
  $("#login-form").addClass("animated fadeInLeft");
  $("#register-cover").hide();
  $("#login-cover").fadeIn(500);
}

$("#sign-up-btn").click(function(){
  registerform();
});

$("#sign-in-btn").click(function(){
  loginform();
});

$(".male").on('click',function(e){
  $(this).addClass("is-checked");
  $(".female").removeClass("is-checked");
  $("#male-radio").prop("checked",true);
});

$(".female").on('click',function(e){
  $(this).addClass("is-checked");
  $(".male").removeClass("is-checked");
  $("#female-radio").prop("checked",true);
});

if(typeof URL === "undefined"){
  var parse_query_string = function(query){
    var vars = query.split("&");
    var query_string = {};
    for(var i = 0; i < vars.length;i++){
      var pair = vars[i].split("=");
      var key = decodeURLComponent(pair[0]);
      var value = decodeURLComponent(pair[1]);

      if(typeof query_string[key] === "undefined"){
        query_string[key] = decodeURLComponent(value);
      }else if (typeof query_string[key] === "string"){
        var arr = [query_string[key],decodeURLComponent(value)];
        query_string[key] = arr;
      }else{
        query_string[key].push(decodeURLComponent(value));
      }
    }
    return query_string;
  }

  var url = window.location.href;
  var parsed_qs = parse_query_string(url);
  console.log(parsed_qs.initform);
}else{
  var url = new URL(window.location.href);
  var initform = url.searchParams.get("initform");

  if(initform == "register"){
    registerform();
  }else{
    loginform();
  }
}
