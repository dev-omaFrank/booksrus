class Login {
    constructor(email_field, password_field, button, form) {
        this.email_field = document.querySelector(email_field);
        this.password_field = document.querySelector(password_field);
        this.button = document.querySelector(button);
        this.button.addEventListener('click', (event) => this.inputValidator(event));
        this.form = document.querySelector(form);
    }

    inputValidator(event) {
        event.preventDefault;
        var input_fields = [this.email_field, this.password_field];
        var isValid = true;
        input_fields.forEach(input_field => {
            if (input_field.value == '') {
                input_field.previousElementSibling.innerHTML = `${input_field.name} is required`;
                isValid = false;
            } else if (input_field.value.length < 10) {
                input_field.previousElementSibling.innerHTML = `${input_field.name} must be more than 8 characters`;
                isValid = false;
            }

            input_field.addEventListener('focus', () => {
                if (input_field.previousElementSibling.innerHTML === `${input_field.name} is required` ||
                    input_field.previousElementSibling.innerHTML === `${input_field.name} must be more than 8 characters`) {
                    input_field.previousElementSibling.innerHTML = '';
                }
            });
        });

        if (isValid) {
            this.form.addEventListener('submit', (e) => {
                e.preventDefault();
                var xhr = new XMLHttpRequest();
                var formData = new FormData(this.form);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            var data = JSON.parse(xhr.responseText);
                            if (data.status) {
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
                            if (data.acct_type == 'user') {
                                location.assign('./user/index.php');
                            }
                            if (data.acct_type == 'admin') {
                                location.assign('./admin/dashboard.php');
                            }
                        }
                    }
                }
                xhr.open('POST', "./xhr/login.php");
                xhr.send(formData);
            });
        }

    }
}

var login = new Login('#email-input-field', '#password-input-field', '#login_submit_button', 'form')