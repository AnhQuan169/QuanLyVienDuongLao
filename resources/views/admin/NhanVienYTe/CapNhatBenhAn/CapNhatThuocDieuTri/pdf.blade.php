<!doctype html>
<html lang="en">
  <head>
    <title>Đơn thuốc của {{$ncc->hoTenNCC}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{public_path('admin/css/pdf/donthuoc/style.css')}}" rel="stylesheet">
    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="{{public_path('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css')}}"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  </head>
  <body>
    <div id="wallpaper">
      <div class="hospital-information">
        <p class="name-hospital">{{$benhAn->tenBenhVien}}</p>
        <p class="address-hospital">{{$benhAn->diaChi}}</p>
        <p class="phone-hospital">{{$benhAn->soDienThoai}}</p>
        <p class="khoa-hospital">Khoa: {{$benhAn->khoa}}</p>
      </div>
      <p class="title-prescription">ĐƠN THUỐC</p>
      <div class="elderly-information">
        <table class="table">
            <tr>
              <td>Ngày : </td>
              <td style="font-style: bold;">{{date('d/m/Y', strtotime($benhAn->ngayKham))}}</td>
            </tr>
            <tr>
              <td>Họ và tên : </td>
              <td style="font-style: bold;" style="text-transform: uppercase">{{$ncc->hoTenNCC}}</td>
              <td>Giới tính: {{$ncc->gioiTinhNCC == 0 ? 'Nữ' : 'Nam'}}</td>
              <td>Tuổi: {{$age}}</td>
            </tr>
            <tr>
              <td>Địa chỉ : </td>
              <td style="font-style: bold;">{{$ncc->diaChiNCC}}</td>
            </tr>
            <tr>
              <td>Chẩn đoán : </td>
              <td style="font-style: bold;">{{$benhAn->chanDoan}}</td>
            </tr>
        </table>
      </div>
      <div class="list-medicine">
        @foreach ($tdt as $key => $val )
          <table class="table">
            <tr>
              <td>{{$key + 1}}.</td>
              <td style="font-style: bold;float: left;padding-left: 10px;width: 450px">{{$val->tenThuoc}}</td>
              <td style="font-style: bold;">{{$val->soLuong}}</td>
              <td style="padding: 0 20px;float: right;margin-right: 10px">{{$val->donVi}}</td>
            </tr>
          </table>
          <p>{{$val->ghiChu}}</p>

        @endforeach
      </div>
      <div class="other-information">
        <table class="table">
          <tr>
            <td style="text-decoration: underline">Lời dặn BS : </td>
            <td style="font-style: bold;">{{$benhAn->ghiChu}}</td>
          </tr>
          <tr>
            <td style="text-decoration: underline">Tái khám : </td>
            <td style="font-style: bold;"></td>
          </tr>
          <tr>
            <td style="text-decoration: underline">Ngày tài khám : </td>
            <td style="font-style: bold;">{{date('d/m/Y', strtotime($benhAn->ngayHenKham))}}</td>
          </tr>
        </table>
      </div>
      <div style="text-align: right">
        <p style="margin: 20px 0;">Ngày {{$day}} tháng {{$month}} năm {{$year}}</p>
        <p style="margin-right: 20px;font-style: bold;">BÁC SĨ KHÁM BỆNH</p>
        <p style="margin-right: 50px; margin-top: 150px">{{$benhAn->bacSi}}</p>
      </div>

      <div style="height: 1px;background-color: #000;margin-top: 50px"></div>
      <div style="margin-top: 10px">
        <p style="line-height: 20px;text-align: center">Khám lại xin mang theo đơn này. Bệnh nhân nhớ xin giấy chuyển viện nếu tái khám lần 3 </p>
      </div>
    </div>
    

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>