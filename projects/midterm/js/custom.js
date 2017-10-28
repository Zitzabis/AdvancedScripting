var div = document.getElementById("entries");
var numEntries = div.textContent;
var count = parseInt(numEntries);

console.log(count);

function addQuestion() {
    $('#questions').append('<h4>Question ' + (count + 1) + ':</h4>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red;">*</div><input type="text" class="form-control" id="question' + count + '" name="question' + count + '" placeholder="Question" required></div>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red;">*</div><textarea class="form-control" id="options' + count + '" name="options' + count + '" required></textarea></div>');
    $('#questions').append('<div class="text-muted">Please write the answer exactly as you wrote it in the field above.</div>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red;">*</div><input type="text" class="form-control" id="answer' + count + '" name="answer' + count + '" placeholder="Answer" required></div>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red;">*</div><input type="number" class="form-control" id="points' + count + '" name="points' + count + '" placeholder="Points" required></div>');
    $('#questions').append('<hr>');
    count++;
}