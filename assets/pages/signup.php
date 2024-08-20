<form method="post" action="assets/php/actions.php?signup">
    <!-- Role Selection -->
    <div class="form-group">
        <label for="userRole">I am a:</label>
        <select name="userRole" class="form-control" id="userRole">
            <option value="">Select Role</option>
            <option value="student" <?= showFormData('userRole') == 'student' ? 'selected' : '' ?>>Student</option>
            <option value="alumni" <?= showFormData('userRole') == 'alumni' ? 'selected' : '' ?>>Alumni</option>
        </select>
        <?= showError("userRole") ?> <!-- Display the error message here -->
    </div>

    <!-- Common Fields -->
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" value="<?= showFormData('firstName') ?>" class="form-control" id="firstName" placeholder="Enter first name">
        <?= showError("firstName") ?>
    </div>

    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" value="<?= showFormData('lastName') ?>" class="form-control" id="lastName" placeholder="Enter last name">
        <?= showError("lastName") ?>
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="text" name="email" value="<?= showFormData('email') ?>" class="form-control" id="email" placeholder="Enter email">
        <?= showError("email") ?>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?= showFormData('username') ?>" class="form-control" id="username" placeholder="Enter username">
        <?= showError("username") ?>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        <?= showError("password") ?>
    </div>

    <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm Password">
        <?= showError("confirmPassword") ?>
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" class="form-control" id="gender">
            <option value="">Select Gender</option>
            <option value="male" <?= showFormData('gender') == 'male' ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= showFormData('gender') == 'female' ? 'selected' : '' ?>>Female</option>
            <option value="other" <?= showFormData('gender') == 'other' ? 'selected' : '' ?>>Other</option>
        </select>
        <?= showError("gender") ?>
    </div>

    <!-- Alumni-Specific Fields -->
    <div id="alumniFields" style="<?= showFormData('userRole') == 'alumni' ? 'display:block;' : 'display:none;' ?>">
        <div class="form-group">
            <label for="graduationYear">Graduation Year</label>
            <input type="text" name="graduationYear" value="<?= showFormData('graduationYear') ?>" class="form-control" id="graduationYear" placeholder="Enter graduation year">
            <?= showError("graduationYear") ?>
        </div>
        <div class="form-group">
            <label for="degree">Degree/Program Completed</label>
            <input type="text" name="degree" value="<?= showFormData('degree') ?>" class="form-control" id="degree" placeholder="Enter degree or program completed">
            <?= showError("degree") ?>
        </div>
        <div class="form-group">
            <label for="occupation">Current Occupation/Job Title</label>
            <input type="text" name="occupation" value="<?= showFormData('occupation') ?>" class="form-control" id="occupation" placeholder="Enter current occupation or job title">
            <?= showError("occupation") ?>
        </div>
        <div class="form-group">
            <label for="companyName">Company Name</label>
            <input type="text" name="companyName" value="<?= showFormData('companyName') ?>" class="form-control" id="companyName" placeholder="Enter company name">
            <?= showError("companyName") ?>
        </div>
        <div class="form-group">
            <label for="linkedinProfile">LinkedIn Profile (optional)</label>
            <input type="url" name="linkedin" value="<?= showFormData('linkedin') ?>" class="form-control" id="linkedinProfile" placeholder="Enter LinkedIn profile URL">
            <?= showError("linkedin") ?>
        </div>
    </div>

    <!-- Student-Specific Fields -->
    <div id="studentFields" style="<?= showFormData('userRole') == 'student' ? 'display:block;' : 'display:none;' ?>">
        <div class="form-group">
            <label for="currentYear">Current Year/Semester</label>
            <input type="text" name="currentYear" value="<?= showFormData('currentYear') ?>" class="form-control" id="currentYear" placeholder="Enter current year or semester">
            <?= showError("currentYear") ?>
        </div>
        <div class="form-group">
            <label for="program">Course/Program Enrolled</label>
            <input type="text" name="program" value="<?= showFormData('program') ?>" class="form-control" id="program" placeholder="Enter course or program enrolled">
            <?= showError("program") ?>
        </div>
        <div class="form-group">
            <label for="expectedGraduationYear">Expected Graduation Year</label>
            <input type="text" name="expectedGraduationYear" value="<?= showFormData('expectedGraduationYear') ?>" class="form-control" id="expectedGraduationYear" placeholder="Enter expected graduation year">
            <?= showError("expectedGraduationYear") ?>
        </div>
    </div>
<div>
<a href="?login ">Already have an account?</a>
</div>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Sign Up</button>
    
</form>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userRoleSelect = document.getElementById('userRole');
    const alumniFields = document.getElementById('alumniFields');
    const studentFields = document.getElementById('studentFields');

    // Function to update visibility based on selected role
    function updateFields() {
        const selectedRole = userRoleSelect.value;
        if (selectedRole === 'alumni') {
            alumniFields.style.display = 'block';
            studentFields.style.display = 'none';
        } else if (selectedRole === 'student') {
            alumniFields.style.display = 'none';
            studentFields.style.display = 'block';
        } else {
            alumniFields.style.display = 'none';
            studentFields.style.display = 'none';
        }
    }

    // Initial check on page load
    updateFields();

    // Add event listener to update fields when selection changes
    userRoleSelect.addEventListener('change', updateFields);
});
</script>
