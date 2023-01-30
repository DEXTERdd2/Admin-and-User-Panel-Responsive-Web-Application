<?php require_once 'connection.php'; ?>

<?php
session_start();

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();
} else {
    header('location: ./login.php');
}

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `books` WHERE `book_id` = $id";
$result = $conn->query($sql);
$book = $result->fetch_assoc();

$b_name = $book['book_name'];
$desc = $book['book_desc'];
$book_author = $book['book_author'];
$price = $book['book_price'];
$publish = $book['publishing_year'];

$error = $success = '';

if (isset($_POST['submit'])) {
    $b_name = htmlspecialchars($_POST['b_name']);
    $desc = htmlspecialchars($_POST['desc']);
    $book_author = htmlspecialchars($_POST['book_author']);
    $price = htmlspecialchars($_POST['price']);
    $publish = htmlspecialchars($_POST['publish']);
   
    if (empty ($b_name)) {
        $error =  "Book name please";
    } elseif (empty ($desc)) {
        $error = "Description please";
    }elseif (empty ($book_author)) {
            $error = "Book Author please";
    }elseif (empty ($price)) {
            $error = "Price please";
    }elseif (empty ($publish)) {
                $error = "Publishing year please";
   
    } else {
        $sql = "UPDATE `books` SET `book_name`='$b_name',`book_desc`='$desc',`book_author`='$book_author',`book_price`='$price',`publishing_year`='$publish' WHERE `book_id`=$id";
        if ($conn->query($sql)) {
            $success= 'Added!';
            header('Location:./submit.php');
        } else {
            $error = 'Failed to add!';
        }
    }
}
} 

else {
    header('location: ./submit.php');
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
                <a href="submit.php" class="spur-logo"><i class="fas fa-bolt"></i> <span>Books</span></a>
                <h3>Admin PANEL</h3>
            </header>
            
            <?php require_once './includes/navbar.php'; ?>
        </div>
        
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/spur.js"></script>

        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="submit.php" class="spur-logo"><i class="fas fa-bolt"></i> <span>Books</span></a>
            </header>
            
            <?php require_once './includes/navbar.php'; ?>
        </div>
        
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/spur.js"></script>
<div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="#!" class="searchbox-toggle">
                    <i class="fas fa-search"></i>
                </a>
                <form class="searchbox" action="#!">
                    <a href="#!" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
                    <button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
                    <input type="text" class="searchbox-input" placeholder="type to search">
                </form>
                <div class="tools">
                    <a href="https://github.com/HackerThemes/spur-template" target="_blank" class="tools-item">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#!" class="tools-item">
                        <i class="fas fa-bell"></i>
                        <i class="tools-item-count">4</i>
                    </a>
                    <div class="dropdown tools-item">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="#!">Profile</a>
                            <a class="dropdown-item" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </header>
            <main class="dash-content">
                <div class="container-fluid">
                    <h1 class="dash-title"> Edit Books</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <div class="text-success"><?php echo $success; ?></div>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $id; ?>" method="post">
                                        <div class="mb-2">
                                            <label for="name">Book Name</label>
                                            <input type="text" class="form-control" name="b_name" id="name" value="<?php echo $b_name ?>" placeholder="Name please">
                                        </div>
                                        <div class="mb-2">
                                            <label for="reg_no">Description</label>
                                            <input type="text" class="form-control" name="desc" id="desc" value="<?php echo $desc ?>" placeholder="Description">
                                        </div>
                                        <div class="mb-2">
                                            <label for="book_author">Book Author</label>
                                            <input type="text" class="form-control" name="book_author" id="book_author" value="<?php echo $book_author ?>" placeholder="Book Author">
                                        </div>
                                        <div class="mb-2">
                                            <label for="book_price">Book Price</label>
                                            <input type="text" class="form-control" name="price" id="price" value="<?php echo $price ?>" placeholder="Book Price">
                                        </div>
                                        <div class="mb-2">
                                            <label for="publishing_year">Publishing Year</label>
                                            <input type="text" class="form-control" name="publish" id="publish" value="<?php echo $publish ?>" placeholder="Book Price">
                                        </div>

                                        <div class="mb-2">
                                            <a href="./submit.php"><input type="submit" value="Submit" name="submit" class="btn btn-primary"></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </main>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>