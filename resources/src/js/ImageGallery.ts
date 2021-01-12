export default class ImageGallery {
    private readonly container: HTMLElement;
    private stageImg: HTMLImageElement;
    private images: NodeListOf<HTMLImageElement>;

    constructor(container: string) {
        this.container = document.querySelector(container);
        this.openLightbox();
        if(this.container) {
            this.stageImg = this.container.querySelector('.gallery__stage-img');
            this.images = this.container.querySelectorAll('.gallery__thumbs-img');

            this.images.forEach(image => {
                image.addEventListener('mouseenter', (e) => this.handleThumbnailHover(e))
            })
        }
    }

    private handleThumbnailHover(e: MouseEvent) {
        const currentImg = e.target as HTMLImageElement;
        this.stageImg.src = currentImg.src;
    }

    private openLightbox() {
        const lightboxContainer = document.createElement('div');
        lightboxContainer.classList.add('gallery__lightbox-container');

        this.container.appendChild(lightboxContainer);
    }
}