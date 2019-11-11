$(document).ready(function(){
  tinymce.init({
    selector: '#content-field',
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
  paste_data_images: true,
  });

  $("#discussion-category").select2({
    placeholder:"Chọn thể loại",
    width:"100%",
    ajax:{
      url:"/user/action/get_discussion_categories",
      dataType:"json",
      quietMillis:250,
      processResults:function(data){
        console.log(data);
        return{
          results:data
        }
      }
    }
  });
});
