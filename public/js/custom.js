const checkPassword = () =>{
    var pswd_value = document.getElementById('password').value;
    var conf_pswd_value = document.getElementById('confirm_password').value;
    var submit_button = document.getElementById('submit');

    if(pswd_value == conf_pswd_value){
        if(submit_button.classList.contains('disabled')){
            submit_button.classList.remove('disabled');
        }
    }else{
        if(!submit_button.classList.contains('disabled')){
            submit_button.classList.add('disabled');
        }
    }
}

window.loadImagePreview = function (id, input) {
    id = id || "#imagePreview";
    var img = document.getElementById(id);
    var div = document.getElementById("uploadImageBlock");
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        img.hidden = false;

        div.classList.remove('d-flex');
        div.style.display = 'none';
    }
};