class Faq{
    constructor(elementToexpand, header, icon) {
        this.elementToexpand = document.getElementsByClassName(elementToexpand);
        this.header = document.getElementsByClassName(header);
        this.icon = document.getElementsByClassName(icon);
        this.toggleBox();
    }

    toggleBox() {
        const that = this;
        for(let i=0; i<this.header.length; i++) {

            this.header[i].addEventListener("click", function() {
                that.elementToexpand[i].classList.toggle("faq-answer-active");
                that.elementToexpand[i].classList.toggle("faq-answer");
                that.elementToexpand[i].classList.add("animate__animated");
                that.elementToexpand[i].classList.toggle("animate__bounceInDown");
                that.icon[i].classList.toggle("fa-minus");
                that.icon[i].classList.toggle("fa-plus");
                that.header[i].classList.toggle("faq-active");
            });
        }
    }
}

