@extends('layouts.app') @section('body')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <h2 class="text-center fw-bold mb-4 text-uppercase">Chính sách Đổi trả - SOLID TECH</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    
                    <h4 class="text-danger fw-bold mb-3">I. CHÍNH SÁCH ĐỔI HÀNG</h4>
                    <p>Nếu sản phẩm không đáp ứng mong đợi, bạn có thể yêu cầu đổi hàng theo quy trình sau:</p>

                    <h5 class="fw-bold mt-4">1. Thời gian đổi hàng</h5>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><i class="bi bi-clock me-2 text-primary"></i> <strong>Mua online:</strong> Được đổi trong <strong>7 ngày</strong> kể từ ngày nhận hàng.</li>
                        <li class="list-group-item"><i class="bi bi-shop me-2 text-primary"></i> <strong>Mua tại cửa hàng:</strong> Được đổi trong <strong>7 ngày</strong> kể từ ngày mua (chỉ áp dụng tại đúng cửa hàng đã mua).</li>
                    </ul>
                    <div class="alert alert-info">
                        <i class="bi bi-telephone-fill me-2"></i> Hotline/Zalo hỗ trợ: <strong>0905 595 596</strong> <br>
                        <i class="bi bi-envelope-fill me-2"></i> Email: <strong>trangiahuy@gmail.com</strong>
                    </div>

                    <h5 class="fw-bold mt-4">2. Điều kiện đổi hàng</h5>
                    <ul>
                        <li>Sản phẩm chưa giặt, chưa sử dụng, còn nguyên tag và hóa đơn.</li>
                        <li>Chỉ đổi size, không đổi mẫu khác (trừ khi hết size).</li>
                        <li><span class="text-danger">Không áp dụng</span> cho hàng sale, outlet, phụ kiện, giày, vớ, quần lót.</li>
                        <li>Mỗi đơn hàng chỉ được đổi <strong>1 lần</strong>.</li>
                    </ul>

                    <h5 class="fw-bold mt-4">3. Quy trình đổi hàng Online</h5>
                    <div class="bg-light p-3 rounded">
                        <p><strong>Bước 1:</strong> Quay video sản phẩm còn mới, rõ tag, chưa sử dụng và gửi qua Zalo: <strong>0905 595 596</strong>.</p>
                        <p><strong>Bước 2:</strong> Shop kiểm tra video, xác nhận đủ điều kiện và tạo đơn hàng đổi mới.</p>
                        <p><strong>Bước 3:</strong> Shipper giao đơn mới -> Khách gửi lại hàng cũ cho shipper mang về.</p>
                        <p><strong>Bước 4:</strong> Shop nhận và kiểm tra hàng hoàn trả để hoàn tất quy trình.</p>
                        <p class="text-muted fst-italic mb-0">* Chi phí vận chuyển 2 chiều do khách hàng thanh toán (trừ khi lỗi từ Shop).</p>
                    </div>

                    <hr class="my-5">

                    <h4 class="text-danger fw-bold mb-3">II. CHÍNH SÁCH HOÀN TIỀN</h4>
                    <ul>
                        <li>Chỉ áp dụng hoàn tiền khi <strong>hết hàng</strong> hoặc không thể đổi size/mẫu.</li>
                        <li><strong>Mua tại cửa hàng:</strong> Hoàn tiền theo phương thức thanh toán ban đầu.</li>
                        <li><strong>Mua online:</strong> Hoàn tiền qua tài khoản ngân hàng hoặc thẻ đã thanh toán.</li>
                        <li>Đối với đơn COD, tiền sẽ hoàn sau khi shop nhận lại hàng và đơn vị vận chuyển xác nhận hoàn thành công.</li>
                        <li>Thời gian hoàn tiền: Tối đa <strong>14 ngày làm việc</strong>.</li>
                    </ul>

                    <hr class="my-5">

                    <h4 class="text-danger fw-bold mb-3">III. NGHĨA VỤ HAI BÊN</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Trách nhiệm của SOLID TECH:</h6>
                            <ul>
                                <li>Giao đúng hàng, đúng thời hạn, đảm bảo chất lượng.</li>
                                <li>Hỗ trợ đổi, bảo hành hoặc hoàn tiền nhanh chóng nếu sản phẩm lỗi.</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Trách nhiệm Khách hàng:</h6>
                            <ul>
                                <li>Thanh toán đúng hạn, kiểm tra kỹ hàng khi nhận.</li>
                                <li>Thông báo sớm cho shop nếu phát hiện lỗi.</li>
                                <li>Cung cấp thông tin giao hàng chính xác.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection