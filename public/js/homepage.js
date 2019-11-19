

particlesJS.load('particles-js','sources/data/json/particles.json',function(){
  console.log('callback - particles.js config loaded');
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
