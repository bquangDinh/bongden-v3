@extends('userpage.user_layout')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('css')
@endsection

@section('content-title')
Quy định viết bài
@endsection

@section('content')
<div class="card shadow mt-4 mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Quy định viết bài</h6>
  </div>
  <div class="card-body">
    <h5>
      <i class="fas fa-lightbulb" style="color:#f39c12"></i>
      <i class="fas fa-lightbulb" style="color:#f39c12"></i>
      <i class="fas fa-lightbulb" style="color:#f39c12"></i>
      Xin chào tất cả các bạn Bóng Đèn-ers, cảm ơn các bạn đã tham gia vào website của Bóng Đèn để cùng nhau tạo nên những bài viết thật hay, thật bổ ích dành tặng đến cộng đồng. Tuy nhiên tụi mình biết rằng bài viết nào cũng có thể có sai sót và một số sai sót nhỏ tụi mình có thể thông cảm bỏ qua nhưng có một số sai sót tụi mình mong muốn các bạn tránh gặp phải mà sẽ được liệt kê dưới đây nhằm đảm bảo môi trường bài viết của Bóng Đèn hoàn toàn rõ ràng và trong sạch. Mong các bạn dành chút thời gian đọc về các quy định viết bài này nhé. Cảm ơn các bạn nhiều nhiều !
      <i class="fas fa-lightbulb" style="color:#f39c12"></i>
      <i class="fas fa-lightbulb" style="color:#f39c12"></i>
      <i class="fas fa-lightbulb" style="color:#f39c12"></i>
    </h5>
    <hr>
    <ul>
				<li>Sử dụng tiếng Việt, có dấu, tránh viết tắt. Tuyệt đối <strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> được sử dụng teencode. Không sử dụng các từ ngữ tục tĩu, khiếm nhã, thiếu văn hóa.</li>
				<li><strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> đăng các bài viết quảng cáo (rao vặt, bán sim,...) nhằm PR cho hình ảnh bản thân hoặc các tổ chức khác. Ngoại trừ các bài viết nói về Bóng Đèn.</li>
				<li><strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> đăng các bài viết nhằm mục đích trục lợi cá nhân.</li>
				<li><strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> yêu cầu người đọc cung cấp các thông tin cá nhân, thông tin nhạy cảm trong nội dung bài viết.</li>
				<li><strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> vi phạm luật pháp nước CHXHCN Việt Nam.</li>
				<li><strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> vi phạm thuần phong mỹ tục Việt Nam.</li>
				<li><strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> sử dụng từ ngữ vô nghĩa hoặc người đọc hiểu từ đó sang một ý nghĩa tiêu cực hơn là tích cực.</li>
				<li>Nội dung bài viết <strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> được xúc phạm, nói xấu một cá nhân, tập thể, tổ chức, phân biệt chủng tộc, chính trị và tôn giáo.</li>
				<li><strong style="color:#e74c3c"><i class="fas fa-exclamation-triangle"></i> KHÔNG</strong> đăng bài viết với nội dung liên quan đến <strong>đồi trụy, khỏa thân, 18+</strong>.</li>
				<li><i class="fas fa-check" style="color:#2ecc71"></i> Nội dung bài viết phải đảm bảo đúng sự thật.</li>
				<li><i class="fas fa-check" style="color:#2ecc71"></i> Nội dung bài viết có sử dụng nội dung của nơi khác thì phải ghi nguồn rõ ràng. Ví dụ ảnh trong bài viết dưới phải tiêu đề rõ nguồn ở đâu hoặc câu trích dẫn, câu nói phải tiêu đề rõ là của ai. Hoặc là tiêu đề ngay dưới nội dung được trích hoặc là đánh dấu nó ở phần phụ lục (nếu có). Nếu là bài dịch thì ở đầu phải thông báo cho mọi người biết bài viết là bài dịch, dịch từ đâu, của ai, tên gốc của bài viết là gì, được xuất bản khi nào và ở cuối bài viết phải dẫn link đến bài viết gốc.</li>
				<li>Bóng Đèn khuyến khích các bạn viết bài sử dụng các từ ngữ dễ hiểu nhất có thể, tránh gây ra sự khó khăn cho người đọc.</li>
				<li><i class="fas fa-check" style="color:#2ecc71"></i> Nếu các bạn muốn các bài theo hướng research, Bóng Đèn khuyến khích các bạn tìm hiểu thêm về cách viết research trong môi trường học thuật để bài viết được chất lượng hơn nữa.</li>
				<li><i class="fas fa-check" style="color:#2ecc71"></i> Nếu các bạn có vấn đề gì thắc mắc về các quy định trên hoặc mong muốn cải thiện nội dung hoặc chủ đề cho website Bóng Đèn, xin vui lòng gửi email về hòm thư bongden.camp@gmail.com để được giải đáp.</li>
				<li><i class="fas fa-bullhorn" style="color:#f39c12"></i><i class="fas fa-bullhorn" style="color:#f39c12"></i><i class="fas fa-bullhorn" style="color:#f39c12"></i> Các quy định trên đây không nhằm mục đích gây khó dễ cho các bạn Bóng Đèn-ers trong việc viết và đăng bài. Mục đích của nó là tránh gây xích mích không đáng có trong nội bộ Bóng Đèn hoặc gây ra hình ảnh xấu về Bóng Đèn trong mắt cộng đồng. Vì vậy các bài viết mắc phải sai sót được liệt kê ở trên thì sẽ được thông báo, nhắc nhở và gợi ý để chỉnh sửa lại bài viết. Nếu các bài viết vẫn bị mắc sai sót như đã nêu ra và Bóng Đèn nhận thấy người viết bài không muốn sửa lại thì bài viết đó sẽ không được phê duyệt hoặc bị xóa vĩnh viễn về sau. Tụi mình mong muốn các bạn nhìn nhận các quy định này theo hướng tích cực và tiếp thu nó để Bóng Đèn phát triển hơn nữa. Cảm ơn các bạn đã đọc.</li>
			</ul>
  </div>
</div>
@endsection

@section('js')
@endsection
