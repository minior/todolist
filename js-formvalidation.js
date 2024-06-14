//get pw & username, validate that they are 1. not empty
function loginValidate() { 
    console.log('Validating form fields...');
    try {
        const pw = document.getElementById('pw');
        const username = document.getElementById('username');
        //UNSURE IF 0 WILL CAUSE ERROR
        if (!pw.value || !username.value) {
            alert("Please fill out both fields.");
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