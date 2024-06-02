//get pw & username, validate that they are 1. not empty, and 2.email has @ + .com/.net/.edu
function loginValidate() { 
    console.log('validating form fields')
    try {
        var pw = document.getElementById('pw');
        var username = document.getElementById('username');
        //UNSURE IF 0 WILL CAUSE ERROR
        if (!pw.value || !username.value) {
            alert("Please fill out both fields.");
            return false;
        } else if (!(username.value.includes('@') && (username.value.includes('.co') || username.value.includes('.net') || username.value.includes('.edu') || username.value.includes('.org'))) ) {
            alert ("Check if email address is valid.");
            return false;
        } return true;
    } catch (error) {
        console.log(error.name);
        console.log(error.message);
        console.log(error.stack);
        alert('Something seems to have gone wrong. Refresh this page.')
    }
    return false;
}