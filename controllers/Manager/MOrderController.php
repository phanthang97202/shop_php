
<?php
include_once(__DIR__.'/../BaseController.php');
include_once(__DIR__.'/../../models/Order.php');
include_once(__DIR__.'/../../models/OrderDetail.php');

// link thư viện fpdf 
include_once(__DIR__.'/../../fpdf/fpdf.php');



class MOrderController extends BaseController{
    public function index(){
        $data = [];

        $modelOrder = new Order();

        $data['orders'] = $modelOrder->getAllOrderAdmin();

        // echo '<pre>';
        // var_dump($data['orders']);die();    

        return $this->renderView('manager/order/index', $data);
    }

    public function exportBill(){

        // echo "phan thang";
        $id = $_GET['id'];

        $orderDetail = new OrderDetail();
        
        //xoa avatar cua user khỏi folder
        // $data = $orderDetail->findOrder($id);
        $data['orders'] = $orderDetail->findOrder($id);

        
        // $data = [];
        // $modelOrder = new Order();
        // $data['orders'] = $modelOrder->getAllOrderAdmin();
        
        // echo '<pre>';
        // var_dump($data['orders']);die();

        
        
        // echo '<pre>';
        // var_dump($data['orders']);
        // // var_dump($data);die();

        // echo $data['orders']->total_money;
        // echo $data['orders']->created_at;
        // echo $data['orders']->note;
        // echo $data['orders']->phone;
        // echo $data['orders']->username;
        // echo $data['orders']->useremail;
        
        // var_dump($data->total_money);
        // var_dump($data->note);
        // var_dump($data->phone);
        // var_dump($data->username);
        // var_dump($data->useremail);
        // var_dump($data['details']->product_name);
        // var_dump($data->details);

        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage('L','A4',0);
        $pdf->SetFont('Times','',12);
        // $pdf->MakeFont('arial.ttf','cp1250');

        $pdf->Image('assets/upload/logoo.png',10,6,15);
        $pdf->Cell(276,5,'YOUR BILL',0,0,'C');
        $pdf -> Ln();

        $pdf->Cell(50,10,'Name user buy product : ');
        $pdf->Cell(35,10,$data['orders']->username);
        $pdf -> Ln();

        // $pdf->Cell(50,10,'Order time at : ');
        // $pdf->Cell(35,10,date("d-m-Y",$data['orders']->created_at));
        // $pdf -> Ln();

        $pdf->Cell(50,10,'Your order notes : ');
        $pdf->Cell(35,10,$data['orders']->note);

        // $pdf->Cell(35,10,iconv("UTF-8", "CP1250//TRANSLIT", $data['orders']->note));


        $pdf -> Ln();

        $pdf->Cell(50,10,'Your delivery address : ');
        $pdf->Cell(35,10,$data['orders']->address);
        $pdf -> Ln();

        $pdf->Cell(50,10,'Your email : ');
        $pdf->Cell(35,10,$data['orders']->useremail);
        $pdf -> Ln();


        $detailOrder = $data['orders']->details; 
        // var_dump($detailOrder[0]['product_name']);die();
        
        $pdf->Cell(276,5,' '.count($detailOrder).' product(s) in your bill',0,0,'C');
        $pdf -> Ln();
        $pdf -> Ln();
        $pdf -> Ln();
        
        $total_money = 0;
        foreach($detailOrder as $key => $value){

            $pdf->Cell(276,5,'----------------------'.'Product : '.($key + 1).'----------------------',0,0,'C');
            $pdf -> Ln();

            $pdf->Cell(50,10,'Price product : ');
            $pdf->Cell(35,10,currency_format($value['price_buy']));
            $pdf -> Ln();

            $pdf->Cell(50,10,'Quantity : ');
            $pdf->Cell(35,10,$value['quantity']);
            $pdf -> Ln();
            
            $pdf->Cell(50,10,'Order time : ');
            $pdf->Cell(35,10,date("D-d-m-Y H:i:s",($value['created_at'] + 18000) ) );
            $pdf -> Ln();

            $pdf->Cell(50,10,'Name product : ');
            $pdf->Cell(35,10,$value['product_name']);
            $pdf -> Ln();

            $total = $value['quantity'] * $value['price_buy'];

            $pdf->Cell(50,10,'=> Total product '.($key + 1).' : ');
            $pdf->Cell(35,10,(currency_format($total)));
            $pdf -> Ln();

            // $pdf->Cell(50,10,'Image: ');

            // $pdf->Image($value['product_image']);
            // $pdf->Cell(90, 120, "", 0, 1, 'C',$pdf->Image($value['product_image'],10,70,0,90));
            // $pdf->Image($value['product_image'], 10, 10, 200);
            // $pdf->Image('images2.jpg', 220, 10, 200);

            $pdf -> Ln();

            $total_money += $value['quantity'] * $value['price_buy'] ; 

            // var_dump($value['price_buy']);
            // var_dump($value['quantity']);
            // var_dump($value['created_at']);

            // var_dump($value['product_name']);
            // var_dump($value['product_image']);
        }

        $pdf->Cell(80,10,'TOTAL AMOUT TO BE PAID : ');
        $pdf->Cell(35,10,currency_format($total_money));
        $pdf -> Ln();
        $pdf -> Ln();
        $pdf -> Ln();

        $pdf->Cell(138,5,'YOUR SIGNATURE',0,0,'C');

        $pdf->Cell(138,5,'EMPLOYEE SIGNATURE',0,0,'C');
        $pdf -> Ln();

        $pdf->output();

        // foreach(){
        //     $pdf->Cell(35,10,$data['orders']->username,1,0,'L');

        // }


        // foreach ($data['orders'] as $key => $row) {
            
        //    echo $row->username;

        //     foreach($row->details as $orderDetail) {
        //         echo $orderDetail['product_name'];
        //     }

        // }
        
        
        // $pdf->Cell(40,10,'Your Bill',0,0,'C');

        // $pdf -> Ln();

        // $pdf->Cell(35,10,'ID',1,0,'L');
        // $pdf->Cell(35,10,'Order_ID',1,0,'L');
        // $pdf->Cell(35,10,'Product_ID',1,0,'L');
        // $pdf->Cell(35,10,'Price_Buy',1,0,'L');
        // $pdf->Cell(35,10,'Quantity',1,0,'L');

        

        // $pdf->Cell(35,10,$data['id'],1,0,'L');
        // $pdf->Cell(35,10,($data['order_id']),1,0,'L');
        // $pdf->Cell(35,10,$data['product_id'],1,0,'L');
        // $pdf->Cell(35,10,$data['price_buy'],1,0,'L');
        // $pdf->Cell(35,10,$data['quantity'],1,0,'L');
        // $pdf->Ln();



        // $pdf->$orderDetail->findOrder($id);
        
    }


    public function updateStatus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request = (object)$_POST;
            $modelOrder = new Order();

            $status = $modelOrder->updateStatus($request->id, $request->status);

            if($status) {
                $_SESSION['alertSuccess'] = "Cập nhật trạng thái thành công";
            } else {
                $_SESSION['alertDanger'] = "Cập nhật trạng thái không thành công";
            }
            
        }

        return header('Location: /admin/orders');
    }
}