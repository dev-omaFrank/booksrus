class Validator {
    constructor(title, author, level, course_code, department) {
        this.title = document.querySelector(title);
        this.author = document.querySelector(author);
        this.level = document.querySelector(level);
        this.course_code = document.querySelector(course_code);
        this.department = document.querySelector(department);


    }

    inputValidator() {
        var input_fields = [this.title, this.author, this.level, this.course_code, this.department];
        var isValid = true;
        input_fields.forEach(input_field => {
            if (input_field.value == '') {
                input_field.previousElementSibling.innerHTML = `${input_field.name} is required`;
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
            SendFormData(new FormData(document.querySelector('form')));
            document.querySelector('form').addEventListener('submit', (e) => {
                e.preventDefault();
                SendFormData(new FormData(this));
            });
        }
    }
}

async function SendFormData(formData) {
    try {
        const response = await fetch('./config/book-upload.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Failed to fetch');
        }

        const results = await JSON.parse(response);
        console.log(results)
        if (results.success) {
            console.log(results.message);
        } else {
            console.error(results.message);
        }
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}
const validate = new Validator('#book-title', '#book-author', '#level', '#course-code', '#department');
validate.inputValidator();