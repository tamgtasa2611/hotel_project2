<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function payment()
    {
        $carts = [];
        $start = Session::get('start');
        $end = Session::get('end');
        $totalPrice = Session::get('totalPrice');
        if (Session::get('cart') != null) {
            $carts = Session::get('cart');
        } else {
            $carts = null;
        }
        if ($carts == null) {
            return Redirect::route('guest.cart');
        }

        return view('guest.cart.payment', compact('carts', 'start', 'end', 'totalPrice'));
    }

    public function paymentProcess(Request $request)
    {
        Session::put('payment_data', [
            'guest_lname' => $request->guest_lname,
            'guest_fname' => $request->guest_fname,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'note' => $request->note,
            'total_price' => $request->total_price
        ]);

        return Redirect::route('guest.paymentRedirect');
    }

    public function paymentRedirect()
    {
        return view('guest.cart.payment_redirect');
    }

    public function vnpay_payment()
    {
        // bank : 	9704198526191432198

//        if (!Session::get('payment_data')) {
//            return Redirect::route('guest.cart');
//        }
        $price = Session::get('payment_data')['total_price'] * 10;

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/booking";
        $vnp_TmnCode = "QUCB81JQ";//Mã website tại VNPAY
        $vnp_HashSecret = "GBD31VX0IJ0KDH1OND6K1DX2R7SO73MV"; //Chuỗi bí mật

        $vnp_TxnRef = rand(11111, 999999999);
        $vnp_OrderInfo = 'Thanh toán đặt phòng tại Skyrim Hotel';
        $vnp_OrderType = 'Đặt cọc';
        $vnp_Amount = $price;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function paymentSuccess()
    {
//        if (!Session::exists('payment_success')) {
//            return Redirect::route('guest.cart');
//        }
        return view('guest.cart.success');
    }
}
