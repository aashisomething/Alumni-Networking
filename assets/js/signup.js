document.getElementById('userRole').addEventListener('change', function() {
    var studentFields = document.getElementById('studentFields');
    var alumniFields = document.getElementById('alumniFields');
    
    if (this.value == 'student') {
        studentFields.style.display = 'block';
        alumniFields.style.display = 'none';
    } else if (this.value == 'alumni') {
        studentFields.style.display = 'none';
        alumniFields.style.display = 'block';
    } else {
        studentFields.style.display = 'none';
        alumniFields.style.display = 'none';
    }
});
