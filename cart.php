<?php

$s_id=$_SESSION['id'];
include ('connection.php');
$sql="SELECT item.id,item.image,item.title,item.price,item.c_id
        FROM item
        INNER JOIN card on card.p_id=item.id 
        where card.u_id=$s_id;
        ";
        $que=mysqli_query($conn,$sql);
        

?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-dialog-scrollable modal-xl modal-right" style="margin-left:800px; margin-top: 65px;">

    <div class="modal-content">
      <div class="modal-header">
        
        <h1 class="modal-title fs-5" id="exampleModalLabel">My Cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">image</th>
      <th scope="col">title</th>
      <th scope="col">price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php foreach($que as $row){ ?>
      <th scope="row"><?php echo $row['id']?></th>
      <td> <img src="/ambition_guru/day4/pimage/<?php echo $row['image']; ?>" class="card-img-top" alt="..." style="width:40px; height:40px; " ></td>
      <td><?php echo $row['title']?></td>
      <td><?php echo $row['price']?></td>
      <td>    <a href="detail.php?id=<?php echo $row['id']; ?>&c_id=<?php echo $row['c_id']; ?>" class="btn btn-primary custom-button">Detail</a>

      <td><a href="remove_cart_item.php?id=<?php echo $row['id']; ?>" class="btn btn-primary custom-button">Remove</a></td>
      
</td>
      

    
    </tr>
    <?php }  ?>
  </tbody>
</table>
      
      </div>
    
    </div>
  </div>
</div>