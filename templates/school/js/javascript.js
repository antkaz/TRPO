//распечатать контент
function printDiv(strid) {
	var prtContent = document.getElementById(strid);
	//var prtCSS = '<link rel="stylesheet" href="/templates/css/template.css" type="text/css" />';
	var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
	WinPrint.document.write('<div id="print" class="contentpane">');
//	WinPrint.document.write(prtCSS);
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.write('</div>');
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
//	prtContent.innerHTML=strOldOne;
}