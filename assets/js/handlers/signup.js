class Show_pass {
    constructor(show_pswd_btn, pswd_text) {
        this.show_pswd_btn = document.querySelector(show_pswd_btn);
        this.pswd_text = pswd_text;
    }

    password_visibility() {


        this.show_pswd_btn.addEventListener('click', () => {


            if (this.pswd_text.type === 'password') {
                this.pswd_text.type = 'text';
                this.show_pswd_btn.innerHTML = 'Hide Password' + `<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA9ElEQVRIS2NkoDFgpLH5DERZ8P///wCgQ/KB2AHqoANAupGRkRFE4wUELQAavgBoQjwOU0CWNOCzAa8FUJevhxpQCKQ3QNkJQLoeynbE5xNCFoCCwB6IC4GGTEB2KdBykMtBlhwEysGCDsMzhCz4D9UhCDTkA5oFCkD+fZAYUA6nOURZgMsAoC/ADhhhFgB9DYqw+UAMCmNSwAOg4kT0FIURB0ALQArlSTEZSe0DoAWKyHqxWUAw4rBZjivCRy2Ah9ZoEBFMtYMqiEClJj9BJ2NX8BCY0VBKAGz5AFRULCAjNz8E6kkgWFSQ6XKc2gjWyZRaCADKF5MZXMm3KwAAAABJRU5ErkJggg=="/>`;
            } else {
                this.pswd_text.type = 'password';
                this.show_pswd_btn.innerHTML = 'Show Password' + ` <img  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA/UlEQVRIS2NkoDFgpLH5DERZ8P///wCgQ/KB2AHqoANAupGRkRFE4wUELQAavgBoQjwOU0CWNOCzAa8FUJevhxpQCKQ3QNkJQLoeynbE5xNCFoCCwB6IC4GGTEB2KdBykMtBlhwEysGCDsMzhCz4D9UhCDTkA5oFCkD+fZAYUA6nOURZgMsAoC/ADqCZBYRSENhyfIqIcSEhSzAsABoKirD5QAwKY1LAA6DiRPQUhc0CkEJ5UkxGUvsAaIEisl5sFhCMOGyW4wrOUQvgoTUaRART7aAKIlCpyU/QydgVPARmNJQSAFdRsYCM3PwQqCeBYFFBpstxaiNYJ1NqIQC/tIsZPcyBOgAAAABJRU5ErkJggg=="/>`;
            }
        });
    }
}

const passwordInput = document.querySelector('input[type="password"]');
const show_pass = new Show_pass('i', passwordInput);
show_pass.password_visibility();


class Validator {
    constructor(email_field, password_field, photo_field, buttons) {
        this.email_field = document.querySelector(email_field);
        this.password_field = document.querySelector(password_field);
        this.photo_field = document.querySelector(photo_field);
        this.buttons = buttons.map(buttonId => document.querySelector(buttonId));

        this.buttons.forEach(button => {
            button.addEventListener('click', (event) => this.inputValidator(event));
        });
    }

    inputValidator(event) {
        const button_id = event.target.id;
        var input_fields = [this.email_field, this.password_field, this.photo_field];
        var isValid = true;
        input_fields.forEach(input_field => {
            if (input_field.value == '') {
                input_field.previousElementSibling.innerHTML = `${input_field.name} is required`;
                isValid = false;
            } else if (input_field.value.length < 10) {
                input_field.previousElementSibling.innerHTML = `${input_field.name} must be more than 8 characters`;
                isValid = false;
            } else {
                input_field.previousElementSibling.innerHTML = `${input_field.name}`;
            }

            input_field.addEventListener('focus', () => {
                if (input_field.previousElementSibling.innerHTML === `${input_field.name} is required` ||
                    input_field.previousElementSibling.innerHTML === `${input_field.name} must be more than 8 characters`) {
                    input_field.previousElementSibling.innerHTML = `${input_field.name}`;
                }
            });
        });

        if (isValid) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.id = button_id;
            hiddenInput.name = button_id + '_account';
            document.querySelector('form').appendChild(hiddenInput);

            var form = document.querySelector('form');

            form.addEventListener('submit', (e) => {
                e.preventDefault();

                var xhr = new XMLHttpRequest();
                var formData = new FormData(form);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            data = JSON.parse(xhr.responseText);
                            try {
                                var data = JSON.parse(xhr.responseText);
                                if (data.success) {
                                    alert(data.message);
                                } else {
                                    alert(data.message);
                                }
                                if (data.url) {
                                    location.href(data.page);
                                }
                                if (data.page == 'same') {
                                    location.href = location.pathname;
                                } else {
                                    location.href = data.page
                                }
                            } catch (error) {
                                console.error("Error parsing JSON:", error);
                            }
                        } else {
                            console.error(xhr.statusText);
                        }
                    }
                };
                xhr.open("POST", "./config/signup.php");
                xhr.send(formData);
            });
        }

    }
}

var validate = new Validator('#email', '#password', '#photo', ['#user', '#admin']);


document.querySelector('.contact-form > h2').addEventListener('click', () => {
    window.location.assign('index.html');
})