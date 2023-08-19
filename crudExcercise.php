<?php

    $hostname = "localhost";
    $username = "root";
    $password = "1234567890";
    $db_name = "fruitshop";

    $connection = mysqli_connect($hostname, $username, $password, $db_name);

    if($connection === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // echo "Connect Successfully. Host info: " . mysqli_get_host_info($connection);

    $unit_list = array('kilograms','grams','pieces','pounds','box','sack');

    function getFruitList($conn){
        return mysqli_query($conn, "SELECT * FROM fruits");
    }

    function addFruits($data_list,$conn){
        $value1 = strval($data_list[0]);
        $value2 = strval($data_list[1]);
        $value3 = strval($data_list[2]);

        return mysqli_query($conn, "INSERT INTO fruits(fruit_name,inStock,unit_id,fruit_image,created_by,updated_by) VALUES('$value1',50,'$value2','$value3',2,3)");
    }

    function deleteFruits($conn,$id){
        return mysqli_query($conn, "DELETE FROM fruits WHERE fruit_id = $id");
    }

    function updateFruits($data_list,$conn){
        return mysqli_query($conn, "UPDATE fruits SET fruit_name = '$data_list[0]', unit_id = $data_list[1], fruit_image = '$data_list[2]' WHERE fruit_id = $data_list[3]"); 
    }

    if(isset($_POST['add-btn'])){
        $data_list =  array(
                $_POST['fruit-name'],
                (int)$_POST['unit-id'],
                $_POST['fruit-image'],
            );
 

        addFruits($data_list,$connection);

    };

    if(isset($_POST['update-btn'])){
        $data_list =  array(
                $_POST['fruit-name'],
                (int)$_POST['unit-id'],
                $_POST['fruit-image'],
                (int)$_POST['id'],
            );
 

        updateFruits($data_list,$connection);

    };


    if(isset($_GET['delete'])){
        $id = (int)$_GET['delete'];

        deleteFruits($connection,$id);
    };


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD | PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="w-100 text-center mt-5">FRUIT DATABASE</h1>

    <div class="container w-50 mt-5">
        <form action="" method="post" class="d-flex flex-column">
            <label for="id">
                Fruit ID
                <input readonly type="text" name="id" class="user-inputs form-control" placeholder="Auto Generated">'
            </label>
            <label for="fruit_name">
                Fruit Name
                <input type="text" name="fruit-name" class="user-inputs form-control">
            </label>
            <label for="fruit_image">
                Fruit Name
                <input type="file" name="fruit-image" class="user-inputs form-control">
            </label>
            <label for="unit">
                Unit
                <select type="text" name="unit-id" class="user-inputs form-select">
                    <option value="">Select Unit</option>
                    <option value="1">Kilograms</option>
                    <option value="2">Grams</option>
                    <option value="3">Pieces</option>
                    <option value="4">Pounds</option>
                    <option value="5">Box</option>
                    <option value="6">Sack</option>
                </select>
            </label>
            <div class="d-flex flex-row column-gap-2  justify-content-end mt-3">
                    <Button submit="submit" name="update-btn" class="btn btn-warning" >Update</Button> 
                    <button submit="submit" name="add-btn" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Fruit Id</th>
                    <th>Fruit Image</th>
                    <th>Fruit Name</th>
                    <th>Unit Id</th>
                    <th>In Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $fruit_list = getFruitList($connection);
                    while($row = mysqli_fetch_array($fruit_list)){
                ?>
                    <tr>
                        <td><?php echo $row['fruit_id'] ?></td>
                        <td><img width="50" height="35" src="./images/<?php echo $row['fruit_image']?>" alt=""></td>
                        <td><?php echo $row['fruit_name'] ?></td>
                        <td><?php echo $unit_list[(int)$row['unit_id']-1] ?></td>
                        <td><?php echo $row['inStock'] ?></td>
                        <td class="d-flex flex-row column-gap-2 justify-content-center">
                            <Button id="<?php echo $row['fruit_id']; ?>" class="btn btn-warning edit-btn" >Edit</Button>
                            <a href="./crudExcercise.php?delete=<?php echo $row['fruit_id']; ?>"><button class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        const edit_btn = document.querySelector('.edit-btn');
        const user_inputs = document.querySelectorAll('.user-inputs');
       
        edit_btn.onclick = (e) =>{
            user_inputs[0].value = e.target.id
        }
    </script>
</body>
</html>