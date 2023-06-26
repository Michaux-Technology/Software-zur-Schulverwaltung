<BR>
<?php

//========================================================================
// Author:  Valéry Jérôme Michaux
// Resume:  http://cafe-lingua.org
//
// Copyright (c) 2017 Valéry Jérôme Michaux
//
// Published under the OpenSource license with restiction : https://github.com/michaux4/SchoolManagementSoftware
//          Consider it as a proof of concept!
//          No warranty of any kind.
//          Use and abuse at your own risks.
//========================================================================


$requete = 'SELECT * FROM `school`';
$result = mysqli_query($cn, $requete);
$ecole = mysqli_fetch_array($result);
?>
<footer class="text-center">
  <div class="section well2">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <h3 class="text-center">
            <?php echo addslashes($ecole[4]); ?>
          </h3>
          <address class="text-center">
            <strong>
              <?php echo addslashes($ecole[5]); ?>
            </strong><br>
            <?php echo addslashes($ecole[6]); ?><br>
            <?php echo addslashes($ecole[7]); ?>
            <?php echo addslashes($ecole[9]); ?><br>
          </address>
        </div>
        <div class="col-lg-4 col-md-4">
          <h3 class="text-center">
            <?php echo addslashes($ecole[0]); ?>
          </h3>
          <address class="text-center">
            <strong>
              <?php echo addslashes($ecole[1]); ?>
            </strong><br>
            <?php echo addslashes($ecole[3]); ?><br>
            <?php echo addslashes($ecole[2]); ?>
            <?php echo addslashes($ecole[8]); ?><br>
          </address>
        </div>
        <div class="col-lg-4 col-md-4">
          <h3 class="text-center">NEWSLETTER</h3>
          <form>
            <div class="form-group col-lg-9 col-md-8 col-sm-10 col-xs-10">
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <button type="submit" class="btn btn-default">Subscribe<br>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright &copy; 2017 Val&eacute;ry-J&eacute;r&ocirc;me Michaux. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>