var table;
var size = 10;
$(function() {
	table = $("#datatable").dataTable({
		"processing" : true,
		"serverSide" : true,
		"ajax" : {
			"url" : "/news2/Index/getdata",
			"dataType" : "json"
		},
		"bLengthChange" : true,
		"bFilter" : false,
		"bPaginate" : true,
		"info" : true,
		"bSort" : false,
		"oLanguage" : {
			"sLengthMenu" : "每页显示 _MENU_ 条记录",
			"sZeroRecords" : "没有查询到数据",
			"sInfo" : "当前数据为从第 _START_ 到第 _END_ 条数据；总共有 _TOTAL_ 条记录",
			"sInfoEmtpy" : "没有数据",
			"sProcessing" : "正在加载数据...",
			"oPaginate" : {
				"sFirst" : "首页",
				"sPrevious" : "上一页",
				"sNext" : "下一页",
				"sLast" : "尾页"
			}
		},
		"iDisplayLength" : size,
		"columnDefs": [{
			"render": function(data, type, row) {
				return '<a href="/a/' + row[2] + '" style="color:#000" target="_blank">' + data + '</a>';
			},
			"targets": 0
		}]
	});
});