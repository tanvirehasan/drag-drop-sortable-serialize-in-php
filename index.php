<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<table class="table table-bordered table-striped mb-0">
      <thead>
          <tr>
              <th>SL</th>
              <th>Name</th>
              <th>Designation</th>
              <th>Phone No.</th>
              <th>Email</th>
              <th>Image</th>
              <th>Action</th>
          </tr>
      </thead>

      Your class
      <tbody class="sort">                          

      <?php 
          $i=1;
          $teab_data = SelectData('our_team', "ORDER BY serial_list ASC");
          while ($team = $teab_data->fetch_object()) {?>

              <tr id="arrayorder_<?php echo $team->team_id?>" >
                  <td><?=$i++?></td>
                  <td><?=$team->Name?></td>
                  <td><?=$team->Designation?></td>
                  <td><?=$team->Phone_No?></td>
                  <td><?=$team->Email?></td>
                  <td><img src="../assets/mediacenter/team/<?=$team->Profile_pic?>" style=" width: 50px; height:50px;" ></td>
                  <td>
                      <a onclick="team_edit('views/teams/edit.php?team_id=<?=$team->team_id?>')"  class="btn btn-danger btn-sm text-white">Edit</a> 
                      <?php 
                          if ($team->status==1) {
                              echo "<a href='team.php?steam_id=".$team->team_id."&stutas=0' class='btn btn-success btn-sm' >Enable </a>";
                          }else{
                              echo "<a href='team.php?steam_id=".$team->team_id."&stutas=1' class='btn btn-danger btn-sm' >Disable </a>";
                          }                       
                      ?>
                      <a onclick="team_delete('team.php?delete_id=<?=$team->team_id?>')"  class="btn btn-danger btn-sm text-white">Delete</a>                          
                  </td>
              </tr> 
          <?php } ?>

      </tbody>
  </table>



<script>
    $(document).ready(function(){  
        $(function() {
                $(".sort").sortable({ opacity: 0.8, cursor: 'move', update: function() {
                    var order = $(this).sortable("serialize") + '&update=team';
                    $.post("serialize_update", order);           
                }         
            });
        }); 
    }); 
</script>

//serialize_update.php
$array = $_POST['arrayorder']; 
if ($_POST['update'] == "team"){  
    $count = 1;
    foreach ($array as $idval) {
        $sql = "UPDATE our_team SET serial_list = " . $count . " WHERE team_id= " . $idval;
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $count ++; 
    }
    echo 'All saved! refresh the page to see the changes';
}



