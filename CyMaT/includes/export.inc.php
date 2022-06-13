<?php

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

    if ($num_rows>0){
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
    exit;  
}