
<script>
 //test print 
    var doc = new jsPDF();
function saveDiv(divId, title) {
doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
doc.save('div.pdf');
}
function printDiv(divId,
 title) {
 let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
 mywindow.document.write(`<html><head><title>${title}</title>`);
 mywindow.document.write('</head><body >');
 mywindow.document.write(document.getElementById(divId).innerHTML);
 mywindow.document.write('</body></html>');
 mywindow.document.close(); 
 mywindow.focus();
 mywindow.print();
 mywindow.close();
 return true; 
}
//sala script

</script><p>don't print this to pdf</p>
<div id="pdf">
  <p>
    <font size="3" color="red">print this to pdf</font>
  </p>
</div>

<button onclick="printDiv('pdf','Title')">print div</button>

<button onclick="saveDiv('pdf','Title')">save div as pdf</button>

