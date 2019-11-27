$(".tooltip-o").each(function(index){
  let message = $(this).data('tooltip-message');

  tippy(this,{
    content: message
  });
});

var ID = function () {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return '_' + Math.random().toString(36).substr(2, 9);
};

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

function animateCSSJquery(element,animationName,callback){
  $(element).addClass('animated ' + animationName);

  function handleAnimationEnd(){
    $(element).removeClass('animated',animationName);
    $(element).unbind('animationend');

    if(typeof callback === 'function') callback();
  }

  $(element).bind('animationend',handleAnimationEnd);
}
function increaseNotificationCount(){
  let current_count = $("#notification-count").data("current-count");
  current_count = parseInt(current_count);
  current_count++;
  $("#notification-count").data("current-count",current_count);
  $("#notification-count").attr("data-current-count",current_count);
  $("#notification-count").html(current_count);
  animateCSS("#notification-count","tada");
}

function createNewNotification(user,message,url){
  var MAX_APPEARING_ITEMS = 4;

  let itemCount = $("#notification-list").children().length;
  console.log(itemCount);

  if(itemCount == MAX_APPEARING_ITEMS){
    //remove the last item and add the new item on top
    let last_item = $("#notification-list").children().last();
    animateCSSJquery(last_item,"zoomOutDown",function(){
      $(last_item).remove();
    });
  }

  let uniqueID = ID();

  let item = $(`<a class="dropdown-item d-flex align-items-center" href="${url}" id="item${uniqueID}">
    <div class="dropdown-list-image mr-3">
      <img class="rounded-circle" src="${user.avatarURL}" alt="user avatar">
    </div>
    <div class="font-weight-bold">
      <div class="text-truncate">${message}</div>
      <div class="small text-gray-500">${user.name}</div>
    </div>
  </a>`);

  $("#notification-list").prepend(item);
  animateCSS("#item" + uniqueID,"lightSpeedIn");
}

const NotiSweet = Swal.mixin({
  toast: true,
  position: 'bottom-start',
  showConfirmButton: false,
  timer: 3000,
  title:"Bạn có thông báo mới !",
  type:'success'
})

Pusher.logToConsole = true;

var pusher = new Pusher('e7ae72a09e030f573324',{
  encrypted: true,
  cluster: "ap1",
  forceTLS: true
});

var articlecommented = pusher.subscribe('article-commented');
var commentlikedarticle = pusher.subscribe('comment-liked-article');
var commentlikeddiscussion = pusher.subscribe('comment-liked-discussion');
var commentrepliedarticle = pusher.subscribe('comment-replied-article');
var commentreplieddiscussion = pusher.subscribe('comment-replied-discussion');
var discussioncommented = pusher.subscribe('discussion-commented');
var discussiondownvoted = pusher.subscribe('discussion-downvoted');
var discussionliked = pusher.subscribe('discussion-liked');
var discussionupvoted = pusher.subscribe('discussion-upvoted');
var replylikedarticle = pusher.subscribe('reply-liked-article');
var replylikeddiscussion = pusher.subscribe('reply-liked-discussion');
var replyrepliedarticle = pusher.subscribe('reply-replied-article');
var replyreplieddiscussion = pusher.subscribe('reply-replied-discussion');

articlecommented.bind('article-commented-event',function(data){
  console.log(data);
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

commentlikedarticle.bind('comment-liked-article-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

commentlikeddiscussion.bind('comment-liked-discussion-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

commentrepliedarticle.bind('comment-replied-article-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

commentreplieddiscussion.bind('comment-replied-discussion-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

discussioncommented.bind('discussion-commented-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

discussiondownvoted.bind('discussion-downvoted-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

discussionupvoted.bind('discussion-upvoted-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

discussionliked.bind('discussion-liked-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

replylikedarticle.bind('reply-liked-article-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

replylikeddiscussion.bind('reply-liked-discussion-event',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

replyrepliedarticle.bind('reply-replied-article',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});

replyreplieddiscussion.bind('reply-replied-discussion',function(data){
  createNewNotification(data.user,data.message,data.url);
  increaseNotificationCount();
  NotiSweet.fire();
});
