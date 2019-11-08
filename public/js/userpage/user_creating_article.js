$(document).ready(function(){
  $("#subject_select").select2({
    placeholder:"Chọn thể loại",
    width:"100%",
    ajax:{
      url:"/user/action/get_article_subjects",
      dataType:"json",
      quietMillis:250,
      processResults:function(data){
        return{
          results:data
        }
      }
    }
  });

  $("#tag_select").select2({
    placeholder: 'Gắn tag',
    width: "100%",
    maximumSelectionLength:5,
    minimumInputLength:3,
    tags:true,
    tokenSeparators: [',',' '],
    ajax:{
      url:"/user/action/get_tags_list",
      dataType:'json',
      quietMillis:250,
      error:function(jqXHR,exception){
        console.log(jqXHR.responseText);
      },
      data:function(params){
        return{
          q:$.trim(params.term)
        };
      },
      processResults:function(data){
        return {
          results:data
        }
      },
      cache:true
    }
  });

  tinymce.init({
    selector: '#textarea-content',
    height: 500,
    theme: 'silver',
    plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ],
  external_plugins: {
        tiny_mce_wiris: 'https://www.wiris.net/demo/plugins/tiny_mce/plugin.js'
    },
  paste_data_images: true,
  });

  async function getCoverChoosen(){
    const inputOptions = new Promise((resolve) => {
      setTimeout(() => {
        resolve({
          "url":"URL",
          "upload":"Tải lên từ máy tính"
        });
      },200);
    });

    const {value: choosen} = await Swal.fire({
      title:'Chọn phương thức lấy ảnh',
      input:'radio',
      inputOptions:inputOptions,
      inputValidator:(value) => {
        if(!value){
          return 'You need to choose something!';
        }
      }
    });

    if(choosen){
      if(choosen == "url"){
        (async function setCoverByURL(){
          const {value:url} = await Swal.fire({
            title:'URL',
            input:'url',
            inputPlaceholder: 'Enter the image URL'
          });

          if(url){
            $("#article-cover-img").attr("src",url);
            $("#cover-input").val(url);
          }
        })();
      }else{
        const {value: file} = await Swal.fire({
          title: 'Select image',
          input:'file',
          inputAttributes:{
            'accept': 'image/*',
            'aria-label': 'Upload your cover picture'
          }
        });

        if(file){
          let filesize = file.size/1024/1024;
          let FILE_SIZE_LIMIT = 1; // 1MB;
          if(filesize > FILE_SIZE_LIMIT){
            Swal.fire({
              type:'error',
              title:'File ảnh quá lớn !!!',
              text:'Vui lòng sử dụng ảnh có dung lượng dưới 1MB'
            });
          }else{
            let data = new FormData();
            data.append('cover',file);

            let ajax = new XMLHttpRequest();

            ajax.onreadystatechange = function(){
              console.log(ajax.responseText);
              if(ajax.readyState === 4 && ajax.status === 200){
                $("#article-cover-img").attr("src",ajax.responseText);
                $("#cover-input").val(ajax.responseText);
              }
            }

            let url = "/user/action/add_image";
            ajax.open("post",url,true);
            ajax.setRequestHeader('X-CSRF-TOKEN',$('meta[name="csrf-token"]').attr('content'));
            ajax.send(data);
          }
        }
      }
    }
  }

  $("#add-btn").on('click',function(e){
    getCoverChoosen();
  });
});


function auto_expand(){
  var el = this;
  setTimeout(function(){
    $(el).css("height","auto");
    $(el).css("padding","0");
    $(el).css("height",el.scrollHeight + "px");
  },0);
}

var textarea = document.querySelector("textarea");
textarea.addEventListener('keydown',auto_expand);
