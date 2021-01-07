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
    <div class="row">
      <div class="col-2">
        <input type="text" name="order_date" id="order-date" class="form-control order-datepicker">
      </div>
      <div class="col-2">
        <input type="text" name="delivery_date" id="delivery-date" class="form-control delivery-datepicker">
      </div>
    </div>
    <ol class="list-unstyled">
      <li class="my-3">
        <div class="row ">
          <div class="col-3 d-flex justify-content-center">
            <!-- 画像ファイル、PDF以外（フォールバック） -->
            <img src="./img/doc_icon.svg" alt="" class="img-thumbnail border-0">
          </div>
          <div class="col-9">
            <h5 class="font-weight-normal clearfix">
              <a href="./img/Eb9YpYgVcAALa8d.jpg">XXXXXXX.jpg</a>
              <small class="float-right">
                <a href="#" class="btn btn-outline-danger btn-sm btn-del-attachment">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>削除
                </a>
              </small>
            </h5>
            <div class="form-inline">
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="custom-control-label" for="inlineRadio1">1</label>
              </div>
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="custom-control-label" for="inlineRadio2">2</label>
              </div>
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                <label class="custom-control-label" for="inlineRadio3">3 (disabled)</label>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li class="my-3">
        <div class="row">
          <div class="col-3 d-flex justify-content-center">
            <!-- 画像ファイル -->
            <img src="./img/Eb9YpYgVcAALa8d.jpg" alt="" class="img-thumbnail border-0">
          </div>
          <div class="col-9">
            <h5 class="font-weight-normal clearfix">
              <a href="./img/Eb9YpYgVcAALa8d.jpg">XXXXXXX.jpg</a>
              <small class="float-right">
                <a href="#" class="btn btn-outline-danger btn-sm btn-del-attachment">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>削除
                </a>
              </small>
            </h5>
            <div class="form-inline">
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions2" id="inlineRadio1-2" value="option1">
                <label class="custom-control-label" for="inlineRadio1">1</label>
              </div>
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions2" id="inlineRadio2-2" value="option2">
                <label class="custom-control-label" for="inlineRadio2">2</label>
              </div>
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions2" id="inlineRadio3-2" value="option3" disabled>
                <label class="custom-control-label" for="inlineRadio3">3 (disabled)</label>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li class="my-3">
        <div class="row">
          <div class="col-3 d-flex justify-content-center">
            <!-- PDF -->
            <div class="embed-responsive embed-responsive-a4">
              <embed src="./img/riyou.pdf#page=1" type="application/pdf" title="XXXXXX.pdf" class="embed-responsive-item">
            </div>
          </div>
          <div class="col-9">
            <h5 class="font-weight-normal clearfix">
              <a href="./img/Eb9YpYgVcAALa8d.jpg">XXXXXXX.jpg</a>
              <small class="float-right">
                <a href="#" class="btn btn-outline-danger btn-sm btn-del-attachment">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>削除
                </a>
              </small>
            </h5>
            <div class="form-inline">
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions3" id="inlineRadio1-3" value="option1">
                <label class="custom-control-label" for="inlineRadio1">1</label>
              </div>
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions3" id="inlineRadio2-3" value="option2">
                <label class="custom-control-label" for="inlineRadio2">2</label>
              </div>
              <div class="custom-control custom-radio mr-3">
                <input class="custom-control-input" type="radio" name="inlineRadioOptions3" id="inlineRadio3-3" value="option3" disabled>
                <label class="custom-control-label" for="inlineRadio3">3 (disabled)</label>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ol>
    <table class="table">
      <thead>
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Due</th>
          <th>Web Site</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Smith</td>
          <td>John</td>
          <td>jsmith@gmail.com</td>
          <td>$50.00</td>
          <td>http://www.jsmith.com</td>
        </tr>
        <tr>
          <td>Bach</td>
          <td>Frank</td>
          <td>fbach@yahoo.com</td>
          <td>$50.00</td>
          <td>http://www.frank.com</td>
        </tr>
        <tr>
          <td>Doe</td>
          <td>Jason</td>
          <td>jdoe@hotmail.com</td>
          <td>$100.00</td>
          <td>http://www.jdoe.com</td>
        </tr>
        <tr>
          <td>Conway</td>
          <td>Tim</td>
          <td>tconway@earthlink.net</td>
          <td>$50.00</td>
          <td>http://www.timconway.com</td>
        </tr>
      </tbody>
    </table>
  </div>
  <script src="./js/jquery-3.5.1.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="./js/jquery.tablesorter.js"></script>
  <script src="./js/script.js"></script>
  <script>
    $(function(){
      $(".delivery-datepicker").flatpickr({
        minDate: new Date().fp_incr(1)
      });
      $(".order-datepicker").flatpickr({
        defaultDate: "today",
        onChange: function(selectedDates, dateStr){
          console.log(dateStr);
          const minDate = dateStr.split('-');
          flatpickr(".delivery-datepicker", {
            minDate: new Date(minDate[0], minDate[1] - 1, minDate[2]).fp_incr(1)
          });
        }
      });

      $(".btn-del-attachment").on('click', function(){
        if (confirm("添付ファイルを完全に削除しますか？この操作は取り消せません。")) {
          $(this).closest("li").remove();
        }
      });

      $(".table").tablesorter();
    });
  </script>
</body>
</html>