<?php

use Illuminate\Database\Seeder;

use App\ArticleSubject;

class SubjectReleaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = array(
          "Nông nghiệp",
          "Thiên văn học",
          "Sinh học",
          "Hóa học",
          "Khoa học Trái Đất",
          "Khoa học môi trường",
          "Công nghệ thực phẩm",
          "Khoa học thường thức",
          "Toán học",
          "Khoa học vật liệu",
          "Địa lý",
          "Vật lý",
          "Thể thao",
          "Cơ thể con người",
          "Kiến trúc",
          "Khảo sát",
          "Khoa học máy tính",
          "Kỹ thuật phần mềm",
          "Multimedia",
          "Nghệ thuật",
          "Đồ thủ công",
          "Đồ họa",
          "Tâm lý học",
          "Kỹ thuật hàng không vũ trụ",
          "Phương tiện",
          "Viễn thông",
          "Sơ cấp cứu",
          "Ngôn ngữ học",
          "Văn hóa",
          "Dinh dưỡng",
          "Vật lý trị liệu",
          "Khảo cổ học",
          "Lịch sử",
          "Văn học",
          "Toán ứng dụng"
        );

        foreach($subjects as $subject){
          $new = new ArticleSubject;
          $new->name = $subject;
          $new->save();
        }
    }
}
