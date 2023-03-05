<?php
    require('dbconnect.php');
    $name=$_POST['name'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];
    $stamp=$_POST['stamp'];
    $Delete=$_POST['delete_item'];
    $Edit=$_POST['edit_item'];
    $rownum = mysqli_num_rows(mysqli_query($con,"SELECT * FROM products"));
    if(!empty($name)){
        $rowcount = mysqli_query($con,"SELECT product_id FROM products");
        $existed = array(0);
        while($row = mysqli_fetch_assoc($rowcount)){
            array_push($existed,$row['product_id']);
        }
        $compare_array = range(0, max($existed)+1);
        $missing_values = array_diff($compare_array, $existed);
        $value = array_pop(array_reverse($missing_values));
        $insert = "INSERT INTO products (product_id, product_name, product_price, product_quantity, product_stamp) VALUES ($value,'$name',$price,$quantity,$stamp) ON DUPLICATE KEY UPDATE product_name = '$name'";
        mysqli_query($con,$insert);
    }
    else if(!empty($Delete)){
        mysqli_query($con,"DELETE FROM products WHERE product_id= $Delete");
    }
    else if(!empty($Edit)){
        for($i=1;$i<=$rownum;$i++){
            $editname = $_POST['name'.$i];
            $editprice = $_POST['price'.$i];
            $editquantity = $_POST['quantity'.$i];
            $editstamp = $_POST['stamp'.$i];
            $update = "UPDATE products SET product_name='$editname', product_price=$editprice, product_quantity=$editquantity, product_stamp=$editstamp WHERE product_id= $i";
            mysqli_query($con,$update);
        }
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Management System</title>
    <script src="src/searchbar.js"></script>
    <link href="src/style.css" rel="stylesheet">
    <style>
        table{
            border-collapse: collapse;
            width: 60rem;
        }
        th,td{
            border: 1px solid rgb(103, 232, 255);
            text-align: center;
        }
        #Edit_button{
            background-color: rgb(113, 200, 50);
        }
        #Delete_button{
            background-color: rgb(200, 50, 50);
        }
        form {
            display: inline-block;
            margin:0 0.5rem
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="nav-item"> 
                <a class="nav-link" href="index.php">
                    <svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                    <span class="link-text">Home</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="edit_items.php">
                    <svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                    <span class="link-text">Edit</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="show_items.php">
                    <svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>
                    <span class="link-text">Show</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cash_register.php">
                    <svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C46.3 0 32 14.3 32 32V96c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1C.4 368.8 0 373.6 0 378.4V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V378.4c0-4.8-.4-9.6-1.1-14.4L488.2 214.4C483.5 183.1 456.6 160 425 160H208V128h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zM96 48H256c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-168a24 24 0 1 1 0-48 24 24 0 1 1 0 48zm120-24a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM160 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM328 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM256 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM424 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM352 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48z"/></svg>
                    <span class="link-text">Cash Register</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="content">
        <h2>Storage Management</h2>
        <hr>
        <p>Add Product</p>
        <form method="post" action="edit_items.php">
            <label for="name">Product name :</label><input id="name" name="name" type="text" placeholder="กรอกชื่อสินค้า" required><br>
            <label for="price">Price :</label><input type="number" id="price" name="price" min="0" placeholder="กรอกราคาสินค้า" required><br>
            <label for="quantity">Quantity :</label><input type="number" id="quantity" name="quantity" min="1" placeholder="กรอกจำนวนสินค้า" required><br>
            <label for="stamp">Stamp :</label><input type="number" id="stamp" name="stamp" min="0" placeholder="กรอกจำนวนแสตมป์เมื่อซื้อ" required><br>
            <br><button>ตกลง</button>
        </form>
        <p>Search and Edit</p>
        <input type="text" onkeyup="filter()" class="searchbar" name="search" placeholder="Search...">
        <form id = "table" action="edit_items.php" method="post"></form>
        <button id="Edit_button" type="submit" name="edit_item" form="table" value="1">Save</button></form>
        <p>รายการสินค้า</p>
        <table id="products_T">
            <tr>
                <th style="width:10%">รหัสสินค้า</th>
                <th style="width:40%">ชื่อ</th>
                <th>ราคา</th>
                <th>จำนวนสินค้า</th>
                <th>จำนวนแสตมป์</th>
                <th>ลบ</th>
            </tr>

            <?php
                $data = mysqli_query($con,"SELECT * FROM products");
                while($row=mysqli_fetch_assoc($data)){
                    echo"<tr>";
                    echo"<td>".$row['product_id']."</td>";
                    echo"<td><input name='name".$row['product_id']."' type='text' form='table' value='".$row['product_name']."'></td>";
                    echo"<td><input name='price".$row['product_id']."' type='text' form='table' value='".$row['product_price']."'></td>";
                    echo"<td><input name='quantity".$row['product_id']."' type='text' form='table' value='".$row['product_quantity']."'></td>";
                    echo"<td><input name='stamp".$row['product_id']."' type='text' form='table' value='".$row['product_stamp']."'></td>";
                    echo'<td><form method="post" action="edit_items.php"><button id="Delete_button" type="submit" name="delete_item" value="'.$row['product_id'].'">Delete</button></form></td>';
                    echo"</tr>";
                };
            ?>
        </table>
    </div>
    
</body>
</html>