function createValidate() {
    //validate 1. not empty, 2.email has @, .co etc. and 3. pw is alphanumeric 
    console.log('Validating account creation request...');
    try {
        const username = document.getElementById('username');
        const email = document.getElementById('email');
        const pw = document.getElementById('pw');
        const cfmpw = document.getElementById('cfmpw');
        if (!username.value || !email.value || !pw.value || !cfmpw.value) {
            alert("Please fill out all fields.");
            return false;
        } else if (!(email.value.includes('@') && (email.value.includes('.co') || email.value.includes('.net') || email.value.includes('.edu') || email.value.includes('.org'))) ) {
            alert ("Check if email address is valid.");
            return false;
        } return true;
    } catch (error) {
        console.log(error.name);
        console.log(error.message);
        console.log(error.stack);
        alert('Something seems to have gone wrong. Refresh this page.');
    } 
    return false;
}