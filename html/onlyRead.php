<?php require_once 'connection.php'; ?>
<?php

session_start();


if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
} else {
   return header('location: ./login_users.php');
}

$name=$error=$success=$description='';


$sql = "SELECT * FROM `ratings`";
$result = $conn->query($sql);
$ratings = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `books`";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    if (empty($name)) {
        $error = " Please Enter your name!";
    } elseif (empty($description)) {
        $error = "Please write a review to submit!";
    } else {
        $sql = "INSERT INTO `ratings`(`name`, `description`) VALUES ('$name','$description')";
        if ($conn->query($sql)) {
            $success= 'Review Added!';
        }else {
            $error = 'Failed to add review!';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/spur.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="../js/chart-js-config.js"></script>
    <title>Books</title>
</head>

<body>
    <div class="dash-nav dash-nav-dark">
        <header>
            <a href="#!" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>
            <a href="#" class="spur-logo"><i class="fas fa-bolt"></i> <span>Books </span></a>
        </header>


        <h3>Only Read MODE</h3>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/spur.js"></script>

    <div class="dash-app">
        <header class="dash-toolbar">
       
            <div class="tools">
           
                </a>
                <a href="#!" class="tools-item">
               
                </a>
                <div class="dropdown tools-item">

                    <div>
                        <a href="./logoutUser.php"><button style="width: 100px;" class="btn btn-secondary mt-4">Log Out</button> </a>
                    </div>
                </div>
            </div>
        </header>
        
        <h3 class="bg-dark" style="color: white;">User PANEL</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">BOOKS TO SEE</h5>

                    </div>
                    <div class="card-body">
                        <?php
                        if (count($books) > 0) { ?>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Description</th>
                                        <th>Book Author</th>
                                        <th>Price</th>
                                        <th>Publishing Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($books as $book) {
                                    ?>
                                        <tr>
                                            <td><?php echo $book['book_name']; ?></td>
                                            <td><?php echo $book['book_desc']; ?></td>
                                            <td><?php echo $book['book_author']; ?></td>
                                            <td><?php echo $book['book_price']; ?></td>
                                            <td><?php echo $book['publishing_year']; ?></td>
                                            <td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>

                        <?php
                        } else {
                            echo "No students Found!";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- <button style="margin-left:80%;" class="btn btn-info " onclick="history.back()">Go Back</button>` -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Reviews</h3>

                    </div>
                    <div class="card-body">
                        <div class="text-danger"><?php echo $error; ?></div>
                        <div class="text-success"><?php echo $success; ?></div>
                        <?php
                        if (count($ratings) > 0) { ?>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($ratings as $rating) {
                                    ?>
                                        <tr>
                                            <td><?php echo $rating['name']; ?></td>
                                            <td><?php echo $rating['description']; ?></td>
                                            
                                        </tr>
                                       
                                    <?php
                                    }
                                    ?>
   <div class="mt-2">
                                                <label for="Name">Name</label>
                                                <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
                                            </div>
                                            <div class="mb-4"><label for="Desc">Description</label>
                                                <textarea rows="4" cols="50" name="comment" class="form-control" name="description" form="usrform" value="<?php echo $description ?>" placeholder="Enter Review"></textarea>
                                                </div>
                                             <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                                                
                                </tbody>
                                <h3>Previous Reviews</h3>
                            </table>

                        <?php
                        } else {
                            echo "No Reviews Found!";
                        }
                        ?>
                      
                    </div>
                </div>
            </div>
        </div> 
    </div>
  