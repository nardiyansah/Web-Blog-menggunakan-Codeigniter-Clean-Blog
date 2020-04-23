<!-- Page Header -->
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

    <!-- Post Content -->
    <article>
    <div class="container">
    <div class="alert alert-warning">
      <?= validation_errors(); ?>
      <?= $this->session->flashdata('message'); ?>
    </div>
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?= form_open_multipart(); ?>
                <div class="form-group">
                    <label>Judul</label>
                    <?= form_input('title', set_value('title'), 'class="form-control"') ?>
                </div>
                <div class="form-group">
                    <label>Url</label>
                    <?= form_input('url', set_value('url'), 'class="form-control"') ?>
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <?= form_textarea('content', set_value('content'), 'class="form-control"') ?>
                </div>
                <div class="form-group">
                    <label>Cover</label>
                    <?= form_upload('cover', null, 'class="form-control"') ?>
                </div>
                <button class="btn btn-primary" type="submit">Simpan</button>
            <?= form_close(); ?>
        </div>
      </div>
    </div>
  </article>

  <hr>  

    
