//define hamburger class
class Hamburger {
    constructor(buttonSelector, linkSelector) {
        this.buttonSelector = buttonSelector;
        this.linkSelector = linkSelector;
    };
    toggleDisplay() {
        var element = document.querySelector(this.linkSelector),
            button = document.querySelector(this.buttonSelector),
            button_initial_state = button.className;
        button.addEventListener('click', (e) => {
            e.preventDefault()
            if (element) {
                if (element.style.display == 'none') {
                    element.style.display = 'block'
                    button.className = ''
                } else {
                    element.style.display = 'none'
                    button.className = button_initial_state;
                }
            }
        })
    }

}

var eatBurger = new Hamburger('nav > a.active', '#nav_links');
eatBurger.toggleDisplay();