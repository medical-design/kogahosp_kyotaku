<!DOCTYPE html>
<?php $use_wordpress=1; ?>
<?php //$is_toppage=1 ?>
<?php require_once '../../include/common.php'; ?>
<?php $page_title=S ITE_NAME; ?>
<?php //use MedicalDesign as MD; //require_once DIR_SITE_LIB . 'Helper.php'; ?>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>
    <?php echo $page_title ?>
  </title>
  <?php include DIR_SITE_INCLUDE . 'head.php'; ?>
  <link rel="stylesheet" href="/common/css/form.css">
</head>

<body>
  <div class="root">
    <?php include DIR_SITE_INCLUDE . 'header.php'; ?>
    <div class="main_content_area">
      <div class="category_line" id="category_line">
        <div class="category_line_inner">
          <div class="category_title">
            <img class="deco" src="/common/img/category/title_deco.webp" alt="" loading="lazy" width="70" height="30">
            <img class="ja" src="/common/img/category/title_contact.webp" alt="お知らせ" loading="lazy" width="234" height="38">
            <span class="en">contact</span>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="breadcrumb_area">
          <span class="line">
          </span>
          <ul class="bread_crumb cancel">
            <li class="level-1 top">
              <a href="/">トップ</a>
            </li>
            <li class="level-2 sub tail current">お問い合わせ</li>
          </ul>
        </div>
        <div class="main_content main_content_contact" id="main_content">
          <div class="contact">
            <section class="contact__body">
              <div class="contact__inner">
                <h2>お問い合わせ</h2>
                <p>必須項目の印がついている項目は必ず入力してください。</p>
                <section class="contact__head">
                  <ul class="contact__flow-list cancel">
                    <li class="active">
                      <div class="info _input">
                        <div class="text">01</div>
                      </div>
                      <span>入力</span>
                    </li>
                    <li class="line">
                    </li>
                    <li>
                      <div class="info _confirm">
                        <div class="text">02</div>
                      </div>
                      <span>確認</span>
                    </li>
                    <li class="line">
                    </li>
                    <li>
                      <div class="info _thanks">
                        <div class="text">03</div>
                      </div>
                      <span>完了</span>
                    </li>
                  </ul>
                </section>
                <div class="contact_area">
                  <div class="contact__gr">
                    <div class="contact__th">お問い合わせ件名
                      <span class="required">必須</span>
                    </div>
                    <div class="contact__td">
                      <span class="wpcf7-form-control-wrap" data-name="your-name">
                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" autocomplete="name" aria-required="true" aria-invalid="false" value="" type="text" name="your-name" placeholder="例：サービスについて">
                      </span>
                    </div>
                  </div>
                  <div class="contact__gr">
                    <div class="contact__th">お名前
                      <span class="required">必須</span>
                    </div>
                    <div class="contact__td">
                      <span class="wpcf7-form-control-wrap" data-name="your-name">
                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" autocomplete="name" aria-required="true" aria-invalid="false" value="" type="text" name="your-name" placeholder="例：古河　太郎">
                      </span>
                    </div>
                  </div>
                  <div class="contact__gr">
                    <div class="contact__th">お名前 (ふりがな)
                      <span class="required">必須</span>
                    </div>
                    <div class="contact__td">
                      <span class="wpcf7-form-control-wrap" data-name="your-name">
                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" autocomplete="name" aria-required="true" aria-invalid="false" value="" type="text" name="your-name" placeholder="例：こが　たろう">
                      </span>
                    </div>
                  </div>
                  <div class="contact__gr">
                    <div class="contact__th">メールアドレス
                      <span class="required">必須</span>
                    </div>
                    <div class="contact__td">
                      <span class="wpcf7-form-control-wrap" data-name="your-name">
                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" autocomplete="name" aria-required="true" aria-invalid="false" value="" type="text" name="your-name" placeholder="例：xxx@xxx.xxx">
                      </span>
                    </div>
                  </div>
                  <div class="contact__gr">
                    <div class="contact__th">電話番号
                      <span class="required">必須</span>
                    </div>
                    <div class="contact__td _short">
                      <span class="wpcf7-form-control-wrap" data-name="your-name">
                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" autocomplete="name" aria-required="true" aria-invalid="false" value="" type="text" name="your-name" placeholder="例：0280474306">
                      </span>
                      <p class="contact__note">※市外局番からハイフンなしで入力してください</p>
                    </div>
                  </div>
                  <div class="contact__gr">
                    <div class="contact__th">お問い合わせ内容
                      <span class="required">必須</span>
                    </div>
                    <div class="contact__td">
                      <span class="wpcf7-form-control-wrap" data-name="textarea-325">
                        <textarea cols="40" rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" name="textarea-325" placeholder="お問い合わせ内容を入力してください"></textarea>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="contact__privacy">
                <p>
                  <a href="/about/interview/">個人情報保護方針</a>についてをご確認いただき「同意する」にチェックのうえ送信してください。</p>
                <div class="agreement">
                  <input type="checkbox" id="agree" name="agree">
                  <label for="agree">
                    <span class="checkbox-custom">
                    </span>同意する</label>
                </div>
              </div>
              <div class="contact__gr _submit">
                <div class="form_btn_wrap">
                  <div class="btn_box _submit_btn">
                    <!--確認画面へ-->
                    <p>
                      <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="確認画面へ">
                      <span class="wpcf7-spinner">
                      </span>
                      <br>
                      <input type="hidden" name="_cf7msm_multistep_tag" class="wpcf7-form-control wpcf7-multistep cf7msm-multistep" value='{"first_step":1,"next_url":"\/contact-confirm"}'>
                      <input type="hidden" name="cf7msm-no-ss" value="">
                    </p>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
    <?php include DIR_SITE_INCLUDE . 'footer.php'; ?>
  </div>
  <?php include DIR_SITE_INCLUDE . 'menu/sp_menu.php'; ?>
  <?php include DIR_SITE_INCLUDE . 'script.php'; ?>
  <script src="/common/js/lib/jquery.marquee.min.js"></script>
</body>

</html>