$(".tooltip-o").each(function(index){
  let message = $(this).data('tooltip-message');
  console.log(message);

  tippy(this,{
    content: message
  });
});

var ctx = document.getElementById('articleBySubjectPieChar').getContext('2d');
var ar_sj_p_chr = new Chart(ctx,{
  type: 'doughnut',
  data: {
    labels: Object.keys(article_count_by_subject_statistics),
    datasets: [{
      label: 'Loại',
      data: Object.values(article_count_by_subject_statistics),
      backgroundColor: article_subject_colors
    }],
  },
  options: {
    animation:{
      animateScale: true
    }
  }
});

var ctx1 = document.getElementById('articleCountByMonth').getContext('2d');
var ar_c_m_chr = new Chart(ctx1,{
  type: 'bar',
  data:{
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets: [{
      label: "Bài viết",
      lineTension: 0.3,
      backgroundColor: "rgba(231, 76, 60,1.0)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: article_count_statistics
    }],
    options: {
        scales: {
            yAxes: [{
                stacked: true
            }]
        }
    }
  }
});
