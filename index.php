<!-- PHP/CRUD -->
<?php
$insert=false;
$update=false;
$delete=false;

$servername="localhost";
$username="root";
$password="";
$database="notes";


// create a connection

$conn = mysqli_connect($servername,$username,$password,$database);
// check for the database creation success:

//DIE IF CONNECTION WAS NOT SUCCESSFUL

if(!$conn){
    
die("sorry we failed to connect:-".mysqli_connect_error());
    
}
    if(isset($_GET['delete'])){
      $sno=$_GET['delete'];      
      
      $sql= "DELETE FROM `notes` WHERE `Sno.` = $sno";
      $result= mysqli_query ($conn,$sql);
    }
    if ($_SERVER['REQUEST_METHOD'] =='POST'){
      if(isset($_POST['snoEdit'])){
        // UPDATE THE RECORD
        $sno = $_POST['snoEdit'];
        $title= $_POST["titleEdit"];
        $description= $_POST["descriptionEdit"];

        //sql query to be executed
      
        $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno.` = $sno"; 
         $result=mysqli_query($conn,$sql);
  if($result){
   
      $update=true;
  }
else{
    echo "we could not update the record successfully";
}
}
else{
    $title= $_POST["title"];
    $description= $_POST["description"];

        // -- sql query to be executed
  $sql="INSERT INTO `notes` ( `title`, `description`) VALUES ( '$title', '$description')";
  $result= mysqli_query($conn,$sql);

  // ADD A NEW TRIP TABLE IN THE DATABASE      
  if($result){
          $insert=true;
        }
else{
      echo"The record has been inserted not successfully because of this error------>".mysqli_error($conn);
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

  <title>E-notes - Notes taking make easy </title>


</head>


<body>
  

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/CRUD/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="Text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <br>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="/CRUD/logo.svg" height="28px" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>

          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
          </li>
          </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control my-3" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-3 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php

        if($insert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS!</strong> Your note submitted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }

      ?>

  <?php

    if($update){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>SUCCESS!</strong> Your note has been updated successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    ?>

  <?php

if($delete){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>SUCCESS!</strong> Your note has been delete successfully.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

  <div class="container my-4">
    <h3>Add a notes here</h3>
    <form action="/CRUD/index.php" method="POST">
      <div class="form-group mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="Text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>

  </div>

  <div class="container my-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- -------------------------------------------------------------- FETCH DATABASE ---------------------------------------------------   -->
        <?php

          $sql= "SELECT * FROM `notes`";
          $result= mysqli_query ($conn,$sql);
          $sno = 0;
          while($row= mysqli_fetch_assoc($result)){                        # THIS {mysqli_fetch_assoc} FUNCTION IS USED FOR DISPLAY THE SQL QUERY.
          $sno = $sno+1;
          echo  "<tr>
          <th scope='row'>".$sno."</th>
          <td>".$row['title']."</td>
          <td>".$row['description']."</td>
          <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno.'].">Edit</button>    <button class='delete btn btn-sm btn-primary' id=d".$row['sno.'].">Delete</button> </td>
        </tr>";
          }
          ?>
        <!-- -------------------------------------------------------------------- FETCH END -------------------------------------------------- -->
      </tbody>
    </table>
  </div>
  <!-- optional JavaScript -->
  <!-- jqquery first then popper.js, then Bootstrap 35 -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');

      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        sno = e.target.id.substr(1,);
        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes")
          window.location = `/CRUD/index.php?delete=${sno}`;

          //TODO: Create a new form and use post request to submit a form




        }
        else {
          console.log("no");

        }


      })
    })

  </script>

</body>

</html>