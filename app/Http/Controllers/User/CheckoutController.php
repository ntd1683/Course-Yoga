<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function vnpay(Order $order)
    {
        $vnp_TmnCode = config('services.vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('services.vnpay.vnp_HashSecret');
        $vnp_Url = config('services.vnpay.vnp_Url');
        $vnp_Returnurl = route('return.vnpay');
        $vnp_TxnRef = $order->code;
        $vnp_OrderInfo = trans('Course Payments - ') . $order->course_id;
        $vnp_OrderType = '210000';
        $vnp_Amount = $order->total * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        //Add Params of 2.0.1 Version
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);

        return redirect($vnp_Url);
    }

    public function processVnpay(Request $request)
    {
        $vnp_TmnCode = config('services.vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('services.vnpay.vnp_HashSecret');

        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnp_Amount = $inputData['vnp_Amount']/100;

        $orderCode = $inputData['vnp_TxnRef'];

        try {
            if ($secureHash == $vnp_SecureHash) {
                $order = Order::query()
                    ->where('code', $orderCode)
                    ->first();

                if ($order != NULL) {
                    if($order["total"] == $vnp_Amount)
                    {
                        if ($order["status"] === 0) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $arr['type'] = 1;
                                $arr['status'] = 1;

                                $order->fill($arr);
                                $order->save();

                                $returnData['RspCode'] = '00';
                                $returnData['Message'] = trans('Payment success');
                            } else {
                                $returnData['RspCode'] = '99';
                                $returnData['Message'] = trans('Payment failed, please try again later');
                            }
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = trans('Order Has Been Paid');
                        }
                    }
                    else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = trans('You Don\'t Match Your Payment');
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = trans('Order Not Found');
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = trans('Order Not Matching Please Try Again');
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = trans('Bad Payment Please Try Again Later');
        }

        if($returnData['RspCode'] === '00'){
            return redirect()->route('index')->with('success',$returnData['Message']);
        }

        return redirect()->route('index')->withErrors($returnData['Message']);
    }


    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo(Order $order)
    {
        try {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

            $partnerCode = config('services.momo.partnerCode');
            $accessKey = config('services.momo.accessKey');
            $secretKey = config('services.momo.secretKey');

            $orderInfo = "Course Payments - " . $order->course_id;
            $amount = $order->total;
            $orderId = $order->code;
            $redirectUrl = route('return.momo');
            $ipnUrl = route('return.momo');
            $extraData = "";

            $requestId = time() . "";
            $requestType = "captureWallet";

            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => option('site_name'),
                "storeId" => trans('Course Payment'),
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );

            $result = $this->execPostRequest($endpoint, json_encode($data));

            $jsonResult = json_decode($result, true);

            if($jsonResult['resultCode'] == '0'){
                return redirect()->to($jsonResult['payUrl']);
            }

            return redirect()->route('index')->withErrors($jsonResult['message']);
        } catch (\Exception $e) {
            return redirect()->route('index')->withErrors(trans("Error Unknown! Please try again later"));
        }

    }

    public function processMomo(Request $request)
    {
        $partnerCode = config('services.momo.partnerCode');
        $accessKey = config('services.momo.accessKey');
        $secretKey = config('services.momo.secretKey');

        $response = array();
        try {
            $partnerCode = $_GET["partnerCode"];
            $orderId = $_GET["orderId"];
            $requestId = $_GET["requestId"];
            $amount = $_GET["amount"];
            $orderInfo = $_GET["orderInfo"];
            $orderType = $_GET["orderType"];
            $transId = $_GET["transId"];
            $resultCode = $_GET["resultCode"];
            $message = $_GET["message"];
            $payType = $_GET["payType"];
            $responseTime = $_GET["responseTime"];
            $extraData = $_GET["extraData"];
            $m2signature = $_GET["signature"]; //MoMo signature

            //Checksum
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&message=" . $message . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                "&orderType=" . $orderType . "&partnerCode=" . $partnerCode . "&payType=" . $payType . "&requestId=" . $requestId . "&responseTime=" . $responseTime .
                "&resultCode=" . $resultCode . "&transId=" . $transId;

            $partnerSignature = hash_hmac("sha256", $rawHash, config('services.momo.secretKey'));

            if ($m2signature == $partnerSignature) {
                if ($resultCode == '0') {
                    $order = Order::query()
                        ->where('code', $orderId)
                        ->first();
                    if ($order != NULL) {
                        if($order->total == $amount)
                        {
                            if ($order->status == 0) {
                                $arr['type'] = 2;
                                $arr['status'] = 1;

                                $order->fill($arr);
                                $order->save();
                                $notify = trans('Payment success');
                            } else {
                                $notify = trans('Order Paid');
                            }
                        }
                        else {
                            $notify = trans('You Pay Not Matching Amount');
                        }
                    }else{
                        $notify = trans('Application not found');
                    }
                } else {
                    $notify = $message;
                }
            } else {
                $notify = 'This transaction could be hacked, please check your signature and returned signature';
            }

        } catch (\Exception $e) {
            $notify = $e;
            echo $response['message'] = $e;
        }

        $debugger = array();
        $debugger['rawData'] = $rawHash;
        $debugger['momoSignature'] = $m2signature;
        $debugger['partnerSignature'] = $partnerSignature;

        if ($m2signature == $partnerSignature) {
            $notify = trans("Received payment result success");
            $response['message'] = trans("Received payment result success");
        } else {
            $notify = trans("ERROR! Fail checksum");
            $response['message'] = trans("ERROR! Fail checksum");
        }

        $response['debugger'] = $debugger;

        if($resultCode === '0') {
            return redirect()->route('index')->with('success',$notify);
        }

        return redirect()->route('index')->withErrors($notify);
    }
}
