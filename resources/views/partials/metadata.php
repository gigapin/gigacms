<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="form-group">
        <label>Meta Description</label>
        <textarea class="form-control" name="meta_description" rows="3">
          <?php if (isset($metadata->meta_description)): ?>
            <?= $metadata->meta_description ?>
          <?php endif; ?>
        </textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="form-group">
        <label>Keywords</label>
        <textarea class="form-control" name="keywords">
          <?php if (isset($metadata->keywords)): ?>
            <?= $metadata->keywords ?>
          <?php endif; ?>
        </textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="form-group">
        <label>Robots</label>
        <select name="robots" class="custom-select">
          <?php if (isset($metadata->robots)): ?>
            <?php if ($metadata->robots === 'useglobal'): ?>
              <option value="useglobal" selected>Use Global</option>
            <?php else: ?>
              <option value="<?= $metadata->robots ?>" selected><?= $metadata->robots ?></option>
            <?php endif; ?>
            <option value="useglobal">Use Global</option>
            <option value="noindex,follow">noindex,follow</option>
            <option value="index,follow">index,follow</option>
            <option value="index,nofollow">index,nofollow</option>
            <option value="noindex,nofollow">noindex,nofollow</option>
          <?php else: ?>
            <option value="useglobal" selected>Use Global</option>
            <option value="noindex,follow">noindex,follow</option>
            <option value="index,follow">index,follow</option>
            <option value="index,nofollow">index,nofollow</option>
            <option value="noindex,nofollow">noindex,nofollow</option>
          <?php endif; ?> 
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-2">
      <div class="form-group">
        <label>Author</label>
        <input type="text" class="form-control" name="author" value=" 
        <?php if (isset($metadata->author)): ?>
          <?= $metadata->author ?>
        <?php endif; ?>
        ">
      </div>
    </div>
  </div>

</div><!-- /. tab-pane -->