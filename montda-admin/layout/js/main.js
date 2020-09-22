$('#trumbowyg-posts').trumbowyg({
svgPath : 'layout/fonts/icons.svg',
lang: 'ar',
fixedBtnPane: true,
semantic: false
});
var i = 1;
var sn = 1;
function addnew() {
	var snnlength = document.getElementsByClassName('snn').length;
	 if(snnlength < 5){
		 i = i+1;
		 $('table.table_add tbody').append(
		 '<tr id="tr_' + i + '"><input type="hidden" name="available[' + i + '][]" value="true" /><td align="center" class="snn"></td><td align="center"><input name="product[' + i + '][text]" type="text" size="1" class="form-control" value="" /></td><td align="center"><input name="product[' + i + '][url]" type="text" class="form-control" size="22" /></td><td align="center"><input type="button" class="btn btn-danger" onclick="removepr(' + i + ')" value="حــذف" /></td></tr>');
		 $('#maxid').val(i);
		 $(".snn").each(function () {
				 $(this).text(sn);
				 sn = sn + 1;
		 });
		 sn = 1;
	 } else {
		 alert("تستطيع فقط اضافة 5 روابط لكل مقالة, يمكنك عمل مقال جديد اذا كان لديك أكثر من 5 روابط");
	 }
 }
function removepr(id) {
		 $('#tr_' + id).remove();
		 $(".snn").each(function () {
				 $(this).text(sn);
				 sn = sn + 1;
		 });
		 sn = 1;
 }
