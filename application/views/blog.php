

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?= base_url(); ?>/assets/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Clean Blog</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h1>Artikel terbaru</h1>
            <form class="mb-4">
                <input type="text" name="find">
                <button type="submit">Cari</button>
            </form>
        <?php foreach($blogs as $blog): ?>
        <div class="post-preview">
          <a href="post.html">
            <h2 class="post-title">
                <?= anchor(site_url('blog/detail/'.$blog['url']), $blog['title'], 'attributes'); ?>
            </h2>
            <?php if($_SESSION['status'] == 'login'){ ?>
              <?= anchor(site_url('blog/edit/'.$blog['id']), 'Edit', 'class="post-title"'); ?>
              <a href="<?= site_url('blog/delete/'.$blog['id']); ?>" class"post-title" onclick="return confirm('apa kamu yakin?')">Delete</a>
            <?php } ?>
            <p><?= $blog['content']; ?></p>
          </a>
          <p class="post-meta">Posted <?= $blog['date']; ?></p>
        </div>
        <hr>
     <?php endforeach; ?>
        <?= $pagination; ?>
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>
  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="../assets/js/clean-blog.min.js"></script>

</body>

</html>