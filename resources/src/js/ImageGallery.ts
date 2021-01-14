export default class ImageGallery {
    private readonly container: HTMLElement;
    private readonly stageImg: HTMLImageElement;
    private thumbsList: HTMLElement;
    private thumbItems: NodeListOf<HTMLImageElement>;
    private lightboxContainer: HTMLElement;
    private lightboxContents: HTMLElement;
    private lightboxStageImg: HTMLImageElement;
    private lightboxClose: HTMLButtonElement;
    private currentIndex: number;
    private allImages: NodeListOf<HTMLImageElement>;
    private lightboxButtonPrev: HTMLElement;
    private lightboxButtonNext: HTMLElement;

    constructor(container: string) {
        this.container = document.querySelector(container);
        if (this.container) {
            this.stageImg = this.container.querySelector('.gallery__stage-img');
            this.thumbsList = this.container.querySelector('.gallery__thumbs-list');
            this.thumbItems = this.container.querySelectorAll('.gallery__thumbs-item');
            this.lightboxContainer = this.container.querySelector('.gallery__lightbox-container');
            this.lightboxContents = this.container.querySelector('.gallery__lightbox-contents');
            this.lightboxStageImg = this.container.querySelector('.gallery__lightbox-img');
            this.allImages = this.container.querySelectorAll('.gallery__thumbs-img');
            this.lightboxClose = this.container.querySelector('.gallery__lightbox-close');
            this.lightboxButtonPrev = this.container.querySelector('#imageGalleryPrev');
            this.lightboxButtonNext = this.container.querySelector('#imageGalleryNext');

            this.thumbItems.forEach(item => {
                if (!item.classList.contains('gallery__thumbs-item--last')) {
                    item.addEventListener('mouseenter', (e) => this.handleThumbnailHover(e));
                }
                item.addEventListener('click', (e) => this.openLightbox(e));
            });




        }
    }

    private handleThumbnailHover(e: MouseEvent) {
        ImageGallery.setImageSrcFromListItem(e.target as HTMLLIElement, this.stageImg);
    }

    private openLightbox(e: MouseEvent) {
        e.stopPropagation();
        const clickedElement = e.currentTarget as HTMLLIElement
        this.currentIndex = parseInt(clickedElement.dataset.index);
        this.lightboxContainer.classList.add('gallery__lightbox--open');

        this.setLightboxStageImg();

        this.lightboxClose.addEventListener('click', () => this.closeLightbox());

        this.lightboxButtonPrev.addEventListener('click', () => this.prevImage());
        this.lightboxButtonNext.addEventListener('click', () => this.nextImage());

        document.addEventListener('keydown', this.handleKeyDown);
    }

    private setLightboxStageImg() {
        this.lightboxStageImg.src = this.allImages[this.currentIndex].src;
    }

    private closeLightbox() {
        this.lightboxContainer.classList.remove('gallery__lightbox--open');
        document.removeEventListener('keydown', this.handleKeyDown);
    }

    private nextImage() {
        this.currentIndex = (this.currentIndex + 1) % this.allImages.length;
        this.setLightboxStageImg();
    }

    private prevImage() {
        if(this.currentIndex === 0) {
            this.currentIndex = this.allImages.length - 1;
        } else {
            this.currentIndex--;
        }
        console.log(this.currentIndex);
        this.setLightboxStageImg();
    }

    private static setImageSrcFromListItem(listItem: HTMLLIElement, image: HTMLImageElement) {
        image.src = listItem.querySelector('img').src;
    }

    // "weird" arrow syntax in order to be able to remove the event listener
    private handleKeyDown = (e: KeyboardEvent) => {
        switch (e.key) {
            case 'Escape':
                this.closeLightbox();
                break;
            case 'ArrowRight':
                this.nextImage();
                break;
            case 'ArrowLeft':
                this.prevImage();
                break;
        }
    }
}