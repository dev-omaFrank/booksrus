class CoverImage {
    constructor(isbnArray, cardSelector) {
        this.isbnArray = isbnArray;
        this.cardDiv = document.querySelectorAll(cardSelector)
    }

    getImages() {
        this.isbnArray.forEach((image, index) => {
            let url = `https://covers.openlibrary.org/b/isbn/${image}-L.jpg`;
            let img = document.createElement('img');
            img.src = url;
            img.alt = 'cover image';
            this.cardDiv[index].appendChild(img);
        })
    }
}

window.addEventListener('load', () => {
    var coverImage = new CoverImage(['9781603095020', '9781891830259', '9781603090308', '9781603095006', '9781603094917', '9780385533225', '0385472579', '9781891830259'], '#card');

    coverImage.getImages();
})

const glide = new Glide('.glide', {
    type: 'carousel',
    perView: 1,
    autoplay: false
});

glide.mount();

document.getElementById('prevButton').addEventListener('click', function() {
    glide.go('<');
});

document.getElementById('nextButton').addEventListener('click', function() {
    glide.go('>');
});