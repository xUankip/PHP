<?php
//Mảng chứa sinh viên
    $sinhVien = array(
        array("ten" => "Nguyen Van A", "tuoi" => 20, "diem" =>85),
        array("ten" => "Nguyen Van B", "tuoi" => 21, "diem" =>75),
        array("ten" => "Nguyen Van C", "tuoi" => 27, "diem" =>95),
    );

//    In thông tin của từng sinh Viên
foreach ($sinhVien as $sv){
    echo "Ten :" .$sv["ten"]. "<br>";
    echo "Tuoi :" .$sv["tuoi"]. "<br>";
    echo "Diem :" .$sv["diem"]. "<br>";
//    Kiểm tra điểm và đưa ra đánh giá
    if ($sv["diem"] >= 90 ){
        echo "Xếp Loại : PERFECT <br>";
    } elseif ($sv["diem"] >= 80 ){
        echo  "Xếp Loại : Giỏi <br>";
    } elseif ($sv["diem"] >= 70){
       echo "Xếp Loại : kha <br>";
    } elseif ($sv["diem"] < 70){
        echo "Xếp Loại : Trung Binh YEU <br>";
    }
    echo "<hr>";

}
//Tính tổng điểm trung bình của tất cả sinh viên
$tongDiem = 0;
    foreach ($sinhVien as $sv) {
        $tongDiem +=$sv["diem"];
    }
    $diemTrungbinh = $tongDiem / count($sinhVien);

    echo  "Điểm trung bình : " . $diemTrungbinh;
?>