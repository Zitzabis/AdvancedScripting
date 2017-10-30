// Author:      Stephen Floyd
// Date:        10/30/17
// Assignment:  Midterm

// Determine number of entries so far
var div = document.getElementById("entries");
var numEntries = div.textContent;
var count = parseInt(numEntries);

// Print to console
console.log(count);

// Add HTML form elements for a new question
function addQuestion() {
    $('#questions').append('<h4>Question ' + (count + 1) + ':</h4>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red; float:left;">*</div> Question:<input type="text" class="form-control" id="question' + count + '" name="question' + count + '" placeholder="Question" required></div>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red; float:left;">*</div> Options:<textarea class="form-control" id="options' + count + '" name="options' + count + '" required></textarea></div>');
    $('#questions').append('<div class="text-muted">Please write the answer exactly as you wrote it in the field above.</div>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red; float:left;">*</div> Answer:<input type="text" class="form-control" id="answer' + count + '" name="answer' + count + '" placeholder="Answer" required></div>');
    $('#questions').append('<div class="form-group" style="padding: 0.5em;"><div style="color: red; float:left;">*</div> Points:<input type="number" class="form-control" id="points' + count + '" name="points' + count + '" placeholder="Points" required></div>');
    $('#questions').append('<hr>');
    count++;
}