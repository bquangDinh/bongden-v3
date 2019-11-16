$(document).ready(function(){
  $("#article-table").DataTable({
    'paging': false
  });

  $(".open-article-preview").animatedModal();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



  $(".open-article-preview").on('click',function(e){
    let article_id = $(this).data("article-id");

    $.ajax({
      type:'get',
      url:'/user/article/review/' + article_id,
      success:function(data){
        if(data){
          $("#loading").hide();
          $("#article-title").html(data.title);
          $("#article-cover__image").attr("src",data.cover_url);
          $("#article-type-link").html(data.subject.name);
          $("#article-content").html(data.content);
          $(".article-cover-container").fadeIn(500);
          $(".article-main-content").fadeIn(500);
        }
      },
      error:function(jqXHR,exception){
        console.log(jqXHR.responseText);
      }
    });
  });

  $(".approve-article-btn").on('click',function(e){
    let article_id = $(this).data("article-id");
    let tr = $(this).parent().parent();
    $.ajax({
      type:'get',
      url:'/user/bdteam/content_executive/approve_article/approve/' + article_id,
      success:function(data){
        Swal.fire({
          type:'success',
          text:'Phê duyệt thành công'
        });
        $(tr).remove();
      },
      error:function(jqXHR,exception){
        console.log(jqXHR.responseText);
        Swal.fire({
          type:'error',
          title:'Lỗi: ' + jqXHR.status,
          text:'Có lỗi xảy ra trong quá trình'
        });
      }
    });
  });

  $(".delete-article-btn").on('click',function(e){
    let article_id = $(this).data("article-id");

    (async function getReason(){
      const {value: text} = await Swal.fire({
        title:'Nhập lý do',
        input: 'textarea',
        inputPlaceholder: 'Có bất cứ điểm nào không hợp lý ở bài viết này ?',
        showCancelButton: true,
        inputValidator: (value) => {
          if (value = "") {
            return 'Vui lòng cung cấp chi tiết';
          }
        }
      });

      if(text){
        $.ajax({
          type:'post',
          url:'/user/bdteam/content_executive/approve_article/deny',
          data:{
            article_id:article_id,
            reason:text
          },
          success:function(data){
            if(data == 0){
              Swal.fire({
                type:'success',
                text:'Đã từ chối bài viết'
              });
            }else{
              Swal.fire({
                type:'error',
                text:'Có lỗi xảy ra trong quá trình'
              });
            }
          },
          error:function(jqXHR,exception){
            console.log(jqXHR.responseText);
            Swal.fire({
              type:'error',
              title:'Lỗi: ' + jqXHR.status,
              text:'Có lỗi xảy ra trong quá trình'
            });
          }
        });
      }
    })();
  });
});
