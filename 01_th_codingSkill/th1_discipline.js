//==================================================
//紀律性測試, 凡事事件一定要事先測試
//使用console做測試, 每次測試都寫明是哪個事件或function
//==================================================

$(document).ready(function () {
	console.log('doc ready');
	//alert('test');
});

$('html, body').on('click', '.show', function () {
	console.log('btn.show click');
});

//==================================================
//console.log跟alert的差別在於：
//alert會中斷事件的進行, console.log較為方便
//alert在測試後需要註解掉或刪除, console.log不需要
//console.log最大的優點在於日後可以觀測事件方生的順序
//==================================================

//當然可以把log 寫到檔案裡面, 留下記錄黨