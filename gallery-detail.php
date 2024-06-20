<?php 
 session_start();
?>


 <!--Edit Product code Start -->
 
 <?php 
include('dbcon.php');
   if(isset($_POST['change']))
   {
    $sub=$_POST['sbmid'];
    
$name=$_POST['name'];
$start=$_POST['start'];
$end=$_POST['end'];
$about= str_replace( array( '\'', '"',
',' , ';', '<', '>' ), ' ', $_POST['about']);
$address=$_POST['address'];

if($_FILES['image']['name']){
$image_name1=$_FILES['image']['name'];                  /* Upload a image 1 */
$image_size=$_FILES['image']['size'];
$image_type=$_FILES['image']['type'];
$image_tmp=$_FILES['image']['tmp_name'];
$store="images/".$image_name1;                               /* location to store image 1 */
$upload=move_uploaded_file($image_tmp,$store);

}
else{
  $image_name1=$_POST['imghid'];
}


  $result=mysqli_query($con,"UPDATE tbl_gallery SET name='$name',about='$about',address='$address',image='$image_name1',start='$start',end='$end' where gallary_id='$sub'");
  if($result==true)
   {
     echo"<script>alert('Your details has been Updated');window.href='gallery-detail.php';</script>";
   }
   else
   {
    echo "Error".mysqli_error($con);
   }
   }
   ?>
   
 <!--Edit Product code End -->
 
 
 
 <!--Delete Product code Start -->
 
<?php

error_reporting(0);
if($_GET['id'])
{

$j=$_GET['id'];

$query=mysqli_query($con,"DELETE FROM tbl_gallery WHERE  gallary_id='$j' ");
if($query)
{
   echo"<script>alert('Your details has been Deleted');
     window.location.href='gallery-detail.php';</script>";
}
else{
  echo"<script>alert('Detail has not deleted');window.location.href='gallery-detail.php';</script>";
}
}
?>

<!--Delete Product code End -->


 
 







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Kutumb Properties : Project Master List</title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!--Data Tables -->
  <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>


  <!---start code for dependent dropdown---->
      <script type="text/javascript">
    function myfunction(datavalue)
    {
        $.ajax({
        url: 'ajax2.php',
        type: 'post',
        data: { datapost : datavalue},

        success : function(result){
        $('#dataget').html(result);
        }
        });
    }
    
    </script>     
<!---end code of dependent dropdown--->
  
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
   <!--Start sidebar-wrapper-->
   
   <?php include('sidebar.php'); ?>
   
   <!--End sidebar-wrapper-->

<!--Start topbar header-->

<?php include('header.php'); ?>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
    



      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>Temple Detail</div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>About</th>
                        <th>Address</th>
                        <th>Photo</th>
                        
                        <th>Time</th>
                         <th>Action</th>

                        
                    </tr>
                </thead>
                <tbody>
				
			 <?php 
        $a=1;
        $query=mysqli_query($con,"SELECT gallary_id,start,end,TIME_FORMAT(start,'%h:%i %p'),TIME_FORMAT(end,'%h:%i %p'),name,address,about,image FROM `tbl_gallery`");
      
        

        ?>
        

        <?php while($row=mysqli_fetch_array($query)){ 
            
            
       
  
    ?>   
                    <tr>
                        
                        
                        
          
                        
                        
                        <td><?php echo $a;?></td>
                       
            
           <!--menu fech by id--> 
            
                     <!--menu fecth by id end-->
                   
                     
                     <td><?php echo $row['name'];?> </td>
                  
                     <td style="overflow-x:scroll;max-width:10rem;"><?php echo $row['about']?></td>
            <td><?php echo $row['address']?></td>

            <td ><img src='images/<?php echo $row["image"];?>'   height="100"></td>
            <td><?php echo $row["TIME_FORMAT(start,'%h:%i %p')"]; ?> - <?php echo $row["TIME_FORMAT(end,'%h:%i %p')"]; ?></td>
            


 <td>					
					
<i class="fa fa-edit" data-toggle="modal" data-target="#m<?php echo $row['gallary_id'];?>" style="font-size:23px;color:blue"></i> / 
<a onclick="return confirm('Are you sure want to delete ?');" style="color:white" href="gallery-detail.php?id=<?php echo $row['gallary_id'];?>"> <i class="fa fa-trash-o" style="font-size:23px;color:red"></i></a>					
					</td>
                    </tr>
					
					
<!-- start Popup Modal -->

<div class="modal fade" id="m<?php echo $row['gallary_id'];?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Temple Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	   <form method="post" action="#" enctype="multipart/form-data">
	  <input type="hidden" name="sbmid" value="<?php echo $row['gallary_id'];?>">
    <input type="hidden" name="imghid" value="<?php echo $row['image'];?>">
      <div class="modal-body mx-3 ">
        

                
                
            <div class="form-group row">
                  <label for="input-14" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text"  name="name" class="form-control" id="input-16" placeholder="State Name.." required value="<?php echo $row['name'] ?>">
                  </div>
                
                 
                </div>
                <div class="form-group row">
                <label for="input-14" class="col-sm-2 col-form-label">Timing</label>
                
                  <div class="col-sm-4">
                  
                    <input type="time"  name="start" class="form-control" id="input-16" placeholder="State Name.." required value="<?php echo $row["start"]; ?>"> 
                  </div>
                  
                  <div class="col-sm-4">
         
                  



                  
                    <input type="time"  name="end" class="form-control" id="input-16" placeholder="State Name.." required value="<?php echo $row['end']; ?>">
                  </div>
               </div> 
               <div class="form-group row">
                  <label for="input-17" class="col-sm-2 col-form-label">About</label>
                  <div class="col-sm-10">
                    <textarea class="form-control ckeditor" name="about" rows="4" id="input-17"  placeholder="State About.." required><?php echo $row['about'];?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-16" class="col-sm-2 col-form-label" >Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-16" name="address"  placeholder="State Address.." required value="<?php echo $row['address']; ?>">
                  </div>
                </div>
				<div class="form-group row">
                  <label for="input-16" class="col-sm-2 col-form-label">Upload Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="input-16" name="image" value="<?php echo $row['image']; ?>">
                  </div>
                </div>
    

      </div>
	    <div class="modal-footer d-flex justify-content-center">
      <center>  <button type="submit" class="btn btn-primary" name="change">Save Changes</button></center>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- End Popup Modal -->

					<?php $a++;}?>
					
                    <!--tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>-->
                  
                </tbody>
                <!--tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>-->
            </table>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<?php include('footer.php');?>
	<!--End footer-->
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
	<!-- simplebar js -->
	<script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- waves effect js -->
  <script src="assets/js/waves.js"></script>
	<!-- sidebar-menu js -->
	<script src="assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>

  <!--Data Tables js-->
  <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
   <script src="ckeditor/ckeditor.js"></script>
   

    <script>
     $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable();


       var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ ]
      } );
 
     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
      } );

    </script>
	
</body>

</html>
