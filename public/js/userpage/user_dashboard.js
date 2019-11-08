var ctx = document.getElementById('articleBySubjectPieChar').getContext('2d');
var ar_sj_p_chr = new Chart(ctx,{
  type: 'doughnut',
  data: {
    labels: ['Toán học','Vật lý học','Văn học','Ngôn ngữ học'],
    datasets: [{
      label: 'Loại',
      data: [10,20,30,40],
      backgroundColor: ['rgba(231, 76, 60,1.0)','rgba(46, 204, 113,1.0)','rgba(230, 126, 34,1.0)','rgba(22, 160, 133,1.0)']
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
  type: 'line',
  data:{
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets: [{
      label: "Bài viết",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [5,6,2,6,1,7,2,8,1,2,8,2]
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
