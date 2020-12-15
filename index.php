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
            <button class="btn btn-secondary" type="button"  data-toggle="modal" data-target="#client-search-modal">
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
        <div class="modal-body">
          <div class="container">
            <div class="row mb-3">
              <label for="id" class="col-form-label col-2">ID</label>
              <div class="col-10">
                <input type="search" name="id" id="id" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <button class="btn btn-search btn-info d-block mx-auto" type="button">検索</button>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>タイトル</th>
                      <th>作者</th>
                      <th>出版日</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="d-none template-tr original" id="last-tr">
                      <th><input type="text" name="id" class="form-control-plaintext" readonly></th>
                      <td><input type="text" name="title" class="form-control-plaintext" readonly></td>
                      <td><input type="text" name="author" class="form-control-plaintext" readonly></td>
                      <td><input type="text" name="publish-date" class="form-control-plaintext" readonly></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
      </div>
    </div>
  </div>
  <script src="./js/jquery-3.5.1.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="./js/script.js"></script>
  <script>
    $(function(){
      $("#client-search-modal").on('show.bs.modal', function(){
        $("#id").val($("#client").val());
        search($("#id").val());
      });

      $(".btn-search").on('click', function(){
        search($("#id").val());
      });
    });
  </script>
  <script>
    /**
     * Ajax通信で部分一致検索を行う
     * @param {string} id 書籍管理テーブル.ID
     */
    function search(id){
      $.ajax({
          url:'search.php',	// HTMLファイルからの相対パス
          type: 'POST',
          dataType: 'json',
          data: {id: id}
      })
      .then(
        function(data){
          generateResultList(data);
        }, 
        function(){

        }
      );
    }
    /**
     * 検索結果のリストを生成する
     * @param {object} results 検索結果のJSON
     */
    function generateResultList(results){
      $(".template-tr").not(".original").remove();
      $.each(results, function(index, result){
        const $row = $("#last-tr").clone(true).removeClass('d-none original');
        $row.find('[name="id"]').val(result.id);
        $row.find('[name="title"]').val(result.title);
        $row.find('[name="author"]').val(result.author);
        $row.find('[name="publish-date"]').val(result.date);
        $("#last-tr").before($row);
      });
    }
  </script>
</body>
</html>