document.addEventListener('DOMContentLoaded', function () {
    // No specific initialization required for this example
});

function showAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'block';
}

function closeAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'none';
}

function addStudent() {
    var name = document.getElementById('newName').value;
    var subject = document.getElementById('newSubject').value;
    var marks = document.getElementById('newMarks').value;

    if (!name || !subject || !marks) {
        alert('Please fill in all fields.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'student.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === 'Success') {
                    location.reload();
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            } else {
                alert('HTTP Error: ' + xhr.status);
            }
        }
    };
    xhr.send(`action=add&name=${encodeURIComponent(name)}&subject=${encodeURIComponent(subject)}&marks=${encodeURIComponent(marks)}`);
}

function showEditStudentModal(id, name, subject, marks) {
    document.getElementById('editStudentId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editSubject').value = subject;
    document.getElementById('editMarks').value = marks;

    document.getElementById('editStudentModal').style.display = 'block';
}

function closeEditStudentModal() {
    document.getElementById('editStudentModal').style.display = 'none';
}

function updateStudent() {
    var id = document.getElementById('editStudentId').value;
    var name = document.getElementById('editName').value;
    var subject = document.getElementById('editSubject').value;
    var marks = document.getElementById('editMarks').value;

    if (!name || !subject || !marks) {
        alert('Please fill in all fields.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'student.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === 'Success') {
                    location.reload();
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            } else {
                alert('HTTP Error: ' + xhr.status);
            }
        }
    };
    xhr.send(`action=update&id=${id}&name=${encodeURIComponent(name)}&subject=${encodeURIComponent(subject)}&marks=${encodeURIComponent(marks)}`);
}

function deleteStudent(id) {
    if (!confirm('Are you sure you want to delete this student?')) {
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'student.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === 'Success') {
                    location.reload();
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            } else {
                alert('HTTP Error: ' + xhr.status);
            }
        }
    };
    xhr.send(`action=delete&id=${id}`);
}
