<!-- <?php include "connect_db.php" ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>
<body>
    <?php include 'nav-menu.php'; ?>
    <div class="fs-2 text-center mt-2 fw-bold">Category list</div>

    <div class="container-fluid">
        <div class="card-body text-end">
            <a href="category_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add new category</a>
        </div>
    </div>

    <div class="container-fluid mt-2">
        <table id="myTable" class="table table-bordered table-hover">
            <thead style="background-color: #2E2D2D; color: #ffffff;">
                <th class="fs-6 text-center">No</th>
                <th class="fs-6 text-start">Category Name</th>
                <th class="fs-6 text-center">Status</th>
                <th class="fs-6 text-center">Action</th>

                
            </thead>

            
                <?php
                    $query = "SELECT * FROM tb_category ORDER BY category_id";
                    $result = mysqli_query($conn, $query);
                    $result_num = mysqli_num_rows($result);
                    if ($result_num > 0){
                        foreach($result as $rows){
                            $category_id = $rows['category_id'];
                            $category_name = $rows['category_name'];
                        
                            $category_active = $rows['category_active'];
                            
                            ?>
                            <tr>
                                <td class="text-center"><?= $category_id ?></td>
                                <td class="text-start"><?= $category_name ?></td>
                                
                                <td class="text-center"><?= $category_active ?></td>
                            
                               
                            
                                <td class="text-center">
                                <a class="btn btn-outline-primary btn-sm" href="category_edit.php?edit_id=<?= $category_id ?>">
                                    <i class="bi bi-pen"></i> Edit
                                    </a>
                                    <a class="btn btn-outline-primary btn-sm" style="background-color: red; color: #ffffff;" href="category_delete.php?delete_id=<?= $category_id ?>">
                                    <i class="bi bi-pen"></i> Delete
                                 </td>
                                

                            </tr>

                    <?php
                        }

                    }else {
                        $sms = "ບໍ່ມີຂໍ້ມູນບັນທຶກ";
                        echo '<tr>
                        <td colspan="9" align="center>"'.$sms.'</td>
                        </tr>'; 
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>
