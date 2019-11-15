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
