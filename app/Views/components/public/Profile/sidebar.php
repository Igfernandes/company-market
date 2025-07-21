  <!-- Profile Image -->
  <div class="card card-primary card-outline">
      <div class="card-body box-profile">
          <div class="form-upload text-center mb-2">
              <div class="perfil-img">
                  <img src="<?= isset($profile['photo']) ? $profile['photo'] : '/img/profile/perfil.jpg' ?>" data-target-preview="perfil" alt="Imagem de perfil">
              </div>
              <div class="custom-file mx-auto">
                  <input type="file" name="photo" data-preview="perfil" class="custom-file-input" id="exampleInputFile" accept=".jpg, .jpeg, .png">
                  <label class="custom-file-label text-left" for="exampleInputFile">Atualizar Photo</label>
                  <div class="invalid-feedback">Insira uma imagem</div>
              </div>
          </div>
          <hr>
          <div class="mb-3">
              <h5 class="profile-profilename text-center"><strong><?= $profile['groups'] ?></strong></h5>
          </div>
          <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                  <b>Federação:</b> <a class="float-right"><?= isset($profile['federation']) ? ucfirst($profile['federation']) : lang("Words.none"); ?></a>
              </li>
              <li class="list-group-item">
                  <b>Clube:</b> <a class="float-right"><?= isset($profile['club']) ? ucfirst($profile['club']) : lang("Words.none"); ?></a>
              </li>
              <li class="list-group-item">
                  <b>Matricula:</b> <a class="float-right"><?= isset($profile['matricula']) ? ucfirst($profile['matricula']) : ucfirst(lang("Words.unavailable")); ?></a>
              </li>
          </ul>

          <a href="#" class="btn btn-primary btn-block">Situação: <b><?= isset($profile['status']) ? ucfirst(lang("Words." . strtolower($profile['status']))) : ucfirst(lang("Words.inactive")); ?></b></a>
      </div>
      <!-- /.card-body -->
  </div>
  <!-- /.card -->

  <!-- About Me Box -->
  <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Informações</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <?php if (isset($profile['categories'])) : ?>
              <div class="mt-2">
                  <strong><i class="fas fa-book mr-1"></i> Categoria</strong>
                  <p class="text-muted text-center">
                  </p>
                  <hr>
              </div>
          <?php endif; ?>

          <?php if (isset($profile['address'])) : ?>
              <div class="mt-1">
                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
                  <p class="text-muted">
                      <?php
                        $address = $profile['address'];
                        echo $address['zipcode'] . ", " . $address['city'] . ", " . $address['state'] . "/" . $address['country'];
                        ?>
                  </p>
                  <hr>
              </div>
          <?php endif; ?>

          <?php if (isset($profile['phones'])) : ?>
              <div class="mt-2">
                  <strong><i class="far fa-fw fa-envelope"></i> <?= ucfirst(lang("Words.contacts")) ?></strong>
                  <ul class="list-unstyled">
                      <?php foreach ($profile['phones'] as $phone) : ?>
                          <li>
                              <a href="tel:<?= $phone['link'] ?>" class="btn-link text-secondary"> <?= $phone['link'] ?></a>
                          </li>
                      <?php endforeach; ?>
                  </ul>
              </div>
          <?php endif; ?>
      </div>
      <!-- /.card-body -->
  </div>
  <!-- /.card -->