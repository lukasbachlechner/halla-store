export default class ImageDropZone {
    private readonly dropZoneFormGroup: HTMLElement;
    private dropZone: HTMLElement;

    private fileInput: HTMLInputElement;
    private uploadFileList: FileList;
    private uploadFilesMap: Map<string, File>;

    private deletedFileInput: HTMLInputElement;
    private filesToDelete: Set<string>;

    private thumbsList: HTMLUListElement;
    private thumbsContent: Map<string, string>;
    private currentSelection: Set<string>;
    private dropZonePrompt: HTMLElement;
    private dropZoneHeader: HTMLElement;
    private uploadButton: HTMLButtonElement;
    private existingImages: NodeListOf<HTMLElement>;

    constructor(dropZoneFormGroup: string) {
        this.dropZoneFormGroup = document.querySelector(dropZoneFormGroup);

        if (this.dropZoneFormGroup) {
            this.dropZone = this.dropZoneFormGroup.querySelector('.drop-zone');
            this.dropZonePrompt = this.dropZoneFormGroup.querySelector('.drop-zone__prompt');
            this.dropZoneHeader = this.dropZoneFormGroup.querySelector('.drop-zone__header');
            this.fileInput = this.dropZoneFormGroup.querySelector('input#newFilesInput');
            this.deletedFileInput = this.dropZoneFormGroup.querySelector('input#deletedFilesInput');
            this.thumbsList = this.dropZoneFormGroup.querySelector('.drop-zone__thumbs-list');
            this.uploadButton = this.dropZoneFormGroup.querySelector('button#uploadButton');
            this.existingImages = this.thumbsList.querySelectorAll('.drop-zone__thumbs-item');

            this.uploadFilesMap = new Map();
            this.filesToDelete = new Set();
            this.currentSelection = new Set();
            this.thumbsContent = new Map();

            this.dropZone.addEventListener('dragover', (e) => this.handleDragOver(e));
            this.uploadButton.addEventListener('click', (e) => this.handleUploadClick(e));
            this.fileInput.addEventListener('change', (e) => this.handleFileInputChange(e));

            ['dragleave', 'dragend'].forEach(type => {
                this.dropZone.addEventListener(type, () => this.handleDragLeave());
            });

            this.dropZone.addEventListener('drop', (e) => this.handleDrop(e));

            if(this.existingImages) {
                this.existingImages.forEach(image => image.addEventListener('click', (e) => this.handleItemClick(e)));
            }
        }
    }

    private toggleClass(type: string) {
        if (type === 'ADD') {
            this.dropZone.classList.add('drop-zone--over');
        } else if (type === 'REMOVE') {
            this.dropZone.classList.remove('drop-zone--over');
        }
    }

    private handleDragOver(e: DragEvent) {
        e.preventDefault();
        this.toggleClass('ADD');
    }

    private handleDragLeave() {
        this.toggleClass('REMOVE');
    }

    private handleDrop(e: DragEvent) {
        e.preventDefault();

        // files from DragEvent
        const {files} = e.dataTransfer;

        this.handleInput(files);

        this.toggleClass('REMOVE');
    }

    private handleInput(files: FileList) {
        if (files) {
            // loop over FileList as Array, add to uploadFilesMap only if it's an image
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    if (this.uploadFilesMap.has(file.name)) {
                        alert('Diese Datei ist schon vorhanden.');
                    } else {
                        this.uploadFilesMap.set(file.name, file);
                    }
                } else {
                    alert('Dieses Dateiformat wird nicht unterstützt.');
                }
            });

            this.generateThumbnails();
            this.setFileInputFiles();
        }
    }

    private handleUploadClick(e: MouseEvent) {
        e.preventDefault();
        this.fileInput.click();
    }

    private handleFileInputChange(e: Event) {
        this.handleInput(this.fileInput.files);
    }

    private setFileInputFiles(target: string = 'NEW') {
        // temporary DataTransfer to get a valid FileList (can't be created directly)
        const tempDataTransfer = new DataTransfer();

        // add each item in the Set to the temporary DataTransfer
        this.uploadFilesMap.forEach(file => tempDataTransfer.items.add(file));

        // rewrite uploadFileList and set the files of the input to such
        this.uploadFileList = tempDataTransfer.files;
        this.fileInput.files = this.uploadFileList;
    }

    private generateThumbnails() {
        this.thumbsList.innerHTML = '';

        if(this.existingImages) {
            const filteredImages = Array.from(this.existingImages).filter(item => {
                return !this.filesToDelete.has(item.dataset.imageId);
            });

            filteredImages.forEach(image => {
                this.thumbsList.appendChild(image);
            })
        }

        this.uploadFilesMap.forEach(file => {

            let fileContent = this.thumbsContent.get(file.name);

            if (fileContent === undefined) {
                const reader = new FileReader();

                reader.readAsDataURL(file);

                reader.addEventListener('load', () => {
                    fileContent = reader.result as string;
                    this.thumbsContent.set(file.name, fileContent);
                    this.appendThumbnail(fileContent, file.name);
                });
            } else {
                this.appendThumbnail(fileContent, file.name);
            }
        });


    }

    private appendThumbnail(fileContent: string, fileName: string) {
        const thumbItem = document.createElement('li');
        thumbItem.classList.add('drop-zone__thumbs-item');
        thumbItem.dataset.fileName = fileName;
        thumbItem.dataset.deleteIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="#434343"  viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="close"><rect width="24" height="24" transform="rotate(180 12 12)" opacity="0"/><path d="M13.41 12l4.3-4.29a1 1 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1 1 0 0 0-1.42 1.42l4.3 4.29-4.3 4.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l4.29-4.3 4.29 4.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"/></g></g></svg>';
        thumbItem.addEventListener('click', (e: MouseEvent) => this.handleItemClick(e));

        const thumbImg = document.createElement('img');
        thumbImg.classList.add('drop-zone__thumbs-img');
        thumbImg.src = fileContent;


        thumbItem.appendChild(thumbImg);
        this.thumbsList.appendChild(thumbItem);
    }

    private handleItemClick(e: Event) {
        const clickedItem = e.currentTarget as HTMLElement;
        const {fileName} = clickedItem.dataset;

        this.uploadFilesMap.delete(fileName);

        if (this.deletedFileInput && clickedItem.dataset.imageId) {
            const {imageId} = clickedItem.dataset;
            this.filesToDelete.add(imageId);
            this.deletedFileInput.value = Array.from(this.filesToDelete).join(';');
        }

        this.generateThumbnails();
        this.setFileInputFiles();
    }
}