<style>
table {
  border: 1px solid #999;
  border-collapse: collapse;
  width: 100%
}
td {
  border: 1px solid #999
}
</style>

<p>
  <button onclick="addRows()">Add a new row</button>
</p>
<table id="myTable"></table>
<script>
function addRows() {
  var table = document.getElementById( 'myTable' ),
      row = table.insertRow(0),
      cell1 = row.insertCell(0),
      cell2 = row.insertCell(1);

  cell1.innerHTML = 'Cell 1';
  cell2.innerHTML = 'Cell 2';
}
</script>