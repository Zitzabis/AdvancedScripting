var div = document.getElementById("entries");
var numEntries = div.textContent;

if (parseInt(numEntries) == 0) {
    var count = 2;
}
else {
    var count = parseInt(numEntries); + 1;
}

console.log(count);

function addGrade() {
    $('#grades').append('<input type="number" class="form-control" id="grade' + count + '" name="grade' + count + '" placeholder="Grade"><br>');
    count++;
}