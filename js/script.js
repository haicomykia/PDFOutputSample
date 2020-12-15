$(document).ready(function(){
	$.ajax({
		url:'fetch_all.php',	// HTMLファイルからの相対パス
		type: 'GET',
		dataType: 'json'
	}).done(books => {
		let addedIds = [];
		$('form[name="id"] input').each(function(){
			addedIds.push($(this).val());
		});
		let tr = '<tr>';
		$.each(books, function (key, book) {
				tr += '<td class="title">' + book.title + '</td><td class="author">' + book.author + '</td><td class="pulisher">' + book.publisher + '</td>';
				console.log(addedIds.indexOf(book.id));
				if(addedIds.indexOf(book.id) === -1) {
					tr += '<td class="action">' + '<button class="btn btn-info btn-sm btn-add-product" type="button">追加</button>' + '</td>';
				} else {
					tr += '<td class="action">' + '<button class="btn btn-info btn-sm btn-add-product" type="button" disabled>追加済</button>' + '</td>';
				}
				tr += '</tr>';
		});
		$(".search-result").append(tr);

		let id = '';
		$.each(books, function(key, book){
			id += '<input type="hidden" value="' + book.id + '" name="id">';
		});
		console.log(id);
		$(".id-container").empty().append(id);
	}).fail((jqXHR, textStat, thrownError) => {
		showLogs(jqXHR, textStat, thrownError);
	}).always(() => {

	});

	$(".btn-search").on('click', function(){
		$.ajax({
			url:'search.php',	// HTMLファイルからの相対パス
			type: 'POST',
			data: {q: $("input[name='q']").val()},
			dataType: 'json'
		}).done(books => {
			let addedIds = [];
			$('form[name="id"] input').each(function(){
				addedIds.push($(this).val());
			});
			let tr = '<tr>';
			$.each(books, function (key, book) {
					tr += '<td class="title">' + book.title + '</td><td class="author">' + book.author + '</td><td class="pulisher">' + book.publisher + '</td>';
					console.log(addedIds.indexOf(book.id));
					if(addedIds.indexOf(book.id) === -1) {
						tr += '<td class="action">' + '<button class="btn btn-info btn-sm btn-add-product" type="button">追加</button>' + '</td>';
					} else {
						tr += '<td class="action">' + '<button class="btn btn-info btn-sm btn-add-product" type="button" disabled>追加済</button>' + '</td>';
					}
					tr += '</tr>';
			});
			$(".search-result").empty().append(tr);
			let id = '';
			$.each(books, function(key, book){
				id += '<input type="hidden" value="' + book.id + '" name="id">';
			});
			$(".id-container").empty().append(id);

		}).fail((jqXHR, textStat, thrownError) => {
			showLogs(jqXHR, textStat, thrownError);
		}).always(() => {
	
		});
	});

	$(document).on('click', '.btn-add-product', function(e){
		let obj = [];
		$(this).closest('tr').children().not(".action").each(function(){
			obj.push($(this).text());
		});

		let item = '<tr>';
		obj.forEach(function(element){
			item += '<td>' + element + '</td>';
		});
		item += '</tr>';
		$(".order-detail").append(item);
		$(this).text("追加済").prop('disabled', true);

		const idx = $(this).closest('tr').index();
		$("input[name='id']").eq(idx).clone(true).appendTo("form[name='id']");
	});
	
});

	function getCheckedBox() {
		return $(".form-check-input:checked").map(function(){
			return $(this).val();
		}).get();
	}

	function showLogs(jqXHR, textStat, thrownError){
		console.log(jqXHR);
		console.log(jqXHR.status);		// HTTPステータスを取得
		console.log(textStat);				// エラー情報を取得
		console.log(thrownError);			// 例外情報を取得
	}
