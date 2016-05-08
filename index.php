<?php 

include "includes/config.php";
include_once "header.php";

if($arraysetting['enabled'] == "1"){

  $displaysql = "SELECT * FROM news WHERE enabled = '1'";
  $query = mysqli_query($dbc, $displaysql);

  if(isset($_GET['page'])) {
    if($_GET['page'] == 'details'){
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $id = mysqli_real_escape_string($dbc, $id);

        $sqlgetdata = "SELECT * FROM news WHERE id = '".$id."'";
        $query = mysqli_query($dbc, $sqlgetdata);
        $newsdata = mysqli_fetch_array($query);

        if($newsdata['level'] == '3'){
          echo '
          <center><a href="index.php" class="btn btn-primary">Back</a><br><br></center>
            <div class="col-md-12">
              <div class="panel panel-red">
                <div class="panel-heading dark-overlay">'.$newsdata['title'].'</div>
                <div class="panel-body">
                  <p>'.$newsdata['news'].'</p>
                  <p>Posted by <b>'.$newsdata['post_by'].'</b> at <b>'.$newsdata['post_date'].'</b></p>
                </div>
              </div>
            </div>

            <script type="text/javascript">
            window.setTimeout(function(){
              window.location.href = "index.php";
            }, 30000);

            </script>
          ';
        }

        elseif($newsdata['level'] == '2'){
          echo '
          <center><a href="index.php" class="btn btn-primary">Back</a><br><br></center>
            <div class="col-md-12">
              <div class="panel panel-blue">
                <div class="panel-heading dark-overlay">'.$newsdata['title'].'</div>
                <div class="panel-body">
                  <p>'.$newsdata['news'].'</p>
                  <p>Posted by <b>'.$newsdata['post_by'].'</b> at <b>'.$newsdata['post_date'].'</b></p>
                </div>
              </div>
            </div>

            <script type="text/javascript">
            window.setTimeout(function(){
              window.location.href = "index.php";
            }, 30000);

            </script>
              
            ';
        }
        else {
          echo '
          <center><a href="index.php" class="btn btn-primary">Back</a><br><br></center>
            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading">'.$newsdata['title'].'</div>
                <div class="panel-body">
                  <p>'.$newsdata['news'].'</p>
                  <p>Posted by <b>'.$newsdata['post_by'].'</b> at <b>'.$newsdata['post_date'].'</b></p>
                </div>
              </div>
            </div> 

            <script type="text/javascript">
            window.setTimeout(function(){
              window.location.href = "index.php";
            }, 30000);

            </script>
          ';
        }
      }
    }
  }
  else {

  while ($newsdata = mysqli_fetch_array($query)) {
    $newsstr = substr($newsdata['news'], 0, 100);
    if($newsdata['level'] == '3'){
      echo '
        <div class="col-md-6">
        <a href="?page=details&id='.$newsdata['id'].'">
          <div class="panel panel-red">
            <div class="panel-heading dark-overlay">'.$newsdata['title'].'</div>
            <div class="panel-body">
              <p>'.$newsstr.'....</p>
            </div>
          </div>
          </a>
        </div>
      ';
    }

    elseif($newsdata['level'] == '2'){
      echo '
        <div class="col-md-6">
        <a href="?page=details&id='.$newsdata['id'].'">
          <div class="panel panel-blue">
            <div class="panel-heading dark-overlay">'.$newsdata['title'].'</div>
            <div class="panel-body">
              <p>'.$newsstr.'....</p>
            </div>
          </div>
        </a>
        </div>
          
        ';
    }
    else {
      echo '
        <div class="col-md-4">
        <a href="?page=details&id='.$newsdata['id'].'">
          <div class="panel panel-primary">
            <div class="panel-heading">'.$newsdata['title'].'</div>
            <div class="panel-body">
              <p>'.$newsstr.'....</p>
            </div>
          </div>
        </a>
        </div> 
      ';
    }
  }
  }

}
else {

  echo '
    <div class="col-md-12">
      <div class="alert bg-danger" role="alert">
          <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> System Maintainance
      </div>
    </div>
        ';
}


include_once "footer.php";
?>