<!--
    JavaScript製DatePickerライブラリ「flatpickr」の基本的な使い方
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>flatpickrの基本のサンプル</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/jquery-ui.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
</head>
<body class="bg-light">
  <div class="container-lg bg-white">
    <div class="row py-3">
      <label for="client" class="col-form-label col-2">得意先コード</label>
      <div class="col-3">
        <div class="input-group mb-3">
          <input type="search" name="client_cd" id="client" class="form-control">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="button"  data-toggle="modal" data-target="#client-search-modal" data-receiver-id="id" data-sent-data-id="client">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
      <label for="client-name" class="col-form-label col-2">得意先名</label>
      <div class="col-5">
        <input type="texts" name="client_name" id="client-name" class="form-control" readonly value="">
      </div>
    </div>
    <div class="row">
      <div class="col-8 form-inline">
        <input type="number" name="a" id="" class="q form-control" min="0" step="0.01">
        <span class="mx-3">×</span>
        <input type="number" name="b" id="" class="price form-control" min="0" step="0.01">
        <span class="mx-3">=</span>
        <input type="number" name="ab" id="" class="total form-control readonly" readonly>
      </div>
      <div class="col-4">
        <button class="btn btn-info ml-3 set-rounding" type="button" data-rounding="1">四捨五入</button>
        <button class="btn btn-info ml-3 set-rounding" type="button" data-rounding="2">切り上げ</button>
        <button class="btn btn-info ml-3 set-rounding" type="button" data-rounding="3">切り捨て</button>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="client-search-modal" tabindex="-1" role="dialog" aria-labelledby="client-search-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="client-search-modal-label">得意先マスタ参照</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <script src="./js/jquery-3.5.1.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="./js/script.js"></script>
  <script>
    $(function(){
      //sessionStorage.rounding = 1;
      $("body").on('blur', '.price', function(){
        spreadSheetCalc();
      });

      $(".set-rounding").on('click', function(){
        sessionStorage.rounding = $(this).data('rounding');
        spreadSheetCalc();
      });
    });

    // 選択した端数処理にて計算する
    const calc = (q, price) => {
      if (sessionStorage.rounding == null || sessionStorage.rounding == void 0) {
        return null;
      }

      if (sessionStorage.rounding === '1') {
        return Math.round(q * price);
      } else if(sessionStorage.rounding === '2') {
        return Math.ceil(q * price);
      }
      return Math.floor(q * price);
    }

    // 端数処理が選択されていない場合はアラートを表示する
    const spreadSheetCalc = () => {
      const total = calc($(".q").val(), $(".price").val());
      if (total == null) {
        $(".total").addClass('is-invalid').val('');
      } else {
        $(".total").removeClass('is-invalid').val(total);
      }
    };
  </script>
</body>
</html>