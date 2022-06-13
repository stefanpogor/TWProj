<?php

if (isset($_POST['importbtn'])){

    require 'database.inc.php';
    $upload_dir = '../imports/';
    $upload_file = $upload_dir . basename($_FILES['imp']['name']);
    move_uploaded_file($_FILES['imp']['tmp_name'], $upload_file);

    $option = $_POST['where'];

    $filename = $_FILES['imp']["name"];
    
    $tmp = explode('.', $filename);
    $ext = end($tmp);

    if ($ext=="csv"){

        if ($_FILES['imp']["size"]>0){
            
            $file=fopen($upload_file, 'r');
            fgetcsv($file);
            if ($option=="produse"){

                while(($line=fgetcsv($file))!==FALSE){
                    $name=$line[1];
                    $provider=$line[2];
                    $price=$line[3];
                    $stock=$line[4];
                    $imagepath=$line[5];

                    $sqlifexists = "SELECT pid FROM products WHERE pname ='".$line[1]."'";
                    $ifexistsres = mysqli_query($conn, $sqlifexists); 
                    $num_rows = mysqli_num_rows($ifexistsres);

                    if ($num_rows>0){
                        $sql="UPDATE products SET pname = '".$name."', pprovider = '".$provider."', pprice = '".$price."', pcount = '".$stock."', pimg = '".$imagepath."' WHERE pname ='".$line[1]."'";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_execute($stmt);
                        }
                    } else{
                        $sql="INSERT INTO products (pname, pprovider, pprice, pcount, pimg) VALUES (?,?,?,?,?)";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt, "ssiis", $name, $provider, $price, $stock, $imagepath);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: ../html/admin_import_page.php?import=success");
                fclose($file);
                exit();
            } else {
                
                while(($line=fgetcsv($file))!==FALSE){
                    $name=$line[1];
                    $provider=$line[2];
                    $email=$line[3];
                    $stock=$line[4];
                    $price=$line[5];
                    $date=$line[6];
                    $delivered=$line[7];

                    $sqlifexists = "SELECT cid FROM comenzif WHERE cnume ='".$line[1]."'";
                    $ifexistsres = mysqli_query($conn, $sqlifexists); 
                    $num_rows = mysqli_num_rows($ifexistsres);

                    if ($num_rows>0){
                        $sql="UPDATE comenzif SET cnume = '".$name."', cfurnizor = '".$provider."', cmailf = '".$email."', ccount = '".$stock."', cpret = '".$price."', cestimat='".$date."', clivrat='".$delivered."' WHERE cnume ='".$line[1]."'";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_execute($stmt);
                        }
                    } else{
                        $sql="INSERT INTO comenzif (cnume, cfurnizor, cmailf, ccount, cpret, cestimat, clivrat) VALUES (?,?,?,?,?,?,?)";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt, "sssiiss", $name, $provider, $email, $stock, $price, $date, $delivered);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                fclose($file);
                header("Location: ../html/admin_import_page.php?import=success");
                exit();
            }
        }
    }

    if ($ext=="json"){

        if ($_FILES['imp']["size"]>0){

            $data=file_get_contents($upload_file);
            $products=json_decode($data);

            if($option=="produse"){
                foreach($products as $product){

                    $name=$product->prodname;
                    $provider=$product->prodprovider;
                    $price=$product->prodprice;
                    $stock=$product->prodstock;
                    $imagepath=$product->prodimpth;

                    $sqlifexists = "SELECT pid FROM products WHERE pname ='".$name."'";
                    $ifexistsres = mysqli_query($conn, $sqlifexists); 
                    $num_rows = mysqli_num_rows($ifexistsres);

                    if ($num_rows>0){
                        $sql="UPDATE products SET pname = '".$name."', pprovider = '".$provider."', pprice = '".$price."', pcount = '".$stock."', pimg = '".$imagepath."' WHERE pname ='".$name."'";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_execute($stmt);
                        }
                    } else{
                        $sql="INSERT INTO products (pname, pprovider, pprice, pcount, pimg) VALUES (?,?,?,?,?)";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt, "ssiis", $name, $provider, $price, $stock, $imagepath);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: ../html/admin_import_page.php?import=success");
                exit();
            } else {

                $data=file_get_contents($upload_file);
                $orders=json_decode($data);

                foreach($orders as $order){
                    
                    $name=$order->comname;
                    $provider=$order->comprovider;
                    $email=$order->commailf;
                    $stock=$order->comstock;
                    $price=$order->comprice;
                    $date=$order->comdate;
                    $delivered=$order->comdelivered;

                    $sqlifexists = "SELECT cid FROM comenzif WHERE cnume ='".$line[1]."'";
                    $ifexistsres = mysqli_query($conn, $sqlifexists); 
                    $num_rows = mysqli_num_rows($ifexistsres);

                    if ($num_rows>0){
                        $sql="UPDATE comenzif SET cnume = '".$name."', cfurnizor = '".$provider."', cmailf = '".$email."', ccount = '".$stock."', cpret = '".$price."', cestimat='".$date."', clivrat='".$delivered."' WHERE cnume ='".$name."'";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_execute($stmt);
                        }
                    } else{
                        $sql="INSERT INTO comenzif (cnume, cfurnizor, cmailf, ccount, cpret, cestimat, clivrat) VALUES (?,?,?,?,?,?,?)";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../html/admin_import_page.php?error=sqlerror");
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt, "sssiiss", $name, $provider, $email, $stock, $price, $date, $delivered);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: ../html/admin_import_page.php?import=success");
                exit();
            }  
        }
    }

} else {
    header("Location: ../html/admin_import_page.php");
}