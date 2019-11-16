jQuery(".discussion-title").fitText(1.8);
jQuery(".discussion-description").fitText(2,{
  maxFontSize: '16px'
});

$(".tippy").each(function(index){
  let message = $(this).data('tippy-message');
  tippy(this,{
    content: message
  });
});

$(document).ready(function(){
  $(".avatar").each(function(index){
    let exp_percentage = $(this).data("exp-percentage");
    $(this).circleProgress({
      value: exp_percentage,
      size: 80,
      fill: "#FF0266",
      lineCap: "round"
    });
  });
});
