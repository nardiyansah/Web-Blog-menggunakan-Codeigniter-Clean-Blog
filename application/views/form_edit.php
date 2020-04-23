<header class="masthead" style="background-image: url('<?= base_url(); ?>assets/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Clean Blog</h1>
            <span class="meta">create by clean blog</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        <?= $this->session->flashdata('message'); ?>
        <div class="alert alert-warning">

      <?= validation_errors(); ?>
    </div>
    <?= form_open_multipart(); ?>
        <div class="form-group">
            <label>Judul</label>
            <?= 
            form_input('title', set_value('title', $update['title']), 'class="form-control"');
             ?>
        </div>
        <div class="form-group">
            <label>Url</label>
            <?= 
            form_input('url', set_value('url', $update['url']), 'class="form-control"');
             ?>
        </div>
        <div class="form-group">
            <label>Konten</label>
            <?= 
            form_textarea('content', set_value('content', $update['content']), 'class="form-control"');
             ?>
        </div>
        <div class="form-group">
            <label>cover</label>
            <?= 
            form_upload('cover');
             ?>
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
    <?= form_close(); ?>
    </div>
      </div>
    </div>
  </article>
  <hr>