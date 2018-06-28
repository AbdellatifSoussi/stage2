<header>
       <nav class="navbar navbar-inverse" id="head">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" id="logo" href="../pages/home.php"><img src="../img/dasi_white.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="../DB/deconn.php" id="dec"><?php echo $_SESSION['nom']; ?> <i class="fas fa-sign-out-alt"></i> </a></li>
              </ul>
            </div>
          </div>
        </nav>
</header>
