var count = 2;

function addGrade() {
    $('#grades').append('<input type="number" class="form-control" id="grade' + count + '" name="grade' + count + '" placeholder="Grade"><br>');
    count++;
}

