jQuery(".name").fitText(0.9,{
  minFontSize: '12px'
});
jQuery(".lastest-article-container .title").fitText(1.9,{
  maxFontSize: '22px'
});
jQuery(".article-container .title").fitText(2.5,{
  minFontSize: '20px'
});
jQuery(".recent-article .title").fitText(4,{
  minFontSize: '14px'
});
jQuery(".description").fitText(3,{
  maxFontSize: '16px'
});

$(document).ready(function(){
  $(".avatar").each(function(index){
    let exp_percentage = $(this).data("exp-percentage");
    $(this).circleProgress({
      value: exp_percentage,
      size: 40,
      fill: "#FF0266",
      lineCap: "round"
    });
  });
});
