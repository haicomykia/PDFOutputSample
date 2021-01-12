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
    <ul class="list-unstyled" id="product-list">
      <li class="py-2 d-flex">
        <input type="text" name="product-id" class="product-id form-control d-inline-block mr-3" value="1" readonly>
        <input type="text" name="title" class="title form-control d-inline-block">
      </li>
    </ul>
  </div>
  <script src="./js/jquery-3.5.1.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="./js/jquery.tablesorter.js"></script>
  <script src="./js/script.js"></script>
  <script>
    $(function(){
      let mutationObserver = new MutationObserver(function(){
        if (!$("#product-list li").length) {
          return;
        }
        $("#product-list li").each(function(index){
          $.ajax({
            url: "./search.php",
            type: 'GET',
            dataType: 'json',
            timeout: 10000,
            data: {id: $(".product-id", this).val()}
          }).then(
            function(data){
              $("#product-list li").eq(index).find('.title').val(data[0].title).prop('readonly', true);
            },
            function(jqxhr, status, exception){
              console.log(jqxhr);
              console.log(status);
              console.log(exception);
            }
          );
        });
      });
      const config = {
        attributes: true,
        childList: true
      }
      mutationObserver.observe(
        // target
        document.getElementById('product-list'),
        config
      );

      setInterval(() => {
        const $clone = $("#product-list li").last().clone(true);
        $clone.find('.product-id').val(Math.ceil(Math.random() * 10));
        $("#product-list").append($clone);
      }, 5000);
    });
  </script>
</body>
</html>