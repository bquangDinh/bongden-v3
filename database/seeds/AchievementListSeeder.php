<?php

use Illuminate\Database\Seeder;

use App\UserAchievementList;

class AchievementListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $achievement_list = array(
          "Đuốc" => "Lần đầu tiên đến với Bóng Đèn",
          "Lửa" => "Đạt cấp 2",
          "Nến" => "Đạt cấp 3",
          "Đèn dầu" => "Đạt cấp 5",
          "Đèn sợi đốt" => "Đạt cấp 7",
          "Đèn huỳnh quang" => "Đạt cấp 11",
          "Đèn LED" => "Đạt cấp 13",
          "Ánh sáng" => "Đạt cấp 17",
          "Hồng ngoại" => "Đạt cấp 19",
          "Tia X" => "Đạt cấp 23",
          "Photon" => "Đạt cấp 29",
          "Mặt trăng" => "Đạt cấp 31",
          "Sao kim chói sáng" => "Đạt cấp 37",
          "Mặt trời chói lóa" => "Đạt cấp 41",
          "Voyager 1" => "Đạt cấp 43",
          "Voyager 2" => "Đạt cấp 47",
          "Sao bắc đẩu" => "Đạt cấp 53",
          "Chòm sao Tiên Nữ @Andromeda" => "Đạt cấp 59",
          "Chòm sao Bảo Bình @Aquarius" => "Đạt cấp 61",
          "Chòm sao Cự Giải @Cancer" => "Đạt cấp 67",
          "Chòm sao Nhân Mã @Centaurus" => "Đạt cấp 71",
          "Chòm sao Song Tử @Gemini" => "Đạt cấp 73",
          "Chòm sao Cung Thủ @Sagittarius" => "Đạt cấp 79",
          "MilkyWay @galaxy" => "Đạt cấp 83",
          "God !!!!!" => "Đạt cấp 89",
          "Chủ đề đầu tiên" => "Bài viết đầu tiên với Bóng Đèn",
          "Tiếng nói đầu tiên" => "Bài thảo luận đầu tiên với Bóng Đèn",
          "Học sinh cần cù" => "Đóng góp 2 bài viết cho Bóng Đèn",
          "Học sinh tài năng" => "Đóng góp 4 bài viết cho Bóng Đèn",
          "Người nhiều tham vọng" => "Đóng góp 5 bài viết cho Bóng Đèn",
          "Học giả tương lai" => "Đóng góp 6 bài viết cho Bóng Đèn",
          "Học giả thực thụ" => "Đóng góp 10 bài viết cho Bóng Đèn",
          "Tài cao biết rộng" => "Đóng góp 14 bài viết cho Bóng Đèn",
          "Phải là chuyên gia" => "Đóng góp 20 bài viết cho Bóng Đèn",
          "Người đứng đầu" => "Đóng góp 30 bài viết cho Bóng Đèn",
          "Hỏi nhiều biết nhiều" => "Đóng góp 3 bài thảo luận",
          "Ngôi sao mới nổi" => "Đóng góp 7 bài thảo luận",
          "Học giả nhiệt tình" => "Đóng góp 10 bài thảo luận",
          "Tò mò-er" => "Đóng góp 14 bài thảo luận"
        );

        foreach ($achievement_list as $name => $description) {
          $new = new UserAchievementList;
          $new->name = $name;
          $new->description = $description;
          $new->save();
        }
    }
}
