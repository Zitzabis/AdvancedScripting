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

function addQuestion() {
    $('#questions').append('<h4>Question ' + count + ':</h4>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><input type="text" class="form-control" id="title" name="title" placeholder="Question"></div>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><textarea class="form-control" id="body" name="body"></textarea></div>');
    count++;
}