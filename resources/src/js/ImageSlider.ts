export default class ImageSlider {
    private readonly container: HTMLElement;
    private slideList: HTMLElement;
    private readonly numberOfSlides: number;
    private buttonPrev: HTMLButtonElement;
    private buttonNext: HTMLButtonElement;

    constructor(container: string) {
        this.container = document.querySelector(container);
        if(this.container) {
            this.slideList = this.container.querySelector('.single-product__images-list');
            this.buttonPrev = this.container.querySelector('#imageSliderPrev');
            this.buttonNext = this.container.querySelector('#imageSliderNext');
            this.numberOfSlides = this.slideList.children.length;

            this.slideList.style.width = `${this.numberOfSlides * 100}%`;

            this.buttonNext.addEventListener('click', () => this.handleNext());
            this.buttonPrev.addEventListener('click', () => this.handlePrev());
        }
    }

    private handleNext() {
        this.slideList.classList.add('single-product__images--transition-on');
        this.slideList.style.left = '-100%';

        const reorderSlides = () => {
            const firstSlide = this.slideList.querySelector('.single-product__images-item:first-child');
            this.slideList.classList.remove('single-product__images--transition-on');
            this.slideList.appendChild(firstSlide);
            this.slideList.style.left = '0';
            this.slideList.removeEventListener('transitionend', reorderSlides);

        };
        this.slideList.addEventListener('transitionend', reorderSlides);
    }

    private handlePrev() {
        this.slideList.classList.remove('single-product__images--transition-on');

        const lastSlide = this.slideList.querySelector('.single-product__images-item:last-child');
        this.slideList.prepend(lastSlide);

        this.slideList.style.left = '-100%';

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                this.slideList.classList.add('single-product__images--transition-on');
                this.slideList.style.left = '0';
            });
        });
    }
}