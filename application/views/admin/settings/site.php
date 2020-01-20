<?php $site = isset($settings['site']) ? $settings['site'] : []; ?>

<div class="form-group mb-3">
    <label class="form-label">Site Title</label>
    <input type="text" name="site[title]" class="form-control" value="<?= isset($site['title']) ? $site['title']->value : '' ?>">
</div>

<div class="mb-3">
    <div class="d-flex">
        <div class="mr-3">
            <div class="form-label">White Logo</div>
            <div>
                <label class="image-chooser">
                    <img src="<?= RImage::resize((isset($site['logo_white']) ? $site['logo_white']->value : ''),100,100) ?>" class="image">
                    <input type="hidden" name="site[logo_white]" value="<?= isset($site['logo_white']) ? $site['logo_white']->value : '' ?>">
                </label>
            </div>
        </div>
        <div>
            <div class="form-label">Black Logo</div>
            <div>
                <label class="image-chooser">
                    <img src="<?= RImage::resize((isset($site['logo_black']) ? $site['logo_black']->value : ''),100,100) ?>" class="image">
                    <input type="hidden" name="site[logo_black]" value="<?= isset($site['logo_black']) ? $site['logo_black']->value : '' ?>">
                </label>
            </div>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">Footer copyright text</label>
    <input type="text" name="site[footer_copyright]" class="form-control" value="<?= isset($site['footer_copyright']) ? $site['footer_copyright']->value : '' ?>">
</div>

<div class="form-group mb-3">
    <label class="form-label">Google analytics code</label>
    <textarea  name="site[google_analytics]" class="form-control" ><?= isset($site['google_analytics']) ? $site['google_analytics']->value : '' ?></textarea>
</div>
