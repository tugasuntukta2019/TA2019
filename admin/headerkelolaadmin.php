<script src="https://kit.fontawesome.com/640ce77c8b.js" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Bengkel Virly</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-1">
                <li class="nav-item dropdown">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="kelolaaplikasi.php">Home</a>
                  </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
                <li class="nav-item">
                    <?php if (isset($_SESSION["user"])) : ?>
                        <a class="nav-link" href="#" onclick="confirmLogout()">Logout</a>
                    <?php else : ?>
                        <!-- <a class="nav-link" href="login.php">Login</a> -->
                    <?php endif ?>
                </li>
            </ul>
          </div>
        </div>
      </nav>

      <script>
    function confirmLogout() {
        if (confirm("Anda yakin ingin logout?")) {
            window.location.href = "../logout.php";
        }
    }
</script>