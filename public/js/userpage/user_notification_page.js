$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".mark-as-read-btn").on('click',function(e){
    let noti_id = $(this).data("noti-id");
    let that = this;

    $.ajax({
      type:'get',
      url:'action/mark_as_read_notification/' + noti_id,
      success:function(data){
        $("#noti-card-" + noti_id).addClass("noti-read");
        $(that).remove();
      },
      error:function(jqXHR,exception){
        console.log(jqXHR.responseText);
      }
    });
  });
});
