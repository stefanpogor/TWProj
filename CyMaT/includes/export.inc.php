<?php
require('../libs/fpdf.php');

if (isset($_POST['exportbtn'])){

    require 'database.inc.php';

    $option = $_POST['where'];

    if ($option=='produse'){
        $sql = "SELECT * FROM products";
    }

    if ($option=='comenzi-furnizori'){
        $sql = "SELECT * FROM comenzif";
    }

    $result=mysqli_query($conn, $sql);
    $num_rows=mysqli_num_rows($result);

    $filetype=$_POST['filetype'];


    if ($num_rows>0){

        if($filetype=='csv'){

            $delimiter = ",";
            $filename = $option."-data_".date('Y-m-d').".csv";

            $filep = fopen('php://memory', 'w');

            $fields_prod = array ('ID', 'PRODUCT NAME', 'PRODUCT PROVIDER', 'PRODUCT PRICE', 'PRODUCT STOCK', 'PRODUCT IMAGE PATH');
            $fields_com = array('ID', 'ORDERED PRODUCT NAME', 'ORDER PROVIDER', 'EMAIL PROVIDER', 'STOCK REQUIRED', 'ORDER PRICE', 'ORDER DELIVERY APPRAISAL', 'DELIVERED');

            if ($option=='produse'){
                fputcsv($filep, $fields_prod, $delimiter);
                while ($row = mysqli_fetch_assoc($result)){
                    $data = array($row['pid'], $row['pname'], $row['pprovider'], $row['pprice'], $row['pcount'], $row['pimg']);
                    fputcsv($filep, $data, $delimiter);
                }
            }

            if ($option=='comenzi-furnizori'){
                fputcsv($filep, $fields_com, $delimiter);
                while ($row = mysqli_fetch_assoc($result)){
                    $data = array($row['cid'], $row['cnume'], $row['cfurnizor'], $row['cmailf'], $row['ccount'], $row['cpret'], $row['cestimat'], $row['clivrat']);
                    fputcsv($filep, $data, $delimiter);
                }
            }

            fseek($filep, 0);

            header('Content-Type: text/csv');
            header('Content-Disposition: attachement; filename="'.$filename.'";');

            fpassthru($filep);
    }

    if($filetype=='json'){

        $filename = $option."-data_".date('Y-m-d').".json";
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
        echo json_encode($emparray);
        $fp = fopen($filename, 'w');
        fwrite($fp, json_encode($emparray));

        header('Content-Type: text/json');
        header('Content-Disposition: attachement; filename="'.$filename.'";');
        fclose($fp);
    }

    if($filetype=='pdf'){

        $filename = $option."-data_".date('Y-m-d').".pdf";

        if($option == 'produse'){
            $display_heading = array('pid'=>'ID', 'pname'=> 'Name', 'pprovider'=> 'Provider','pprice'=> 'Price', 'pcount'=>'Count', 'pimg'=> 'ImagePath',);
            $result1 = mysqli_query($conn, "SELECT pid, pname, pprovider, pprice, pcount FROM products") or die("database error:". mysqli_error($conn));

            $pdf=new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',24);
            $pdf->Cell(50,7,'Produse');
            $pdf->SetFont('Arial','B',10);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetFont('times','B',10);
            $pdf->Cell(40,7,"ID");
            $pdf->Cell(40,7,"Nume");
            $pdf->Cell(40,7,"Furnizor");
            $pdf->Cell(40,7,"Pret");
            $pdf->Cell(40,7,"Cantitate");
        }
        else {
            $display_heading = array('cid'=>'ID', 'cnume'=> 'Name', 'cfurnizor'=> 'Provider', 'ccount'=>'Count', 'cpret'=> 'Price', 'cestimat'=> 'ETA', 'clivrat'=> 'Delivered',);
            $result1 = mysqli_query($conn, "SELECT cid, cnume, cfurnizor, ccount, cpret, cestimat, clivrat FROM comenzif") or die("database error:". mysqli_error($conn));

            $pdf=new FPDF();
            $pdf->AddPage('L');
            $pdf->SetFont('Arial','B',24);
            $pdf->Cell(50,7,'Comenzi furnizori');
            $pdf->SetFont('Arial','B',10);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetFont('times','B',10);
            $pdf->Cell(40,7,"ID");
            $pdf->Cell(40,7,"Nume");
            $pdf->Cell(40,7,"Furnizor");
            $pdf->Cell(40,7,"Cantitate");
            $pdf->Cell(40,7,"Pret");
            $pdf->Cell(40,7,"Estimat");
            $pdf->Cell(40,7,"Livrat");
        }

        foreach($result1 as $row) {
            $pdf->Ln();
            
            foreach($row as $column){
                $pdf->Cell(39,12,$column,1);
            }
        }
        
        $pdf->Output();
        header('Content-Type: text/pdf');
        header('Content-Disposition: attachement; filename="'.$filename.'";');
    }

    }
    exit;  
}